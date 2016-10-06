<?php

    class Store
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
            $GLOBALS['DB']->exec("INSERT INTO store(name) VALUES ('{$this->getName()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function updateName($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE store SET name = '{$new_name}' WHERE id = {$this->id};");
            $this->setName($new_name);
        }

        function deleteStore()
        {
            $GLOBALS['DB']->exec("DELETE FROM store WHERE id = {$this->id};");
        }

        function addBrand($new_brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO store_brand (brand_id, store_id) VALUES ({$new_brand->getId()}, {$this->id});");
        }

        function getStoreBrands()
        {
            $returned_store_brands = $GLOBALS['DB']->query("SELECT brand.*                          FROM store
                JOIN store_brand ON (store_brand.store_id = store.id)
                JOIN brand ON (store_brand.brand_id = brand.id)
                WHERE store.id = {$this->getId()};");
            $brands = array();
            foreach($returned_store_brands as $brand) {
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }


// Static Functions

        static function find($search_id)
        {
            $result_store = null;
            $stores = Store::getAll();
            foreach($stores as $store) {
                $store_id = $store->getId();
                if ($store_id == $search_id) {
                    $result_store = $store;
                }
            }
            return $result_store;
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM store;");
            $stores = array();
            foreach($returned_stores as $store) {
                $name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM store;");
        }



    }


?>
