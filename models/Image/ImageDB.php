<?php
/**
* Classe qui gére le modèle image en base de donnée
* @author Amaury Lavieille
*/
namespace Dev2AL\Image;


use MvcApp\Components\Db;
use \PDO;

class ImageDB extends Db
{
    
    /**
    * @param String $dbName Nom de la table 
    */
    
    protected $tableName;


    private $createModelStatement;
    private $deleteModelStatement;
    private $findPictureArticleStatement;
    private $findModelStatement;


    /**
    * Contructeur protégé, 
    * utiliser getInstance() pour acceder à l'instance de classe
    */
    protected function __construct()
    {
        $this->tableName = "Image";
        parent::__construct();
        $this->createModelStatement = $this->createInsertQuery();
        $this->deleteModelStatement = $this->createDeleteQuery();
        $this->findPictureArticleStatement = $this->createSelectPictureArticleQuery();
        $this->findModelStatement = $this->createSelectQuery();

    }



    /**
    * Créer la requête preparée pour l'insertion d'une image
    * @return PDO statement 
    */
    private function createInsertQuery()
    {
        $values = "'', :idArticle, :titre, :file";
        $query = "INSERT INTO ".$this->tableName." VALUES (".$values.")";
        return $this->pdo->prepare($query);
    }

   
    /**
    * Crée la requête préparée pour la selection d'une ligne
    * @return PDO statement
    */
    public function createSelectQuery()
    {
        $query = "  SELECT * FROM ". $this->tableName." WHERE id=:id";
        return $this->pdo->prepare($query);
    }

    /**
    * Créer la requête preparée pour la mise jour d'une image 
    * @return PDO statement 
    */
    private function createDeleteQuery()
    {
        $query = "DELETE FROM ".$this->tableName." WHERE id=:id";
        return $this->pdo->prepare($query);
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
    * Sauvegarde un modele dans la base de donnée
    * @var Object $model
    */
    public function save($model)
    {    
        $this->createModelStatement->bindValue("titre",$model->getTitre());
        $this->createModelStatement->bindValue("file",$model->getFile());
        $this->createModelStatement->bindValue("idArticle",$model->getIdArticle());
        $this->createModelStatement->execute(); 
        return $this->pdo->lastInsertId();
    }

   /**
    * Supprimer une image
    * @var Object $model
    */
    public function delete($model)
    {       
        $this->deleteModelStatement->bindValue(":id",$model->getId());
        $this->deleteModelStatement->execute(); 

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
    * Cherche une image
    * @return Array array of model
    */
    public function find($id)
    {
        
        $this->findModelStatement->bindValue("id",$id);
        $this->findModelStatement->execute();
        if($ligne = $this->findModelStatement->fetch()) {
            return Image::initialize($ligne);
        }
        return null;
    }

  

}
