<?php 
/**
* Gestion de la connexion
* @author Amaury lavieille
*/

namespace MvcApp\Components;

class AuthManager
{

  
    protected static $instance = null;
    protected $infosAuthentification = array();

    private function __construct()
    {
        if (isset($_SESSION['infosAuthentification'])) {
            $this->infosAuthentification = $_SESSION['infosAuthentification'];
        } else {
            $this->infosAuthentification = array();
        }
    }

    private function __clone() {}

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function login($user)
    {
    	$_SESSION["user"] = $user;
    }	

    public function logout()
    {
    	unset($_SESSION["user"]);
    }

    public function isLogged()
    {
    	return (isset($_SESSION["user"]));
    }


}

