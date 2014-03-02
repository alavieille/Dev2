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
          App::getApp()->redirect("article","viewAll");
    }

    public function createAction()
    {
        $article = Article::initialize();
        $this->render("create",array(
            "model"=>$article,
        ));
    }
    
    /**
    * Créé un article
    */
    public function saveAction()
    {     
        if(isset($_POST)) {
            $article = Article::initialize($_POST);
            if($article->valid()) {
                $id = ArticleDB::getInstance()->save($article);
                App::getApp()->redirect("article","view",$id);
            }
        }
        $this->render("create",array(
            "model"=>$article,
        ));
    }

    /**
    * Affiche tous les exemples
    */
    public function viewAllAction($page=1)
    {
        $nbrArticle = ArticleDB::getInstance()->countAll();
        $nbrParPage = 5;
        $nbTotalPage = ceil($nbrArticle/$nbrParPage);

        if( $page <0 || $page>$nbTotalPage) {
            $page = 1;
        }
        
        $offset = ($page-1)*$nbrParPage;
        $arrayArticle = ArticleDB::getInstance()->findLimit($offset,$nbrParPage);
 
        //$arrayArticle = ArticleDB::getInstance()->findAll();
        $this->render("viewAll",array(
            "arrayModel" => $arrayArticle,
            "nbrTotalPage" => $nbTotalPage,
            "page" => $page,
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
    * Mise a un jour d'un article
    * @var Integer id de l'article
    */
    public function updateAction($id)
    {     
        $model = ArticleDB::getInstance()->find($id);
        if(! is_null($model)) {
            $this->render("update",array(
                "model"=>$model,
            ));
        }
        else {
            throw new AppException("Impossible de trouver l'article ".$id);
        }
    }

    /**
    * Confirme la mise à jour d'un article
    */
    public function confirmUpdateAction()
    {     
        if(isset($_POST)) {
            $article = Article::initialize($_POST);
            if($article->valid()) {
                $id = ArticleDB::getInstance()->update($article);
                App::getApp()->redirect("article","view",$id);
            }
        }
        $this->render("create",array(
            "model"=>$article,
        ));
    }

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
