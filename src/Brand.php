<?php

    class Brand
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

// Getters and Setters

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
          $GLOBALS['DB']->exec("INSERT INTO brand(name) VALUES ('{$this->getName()}')");
          $this->id = $GLOBALS['DB']->lastInsertId();
        }

        

// Static Functions

        static function find($search_id)
        {
            $result_brand = null;
            $brands = Brand::getAll();
            foreach($brands as $brand) {
                $brand_id = $brand->getId();
                if ($brand_id == $search_id) {
                    $result_brand = $brand;
                }
            }
            return $result_brand;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brand;");
        }

        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brand;");
            $brands = array();
            foreach($returned_brands as $brand) {
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

    }

?>
