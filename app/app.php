<?php

    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    use Symfony\Component\Debug\Debug;
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    Debug::enable();
    $app = new Silex\Application();
    $app['debug'] = true;

    // //ALTERNATIVE SERVER:
    $server = 'mysql:host=localhost;dbname=shoe_stores';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->register(new Silex\Provider\UrlGeneratorServiceProvider());

    $app->get("/", function() use ($app) {
        $brands = Brand::getAll();
        $stores = Store::getAll();
        $result_array = array();
        return $app['twig']->render('index.html.twig', array('brands' => $brands, 'stores' => $stores));
    });

    $app->post("/add_store", function() use ($app) {
        $name = $_POST['store_name'];
        $new_store = new Store($name);
        $new_store->save();
        return $app->redirect("/");
    });

    $app->post("/stores/delete_all", function() use ($app) {
        Store::deleteAll();
        return $app->redirect("/");
    });

    $app->post("/add_brand", function() use ($app) {
        $name = $_POST['brand_name'];
        $new_brand = new Brand($name);
        $new_brand->save();
        return $app->redirect("/");
    });

    $app->post("/add_store_brand", function() use ($app) {
        $name = $_POST['brand_name'];
        $id = $_POST['id'];
        $new_brand = new Brand($name, $id);
        $new_brand->save();
        $found_store = Store::find($store_id);
        $brands = $found_store->getStoreBrands();
        return $app['twig']->render('stores.html.twig', array('brands' => $brands, 'store' => $found_store));
    });

    $app->get("/get_brand/{id}/{id2}", function($id,$id2) use ($app) {
        $brand = Brand::find($id2);
        $store = Store::find($id);
        return $app['twig']->render('stores.html.twig', array('brand' => $brand, 'store' => $store));
    });

    $app->post("/brands/delete_all", function() use ($app) {
        Brand::deleteAll();
        return $app->redirect("/");
    });

    $app->get("/get_store/{id}", function($id) use ($app) {
        $selected_store = Store::find($id);
        $selected_store_brands = $selected_store->getStoreBrands();
        return $app['twig']->render('stores.html.twig', array('store' => $selected_store, 'brands' => $selected_store_brands));
    });

return $app;

?>
