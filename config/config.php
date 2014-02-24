<?php 
// configuration de l'application
$config = array(
	// nom de l'application 
	"appName" => "MvcApp", 
	//namespace principale utilisé dans vos classe( ex: MonApli/Exemple)
	"namespaceApp" => "MonAppli",
	"basePath" => str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"]),
	// controlleur par defaut
	"defaultController" => "exemple", 
	);
