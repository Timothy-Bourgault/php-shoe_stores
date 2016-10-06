# _shoe_stores_

#### _An application that allows users to find all stores in town that carry a certain brand, or look at a specific store to see what brands they carry, Friday, October 5, 2016_

#### By _**Tim Bourgault**_

## Description

_Shows search results for either brand of shoes, or stores and what brands they carry individually._

| Behavior |      Input    | Output|
|----------|:-------------:|:-----:|
| App can return the name of a store entered | Input: "Shoe Carnival" | Output: "Shoe Carnival" |
| App allows for a store's name to be updated | Saved Name: "Shoe Carnival" Input: "Shoe Circus" | Output: "Shoe Circus" |
| App allows for store information to be saved and assigns the store an Id | Input: "Shoe Circus" | Output Saved: name - "Shoe Circus", id - "1" |
| App allows for a single store to be erased | Input: push "Remove This Store" button/ Example Store: "Shoe Circus" | Output: "" |
| App allows for entire list of stores entered to be erased in one fell swoop | Input: push "Clear Store List" button/ Example List: "Shoe Circus", "Just For Feet"| Output Example List: "" |
| App allows for a brand to be added to a store's brand list| Input: "Keds"/ Example Store Brand List: "Vibram", "Adidas" | Output Updated List: "Vibram", "Adidas", "Keds" |
| App returns a list of brands sold in a store when the store's name is searched | Input Brand Search By Store: "Vagabond Shoes" | Output Brands: "Vibram", "Adidas", "Keds" |
| App can return the name of a brand entered | Input: "Vibram" | Output: "Vibram" |
| App allows for brand information to be saved and assigns the brand an Id | Input: "Adidas" | Output Saved: name - "Adidas", id - "1" |
| App returns a list of stores that stock a brand when the brand's name is searched | Input Store Search By Brand: "Vibram" | Output Stores: "Vagabond Shoes", "Marshalls", "REI" |


## SQL Commands Used
* _CREATE DATABASE (database name);_
* _USE (database name);_
* _SELECT DATABASES;_
* _SHOW DATABASE;_
* _CREATE TABLE stylists (name VARCHAR (255), specialties VARCHAR (255), scheduled days VARCHAR (255));_
* _CREATE TABLE clientel (name VARCHAR (255), regular_specialties VARCHAR (255), appointment DATE, appointment_time TIME);_
* _ALTER TABLE (table name) ADD id serial PRIMARY KEY;_
* _INSERT INTO (table name) (name, scheduled_days, specialties) VALUES ('Sally', 'Monday, Wednesday, and Friday', 'cut, color, curl, style, scalp massage');_
* _SELECT * FROM (table name);_
* _ALTER TABLE (table name) DROP (column name);_
* _CREATE TABLE (join table name) (id serial PRIMARY KEY, category_id int, task_id int);_
* _DROP DATABASE shoe_stores_test;_

## Setup/Installation Requirements

* _Clone the program from it's github repository_
* _Navigate to the project directory in a command line software_
* _Type: "cd web" to move into the "web" folder_
* _Type: "php -S localhost:8000" to create a local server for the project_
* _Open the browser of your choice and type in this URL to load the project: "localhost:8000:_
* _You can also view the page online at the URL: timothy-bourgault.github.io/hair_salon


## Known Bugs

_There are no known bugs_

## Support and contact details

_If any issues arise, please send notification to tim.bourgault@gmail.com. Thanks!_

## Technologies Used

_Written using PHP, Silex, PHPUnit testing, Twig, and Bootstrap, MAMP Local Servers: MySQL and Apache_

### License

*This product can be used in accordance with the provisions under its MIT license.*

Copyright (c) 2016 **_Tim Bourgault_**
