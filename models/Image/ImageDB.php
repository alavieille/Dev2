<?php
/**
* Classe qui gére le modèle image en base de donnée
* @author Amaury Lavieille
*/
namespace Dev2AL\Image;

use MvcApp\Components\ModelDB;
use \PDO;

class ImageDB extends ModelDB
{
    
    /**
    * @param String $dbName Nom de la table 
    */
    
    protected $tableName;


    private $findPictureArticleStatement;
    private $deleteAllModelStatement;


    /**
    * Contructeur protégé, 
    * utiliser getInstance() pour acceder à l'instance de classe
    */
    protected function __construct()
    {
        $this->tableName = "Image";
        $this->className = "\\".__NAMESPACE__."\\"."Image";
        parent::__construct();

        $this->findPictureArticleStatement = $this->createSelectPictureArticleQuery();
        $this->deleteAllModelStatement = $this->createDeleteAllImageQuery();


    }


    protected function queryData($model)
    {
        return array(
            "titre" => $model->titre,
            "file" => $model->file,
            "idArticle" => $model->idArticle,
        );
    }

    protected function partQuery()
    {
        $sql = " SET titre=:titre, file=:file, idArticle=:idArticle";
        return $sql;
    }

    /**
    * Crée la requête préparée pour la selection de tous les lignes
    * @return PDO statement
    */
    public function createSelectPictureArticleQuery()
    {
        $query = "  SELECT * FROM ". $this->tableName." WHERE idArticle=:idArticle";
        return $this->pdo->prepare($query);
    }    
  
    /**
    * Créer la requête preparée pour suppression des images d'un article
    * @return PDO statement 
    */
    private function createDeleteAllImageQuery()
    {
        $query = "DELETE FROM ".$this->tableName." WHERE idArticle=:idArticle";
        return $this->pdo->prepare($query);
    }


    /**
    * Cherche les images d'un article
    * @return Array array of model
    */
    public function findPictureArticle($idArticle)
    {
        
        $this->findPictureArticleStatement->bindValue(":idArticle",$idArticle);
        $this->findPictureArticleStatement->execute();

        $res = array();
        while (($ligne = $this->findPictureArticleStatement->fetch()) !== false) {
            $res[] = Image::initialize($ligne);
        } 
        return $res;
    }

 
     /**
    * Supprimer un article
    * @var Object $model
    */
    public function deleteAllImageArticle($modelArticle)
    {       
       $this->deleteAllModelStatement->bindValue(":idArticle",$modelArticle->id);
       $this->deleteAllModelStatement->execute(); 

    }


}
