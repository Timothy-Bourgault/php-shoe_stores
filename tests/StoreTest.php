<?php

    /**
    * @backupGlobals disabled
    * @backupsStaticAttributes disabled
    **/

    require_once "src/Store.php";

    $server = 'mysql:host=localhost;dbname=shoe_stores_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            // Brand::deleteAll();
            // Store::deleteAll();
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

        function test_save()
        {
            // Arrange
            $name = "Joel's Souls";
            $test_Store = new Stylist($name);
            $test_Store->save();
            // Act
            $result = Stylist::getAll();
            // Assert
            $this->assertEquals($test_Store, $result[0]);
        }

    }


?>
