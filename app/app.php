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

    $app->get('/stores', function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post('/delete_store/{id}', function($id) use ($app){
        $store = Store::find($id);
        $store->deleteStore();
        return $app->redirect("/stores");
    });

    $app->get("/get_store/{id}", function($id) use ($app) {
        $selected_store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('store' => $selected_store, 'brands' => Brand::getAll(), 'store_brands' => $selected_store->getStoreBrands()));
    });

    $app->post("/add_store", function() use ($app) {
        $name = $_POST['store_name'];
        $new_store = new Store($name);
        $new_store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post("/stores/delete_all", function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->get('/brands', function() use ($app) {
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    $app->post('/update_store_name/{id}', function($id) use ($app) {
      $selected_store = Store::find($id);
      $store_name = $_POST['store_name'];
      $selected_store->updateName($store_name);
      return $app['twig']->render("store.html.twig", array('store' => $selected_store, 'brands' => Brand::getAll(), 'store_brands' => $selected_store->getStoreBrands()));
    });

    $app->post("/add_brand", function() use ($app) {
        $name = $_POST['brand_name'];
        $new_brand = new Brand($name);
        $new_brand->save();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    $app->post("/add_store_brand/{id}", function($id) use ($app) {
        $brand_name = $_POST['brand_name'];
        $new_brand = Brand::find($brand_name);
        $found_store = Store::find($id);
        $found_store->addBrand($new_brand);
        return $app['twig']->render('store.html.twig', array('store' => $found_store, 'brands' => Brand::getAll(), 'store_brands' => $found_store->getStoreBrands()));
    });

    $app->post("/add_brand_store/{id}", function($id) use ($app) {
        $store_name = $_POST['store_name'];
        $new_store = Store::find($store_name);
        $found_brand = Brand::find($id);
        $found_brand->addStore($new_store);
        return $app['twig']->render('brand.html.twig', array('brand' => $found_brand, 'stores' => Store::getAll(), 'brand_stores' => $found_brand->getBrandStores(), 'brands' => Store::getAll()));
    });

    $app->get("/get_brand/{id}", function($id) use ($app) {
        $found_brand = Brand::find($id);
        return $app['twig']->render('brand.html.twig', array('brand' => $found_brand, 'stores' => Store::getAll(), 'brand_stores' => $found_brand->getBrandStores(), 'brands' => Store::getAll()));
    });

    $app->post("/store_brands/delete_all", function() use ($app) {
        Brand::deleteAll();
        return $app['twig']->render('store.html.twig', array('brands' => Brand::getAll()));
    });

return $app;

?>
