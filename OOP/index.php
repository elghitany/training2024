<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Classes\Authentication;

include "__autoload.php";
$name = $_POST['name'];
$authentication = new Authentication();
$authentication->signup($name, "peter.nassef@gmail.com", "123");
$authentication->login("peter.nassef@gmail.com", "123");
$authentication->logout();
$users = new \Classes\Users();
var_dump($users->getAll());
//var_dump(Authentication::isLoggedIn());
