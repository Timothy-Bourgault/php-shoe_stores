<?php

    /**
    * @backupGlobals disabled
    * @backupsStaticAttributes disabled
    **/

    require_once "src/Brand.php";
    // require_once "src/Store.php";

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

        function test_find()
        {
            // Arrange
            $test_brand = new Brand("Vibram");
            $test_brand->save();
            // Act
            $output = Brand::find($test_brand->getId());
            // Assert
            $this->assertEquals($test_brand, $output);

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
     }
?>
