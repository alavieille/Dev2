<?php 
require_once("config/init.php");
require_once("components/App.php");
use MvcApp\Components\App;

App::newApp($config)->run();



?>