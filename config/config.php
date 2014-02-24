<?php 
// configuration de l'application
$config = array(
	// nom de l'application 
	"appName" => "MvcApp", 
	//namespace principale utilisé dans vos classe( ex: MonApli/Exemple)
	"namespaceApp" => "MonAppli",
	"path" =>dirname(__FILE__).DIRECTORY_SEPARATOR."..",
	"basePath" => str_replace("index.php","",$_SERVER["SCRIPT_NAME"]),
	// controlleur par defaut
	"defaultController" => "exemple", 
	// information de connexion à la base de donnée
	'db'=>array(
			'dsn' => 'mysql:host=localhost;dbname=libebook',
			'user' => 'root',
			'pwd' => '',

		),
	);
