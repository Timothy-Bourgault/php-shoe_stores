<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";
    date_default_timezone_set('America/Los_Angeles');

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

    $app->post("/brands/delete_all", function() use ($app) {
        Brand::deleteAll();
        return $app->redirect("/");
    });



return $app;

?>
