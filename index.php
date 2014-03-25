<?php 
require_once("config/init.php");
require_once("components/App.php");
use MvcApp\Components\App;
use MvcApp\Components\Router;

$router = new Router();
App::newApp($config,$router)->run();



?>