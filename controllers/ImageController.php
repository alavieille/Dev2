<?php 
/**
* Controlleur des images
* @author Amaury Lavieille
*/
namespace Dev2AL\Image;
use Dev2AL\Article\ArticleDB;


use MvcApp\Components\Controller;
use MvcApp\Components\App;
use MvcApp\Components\AppException;
use MvcApp\Components\Upload;


/**
* Controlleur des images
*/
class ImageController extends Controller
{

    /**
    * initialise le controlleur exemple
    */
    public function __construct()
    {
        $this->name = 'Image';
        parent::__construct();
    }

    protected function roles()
    {
       return array(
            array(
                "role" => "*",
                "actions" => array("index")
            ),
            array(
                "role" => "@",
                "actions" => array("create","save"),
                "expression" => "isAuthorArticle",
            ),

            array(
                "role" => "@",
                "actions" => array("delete"),
                "expression" => "isAuthor",
            ),

            array(
                "role" => "admin",
                "actions" => array("create","save","delete"),
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
    * Verifie si l'utilisateur est l'auteur de l'image
    */
    public function isAuthorArticle($id)
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
    * Verifie si l'utilisateur est l'auteur de l'article
    */
    public function isAuthor($id)
    {
       if(! is_null(App::getApp()->getAuth()->getValue())) 
       {
        $model = ImageDB::getInstance()->find($id);
        if(! is_null($model)) {
            $article =  ArticleDB::getInstance()->find($model->idArticle);
            return (App::getApp()->getAuth()->getValue()->id === $article->auteur);
        }
        else throw new AppException("Impossible de trouver l'image ".$id);
       }
       return false;
    }

    /**
    * Affiche le formulaire d'ajout d'une image 
    * @param Int $idArticle  id de l'article
    **/
    public function createAction($idArticle)
    {
       
        $image = Image::initialize();
        $this->render("create",array(
            "idArticle"=>$idArticle,
            "model"=>$image,
        ));
    }
        

    public function saveAction($idArticle)
    {
        $image = Image::initialize();
        if(! is_null(App::getApp()->getRequest()->getPost())) {
            $data = App::getApp()->getRequest()->getPost();
            $data["idArticle"] = $idArticle;
            $image = Image::initialize($data);
            if($image->valid()) {
                
                if( !exif_imagetype($_FILES["fileUpload"]["tmp_name"])){
                    $image->setErrors("fileUpload","Le fichier n'est pas une image");
                }

                else {
                    $upload = new Upload($_FILES["fileUpload"]);
                    try {

                        $image->file = $upload->save(App::getApp()->getConfig("uploadFolder"));
                        ImageDB::getInstance()->save($image);
                        App::getApp()->redirect("article","view",$idArticle);

                    } catch (Exception $e) {
                        App::getApp()->setFlash("Impossible d'envoyer la photo","error");
                    }
                }
            }
        }
        $this->render("create",array(
            "idArticle"=>$idArticle,
            "model"=>$image,
        ));
    }


    /**
    * Supprime une image
    * @param $id id de l'image 
    */
    public function deleteAction($id)
    {
        $image = ImageDB::getInstance()->find($id);
        unlink(App::getApp()->getConfig("uploadFolder").$image->file);
        ImageDB::getInstance()->delete($image);
        App::getApp()->redirect("article","view",$image->idArticle);
    }
    

}
