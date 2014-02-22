<?php 

//require components
require_once("components/Controller.php");

//definie constante
DEFINE("BASE_PATH",str_replace("index.php","",$_SERVER["SCRIPT_NAME"]));
DEFINE("DEFAULT_CONTROLLER","exemple"); // controlleur par défaut

?>