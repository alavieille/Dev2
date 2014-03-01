<?php 
// configuration de l'application
$config = array(
	// nom de l'application 
	"appName" => "MvcApp", 
	//namespace principale utilisé dans vos classe( ex: MonApli/Exemple)
	"namespaceApp" => "Dev2AL",
	"path" =>dirname(__FILE__).DIRECTORY_SEPARATOR."..",
	"basePath" => str_replace("index.php","",$_SERVER["SCRIPT_NAME"]),
	// controlleur par defaut
	"defaultController" => "article", 
	// information de connexion à la base de donnée
	'db'=>array(
			'dsn' => 'mysql:host=localhost;dbname=Dev2',
			'user' => 'root',
			'pwd' => 'root',

		),
	);
