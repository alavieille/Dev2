<?php 
// configuration de l'application

$config = array(
	// nom de l'application 
	"appName" => "Dev2", 
	//namespace principale utilisé dans vos classe( ex: MonApli/Exemple)
	"namespaceApp" => "Dev2AL",
	"path" =>"http://" . $_SERVER['HTTP_HOST'].str_replace("index.php","",$_SERVER["SCRIPT_NAME"]),
	"basePath" => str_replace("index.php","",$_SERVER["SCRIPT_NAME"]),
	// controlleur par defaut
	"defaultController" => "article", 
	"uploadFolder"=>"upload/",
	// information de connexion à la base de donnée
	'db'=>array(
			'dsn' => 'mysql:host=localhost;dbname=Dev2',
			'user' => 'root',
			'pwd' => 'root',

		),

	"extensions" => array(
			"FPDF" => "fpdf/fpdf.php"
		)
	);
