<?php 
/**
* Controlleur des utilisateurs
* @author Amaury Lavieille
*/
namespace Dev2AL\User;


use MvcApp\Components\Controller;
use MvcApp\Components\App;
use MvcApp\Components\AuthManager;
use MvcApp\Components\AppException;


/**
* Controlleur des utilisateurs
*/
class UserController extends Controller
{

    /**
    * initialise le controlleur exemple
    */
    public function __construct()
    {
        $this->name = 'User';
        parent::__construct();
    }

    protected function roles()
    {
        return array(
            array(
                "role" => "*",
                "actions" => array("index","create","save","login")
            ),
            array(
                "role" => "@",
                "actions" => array("logout")
            )

        );

    }
    
    /**
    * Action par défaut
    */
    public function indexAction()
    {
       //   App::getApp()->redirect("article","viewAll");
    }

    /**
    * Affiche le formulaire d'ajout d'un utilisateur 
    **/
    public function createAction()
    {
        
        $user = User::initialize();
        $this->render("create", array(
            "model"=>$user,
        ));

    }

    /**
    * Inscription
    */
    public function saveAction()
    {
        $user = User::initialize();
        if(isset($_POST)) {
            $user = User::initialize($_POST);
           
            if(! is_null(UserDB::getInstance()->findByattribute("email",$user->email))) {
                $user->setErrors("email","L'email est déjà utilisé");
            }
            
            if($user->valid()) {
                 UserDB::getInstance()->save($user);
                 App::getApp()->setFlash("Inscription reussite", "success");
                 App::getApp()->redirect("article","viewAll");
            }
         }

        $this->render("create",array(
            "model"=>$user,
        )); 
    }


    /**
    * Connexion d'un utilisateur
    **/
    public function loginAction()
    {
        $userIdentity = UserIdentity::initialize();

        if(isset($_POST) && ! empty($_POST)){
            $userIdentity = UserIdentity::initialize($_POST);
            
            if($userIdentity->valid()) {
                $user = UserDB::getInstance()->findByattribute("email",$userIdentity->email);
                AuthManager::getInstance()->login($user,$user->statut);
   
                App::getApp()->setFlash("Connexion reussite", "success");
                App::getApp()->redirect("article","viewAll");
            }

        }
        $this->render("login",array(
            "model" => $userIdentity,
        ));
    }

    public function logoutAction()
    {
        AuthManager::getInstance()->logout();
        App::getApp()->setFlash("Deconnexion reussite", "success");
        App::getApp()->redirect("article","viewAll");
    }
        


}
