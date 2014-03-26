<?php 
require_once("config/init.php");
require_once("components/App.php");
use MvcApp\Components\App;
use MvcApp\Components\Router;
use MvcApp\Components\Route;

$router = new Router();
/*
$route = new Route("article/create/","Dev2AL\Article\ArticleController","viewAllAction",array(2));
$router->addRoute($route);
*/
App::newApp($config,$router)->run();



?>