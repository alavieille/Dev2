<?php 
/**
* Controlleur des utilisateurs
* @author Amaury Lavieille
*/
namespace Dev2AL\User;


use MvcApp\Components\Controller;
use MvcApp\Components\App;
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


    public function saveAction()
    {
        if(isset($_POST)) {
            $user = User::initialize($_POST);
            var_dump(UserDB::getInstance()->findByattribute("email",$user->email));
           /* if(! isset(UserDB::getInstance()->findByattribute("email",$user->email))) {
                $user->setErrors("email","L'email est déjà utilisé");
            }
            */
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
        


}
