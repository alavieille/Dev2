<?php 

//require components
require_once("components/Controller.php");

// configuration de l'application
$config = array(
	"appName" => "Dev2",
	"basePath" => str_replace("index.php","",$_SERVER["SCRIPT_NAME"]),
	"defaultController" => "exemple",
	);
