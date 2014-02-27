<?php
/**
* classe qui permet de gerer les message flahs
* @author Amaury Lavieille
*/
namespace MvcApp\Components;

/**
* Classe qui représente un message flash
*/
class FlashMessage
{

	
	/**
	* Contruit un message
	*/
	public function __construct()
	{
		
	}	

	/**
	* Ajout un message flash
	* @var String $message contenue du message
	* @var String $type type du message
	*/
	public static function setFlash($message,$type = "")
	{
		$_SESSION["flashApp"] = array(
			"message" => $message,
			"type" => $type
		);

	}


	/**
	* Recupére les messages flash
	* @return String
	*/
	public static function getFlash()
	{
		if(isset($_SESSION["flashApp"])) {
			$res = "";
			$res .= "<div class='row' >\n";
			$res .= "<div data-alert class='alert-box ".$_SESSION["flashApp"]["type"]."'>\n";
			$res .= $_SESSION["flashApp"]["message"];
			$res .= "<a href='#' class='close'>x</a>\n";
			$res .= "</div>\n";
			$res .= "</div>\n";
			unset($_SESSION["flashApp"]);
			return $res;
		}
	}
}

