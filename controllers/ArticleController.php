<?php 
/**
* Controlleur des articles
* @author Amaury Lavieille
*/
namespace Dev2AL\Article;

use MvcApp\Components\Controller;
use MvcApp\Components\App;
use MvcApp\Components\AppException;

/**
* Controlleur des article
*/
class ArticleController extends Controller
{

    /**
    * initialise le controlleur article
    */
    public function __construct()
    {
        $this->name = 'Article';
        parent::__construct();
    }

    protected function roles()
    {
        return array(
           array(
                "role" => "*",
                "actions" => array("index","viewAll","view","sendEmail","generatePDF")
            ),
            array(
                "role" => "@",
                "actions" => array("create","save"),
            ),
            array(
                "role" => "@",
                "actions" => array("update","delete","confirmDelete","confirmUpdate"),
                "expression"=>"isAuthor",
            ),
            array(
                "role" => "admin",
                "actions" => array("update","delete","confirmDelete","confirmUpdate"),
            )
        );

    }
    

    /**
    * Verifie si l'utilisateur est l'auteur de l'article
    */
    public function isAuthor($id)
    {

       if(! is_null(App::getApp()->getAuth()->getValue())) 
       {
        $model = ArticleDB::getInstance()->find($id);
        if(! is_null($model)) {
            return (App::getApp()->getAuth()->getValue()->id === $model->auteur);
        }
        else throw new AppException("Impossible de trouver l'article ".$id);
       }
       return false;
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
        $article = Article::initialize();

        if(! is_null(App::getApp()->getRequest()->getPost())) {
            $article = Article::initialize(App::getApp()->getRequest()->getPost());
            $auteur = App::getApp()->getAuth()->getValue();
            $article->auteur = $auteur->id;
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
    * @param $page Numéro de la page par défaut 1
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
    * @param Integer id de l'article
    */
    public function viewAction($id)
    {   
    
        $model = ArticleDB::getInstance()->find($id);
        if(! is_null($model)) {

            $arrayPicture = \Dev2AL\Image\ImageDB::getInstance()->findPictureArticle($id);
            $auteur = \Dev2AL\User\UserDB::getInstance()->find($model->auteur);
            $isAuthor = (!is_null(App::getApp()->getAuth()->getValue())) ? (App::getApp()->getAuth()->getValue()->id == $model->auteur) : false;
            $this->render("view",array(
                "arrayPicture"=>$arrayPicture,
                "model"=>$model,
                "auteur"=>$auteur,
                "isAuthor"=>$isAuthor,
            ));
        }
        else {
            throw new AppException("Impossible de trouver l'article ".$id);
        }
    }

    /**
    * Mise a un jour d'un article
    * @param Integer id de l'article
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
    public function confirmUpdateAction($id)
    {     
       
        if(! is_null(App::getApp()->getRequest()->getPost())) {
            $article = Article::initialize(App::getApp()->getRequest()->getPost());
            $auteur = App::getApp()->getAuth()->getValue();
            $article->auteur = $auteur->id;
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
    * Suppression d'un article
    * @param Integer id de l'article
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
    * Genere l'article au format PDF
    * @param Integer id de l'article
    */
    public function generatePDFAction($id)
    {
        $article = ArticleDB::getInstance()->find($id);
        $arrayPicture = \Dev2AL\Image\ImageDB::getInstance()->findPictureArticle($id);
            if(! is_null($article)) {
                $pdfArticle = new ArticlePDF($article,$arrayPicture);
                $pdfArticle->generate();
                $pdfArticle->Output();
            }
            else {
                throw new AppException("Impossible de trouver l'article ".$id);
            }
    }

    /**
    * Envoie l'article par mail
    * @param Integer id de l'article
    */
    public function sendEmailAction($id)
    {
        
        error_reporting(E_ALL & ~E_STRICT); 
        $model = ArticleDB::getInstance()->find($id);
        $arrayPicture = \Dev2AL\Image\ImageDB::getInstance()->findPictureArticle($id);
            if(! is_null($model)) {

                ob_start();
                 require_once("views/Article/viewEmail.php");
                 $content = ob_get_contents();
                ob_end_clean();

                $to="amaury.lavieille@gmail.com";
                $sender="";
                $subject="tet";
                $headers = array(
                         "From" => $sender,
                         "Reply-To" => $sender,
                         "Subject" => $subject
                         );

                //creation du mail
                $mime=new \Mail_mime("\r\n");
              //  $mime->setTXTBody(utf8_decode($texte));
                $mime->setHTMLBody($content);
                $body=$mime->get();
                $headers=$mime->headers($headers);

                // Envoie du mail
                $mail=& \Mail::factory("mail");
                $mail_sent=$mail->send("amaury.lavieille@gmail.com",$headers,$body);
                if ($mail_sent) {
                    App::getApp()->setFlash("Email envoyé avec succés","success");
                }
                else {
                      App::getApp()->setFlash("Erreur lors de l'envoi de l'email","error");
                }
                App::getApp()->redirect("article","view",$id);

            }
            else {
                throw new AppException("Impossible de trouver l'article ".$id);
            }
    }

    /**
    * Confirme suppression d'un article
    * @var Integer id de l'article
    */
    public function confirmDeleteAction($id)
    {
        $model = ArticleDB::getInstance()->find($id);
        if(! is_null($model)) {
    
            $arrayPicture = \Dev2AL\Image\ImageDB::getInstance()->findPictureArticle($model->id);
            foreach ($arrayPicture as $image) {
                unlink(App::getApp()->getConfig("uploadFolder").$image->getFile());
            }
            ArticleDB::getInstance()->delete($model);
            \Dev2AL\Image\ImageDB::getInstance()->deleteAllImageArticle($model);
            App::getApp()->setFlash("Article supprimé avec succés","success");
            App::getApp()->redirect("article","viewAll");
        }
        else {
            throw new AppException("Impossible de trouver l'article ".$id);
        }
    }

}
