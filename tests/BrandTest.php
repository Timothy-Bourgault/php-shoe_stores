<?php

    /**
    * @backupGlobals disabled
    * @backupsStaticAttributes disabled
    **/

    require_once "src/Brand.php";
    require_once "src/Store.php";

    $server = 'mysql:host=localhost;dbname=shoe_stores_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

        function test_getName()
        {
            // Arrange
            $test_brand = new Brand("Vibram");
            // Act
            $output = $test_brand->getName();
            // Assert
            $this->assertEquals("Vibram", $output);
        }

        function test_setName()
        {
            // Arrange
            $name = "Vibram";
            $test_brand = new Brand($name);
            // Act
            $new_name = "Adidas";
            $test_brand->setName($new_name);
            // Assert
            $this->assertEquals($new_name, $test_brand->getName());
        }

        function test_save()
        {
            // Arrange
            $test_brand = new Brand("Vibram");
            $test_brand->save();
            // Act
            $output = Brand::getAll();
            // Assert
            $this->assertEquals($test_brand, $output[0]);
        }


        function test_getId()
        {
            // Arrange
            $name = "Vibram";
            $id = "6";
            $test_brand = new Brand($name, $id);
            // Act
            $result = $test_brand->getId();
            // Assert
            $this->assertEquals($id, $result);
        }

        function test_getAll()
        {
            // Arrange
            $name = "Vibram";
            $test_Brand1 = new Brand($name);
            $test_Brand1->save();
            $name = "Zippies";
            $test_Brand2 = new Brand($name);
            $test_Brand2->save();
            // Act
            $result = Brand::getAll();
            // Assert
            $this->assertEquals([$test_Brand1, $test_Brand2], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $test_Brand1 = "Vibram";
            $test_Brand1 = new Brand($test_Brand1);
            $test_Brand1->save();
            $test_Brand2 = "Mondos";
            $test_Brand2 = new Brand($test_Brand2);
            $test_Brand2->save();
            // Act
            Brand::deleteAll();
            $result = Brand::getAll();
            // Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            // Arrange
            $brand_name1 = "Vibram";
            $test_Brand1 = new Brand($brand_name1);
            $test_Brand1->save();

            $brand_name2 = "Mondos";
            $test_Brand2 = new Brand($brand_name2);
            $test_Brand2->save();

            $brand_name3 = "Dobos";
            $test_Brand3 = new Brand($brand_name3);
            $test_Brand3->save();
            // Act
            $id = $test_Brand2->getId();
            $result = Brand::find($id);
            // Assert
            $this->assertEquals($test_Brand2, $result);
        }

        function test_addStore()
        {
          // Arrange
          $test_brand = new Brand("Vibram");
          $test_brand->save();
          $test_store = new Store("GoGos");
          $test_store->save();
          // Act
          $test_brand->addStore($test_store);
          $output = $test_brand->getBrandStores();
          // Assert
          $this->assertEquals([$test_store], $output);
        }

     }
?>
