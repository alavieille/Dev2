<?php 
/**
* Controlleur d'exemple
* @author Amaury Lavieille
*/
namespace Dev2AL\Article;


use MvcApp\Components\Controller;
use MvcApp\Components\App;
use MvcApp\Components\AppException;

/**
* Controlleur d'exemple
*/
class ArticleController extends Controller
{

    /**
    * initialise le controlleur exemple
    */
    public function __construct()
    {
        $this->name = 'Article';
        parent::__construct();
    }

    /**
    * Action par défaut
    */
    public function indexAction()
    {
        $this->render("index");
    }

    public function createAction()
    {
        $article = Article::initialize();
        $this->render("form",array(
            "model"=>$article,
        ));
    }
    
    /**
    * Crée un article
    */
    public function saveAction()
    {     
        if(isset($_POST)) {
            $article = Article::initialize($_POST);
            if($article->valid()) {
                $id = ArticleDB::getInstance()->save($article);
              //  App::getApp()->redirect("exemple","view",$id);
            }
        }
        $this->render("form",array(
            "model"=>$article,
        ));
    }

    /**
    * Affiche tous les exemples
    */
   public function viewAllAction(){
        $arrayArticle = ArticleDB::getInstance()->findAll();
        $this->render("viewAll",array(
            "arrayModel" => $arrayArticle,
        ));
    }   

    /**
    * Affiche un article
    * @var Integer id de l'exemple
    */
    public function viewAction($id)
    {
        $model = ArticleDB::getInstance()->find($id);
        if(! is_null($model)) {
            $this->render("view",array(
                "model"=>$model,
            ));
        }
        else {
            throw new AppException("Impossible de trouver l'article ".$id);
        }
    }

    /**
    * Mise a un jour d'un exemple
    * @var Integer id de l'exemple
    */
   /* public function updateAction($id)
    {     
        $model = ExempleDB::getInstance()->find($id);
        if(! is_null($model)) {
            $this->render("form",array(
                "model"=>$model,
            ));
        }
        else {
            throw new AppException("Impossible de trouver l'exemple ".$id);
        }
    }
*/
    /** 
    * Suppression d'un exemple
    * @var Integer id de l'exemple
    */
    public function deleteAction($id)
    {
        $model = ArticleDB::getInstance()->find($id);
        if(! is_null($model)) {
            $this->render("delete",array(
                "model"=>$model,
            ));
        }
        else {
            throw new AppException("Impossible de trouver l'article ".$id);
        }
    }
    /**
    * Confirme suppression d'un exemple
    * @var Integer id de l'exemple
    */
    public function confirmDeleteAction($id)
    {
        $model = ArticleDB::getInstance()->find($id);
        if(! is_null($model)) {
            ArticleDB::getInstance()->delete($model);
            App::getApp()->setFlash("Article supprimé avec succés","success");
            App::getApp()->redirect("article","viewAll");
        }
        else {
            throw new AppException("Impossible de trouver l'article ".$id);
        }
    }

}
