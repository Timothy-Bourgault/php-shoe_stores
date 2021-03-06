<?php

    /**
    * @backupGlobals disabled
    * @backupsStaticAttributes disabled
    **/

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoe_stores_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

        function test_getName()
        {
            // Arrange
            $name = "Joel's Soles";
            $test_Store = new Store($name);
            // Act
            $result = $test_Store->getName();
            // Assert
            $this->assertEquals($name, $result);
        }

        function test_setName()
        {
            // Arrange
            $name = "Joel's Soles";
            $test_Store = new Store($name);
            // Act
            $new_name = "Joel's Souls";
            $test_Store->setName($new_name);
            // Assert
            $this->assertEquals($new_name, $test_Store->getName());
        }


        function test_getId()
        {
            // Arrange
            $name = "Joel's Soles";
            $id = "4";
            $test_Store = new Store($name, $id);
            // Act
            $result = $test_Store->getId();
            // Assert
            $this->assertEquals($id, $result);
        }

        function test_save()
        {
            // Arrange
            $name = "Joels Souls";
            $test_Store = new Store($name);
            // Act
            $test_Store->getId();
            $test_Store->save();
            $result = Store::getAll();
            // Assert
            $this->assertEquals([$test_Store], $result);
        }

        function test_getAll()
        {
            // Arrange
            $name = "Joels Souls";
            $test_Store1 = new Store($name);
            $test_Store1->save();
            $name = "Payless Shoes";
            $test_Store2 = new Store($name);
            $test_Store2->save();
            // Act
            $result = Store::getAll();
            // Assert
            $this->assertEquals([$test_Store1, $test_Store2], $result);
        }

        function test_updateName()
        {
            // Arrange
            $name = "Joels Souls";
            $test_Store = new Store($name);
            $test_Store->save();
            // Act
            $new_name = "Joels Soles";
            $test_Store->updateName($new_name);
            $result = $test_Store->getName();
            // Assert
            $this->assertEquals($new_name, $result);
        }

        function test_deleteStore()
        {
            // Arrange
            $test_Store1 = "Joels Soles";
            $test_Store1 = new Store($test_Store1);
            $test_Store1->save();
            $test_Store2 = "Maris Commando Boots";
            $test_Store2 = new Store($test_Store2);
            $test_Store2->save();
            // Act
            $test_Store1->deleteStore();
            $result_Stores = Store::getAll();
            // Assert
            $this->assertEquals([$test_Store2], $result_Stores);
        }

        function test_deleteAll()
        {
            // Arrange
            $test_Store1 = "Joels Soles";
            $test_Store1 = new Store($test_Store1);
            $test_Store1->save();
            $test_Store2 = "Maris Commando Boots";
            $test_Store2 = new Store($test_Store2);
            $test_Store2->save();
            // Act
            Store::deleteAll();
            $result = Store::getAll();
            // Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            // Arrange
            $store_name1 = "Joels Soles";
            $test_Store1 = new Store($store_name1);
            $test_Store1->save();

            $store_name2 = "Abigails";
            $test_Store2 = new Store($store_name2);
            $test_Store2->save();

            $store_name3 = "Lucifers Snake Skin Dress Shoes";
            $test_Store3 = new Store($store_name3);
            $test_Store3->save();
            // Act
            $id = $test_Store2->getId();
            $result = Store::find($id);
            // Assert
            $this->assertEquals($test_Store2, $result);
        }

        function test_addBrand()
        {
          // Arrange
          $test_store = new Store("Joels Soles");
          $test_store->save();
          $test_brand = new Brand("Vibram");
          $test_brand->save();
          // Act
          $test_store->addBrand($test_brand);
          $output = $test_store->getStoreBrands();
          // Assert
          $this->assertEquals([$test_brand], $output);
        }
    }
?>
