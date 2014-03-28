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
			'dsn' => 'mysql:host=mysql.info.unicaen.fr;dbname=21004281_9',
			'user' => '21004281',
			'pwd' => 'Lertiotiopen15',
		),

	"extensions" => array(
			"FPDF" => "fpdf/fpdf.php"
		)
	);
