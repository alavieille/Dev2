<?php
/**
* Classe qui gére le modèle exemple en base de donnée
* @author Amaury Lavieille
*/
namespace Dev2AL\Article;


use MvcApp\Components\Db;

class ArticleDB extends Db
{
    
    /**
    * @param String $dbName Nom de la table 
    */
    
    protected $tableName;


    private $createModelStatement;
    private $updateModelStatement;
    private $deleteModelStatement;
    private $findAllModelStatement;
    private $findModelStatement;

    /**
    * Contructeur protégé, 
    * utiliser getInstance() pour acceder à l'instance de classe
    */
    protected function __construct()
    {
        $this->tableName = "Article";
        parent::__construct();
        $this->createModelStatement = $this->createInsertQuery();
        $this->updateModelStatement = $this->createUpdateQuery();
        $this->deleteModelStatement = $this->createDeleteQuery();
        $this->findAllModelStatement = $this->createSelectAllQuery();
        $this->findModelStatement = $this->createSelectQuery();
    }



    /**
    * Créer la requête preparée pour l'insertion d'un article
    * @return PDO statement 
    */
    private function createInsertQuery()
    {
        $values = "'', :titre, :chapo, :contenue, :auteur, '', NOW(), ''";
        $query = "INSERT INTO ".$this->tableName." VALUES (".$values.")";
        return $this->pdo->prepare($query);
    }

    /**
    * Créer la requête preparée pour la mise jour d'un article 
    * @return PDO statement 
    */
    private function createUpdateQuery()
    {
        $values = "titre=:titre, chapo=:chapo, contenue=:contenue, auteur=:auteur";
        $query = " UPDATE ".$this->tableName." SET ".$values." WHERE id=:id";
        return $this->pdo->prepare($query);
    }   

     /**
    * Créer la requête preparée pour la mise jour d'un article 
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
    public function createSelectAllQuery()
    {
        $query = "  SELECT * FROM ". $this->tableName." ORDER BY id desc";
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
    * Sauvegarde un modele dans la base de donnée
    * @var Object $model
    */
    public function save($model)
    {    
        $this->createModelStatement->bindValue("titre",$model->getTitre());
        $this->createModelStatement->bindValue("chapo",$model->getChapo());
        $this->createModelStatement->bindValue("contenue",$model->getContenue());
        $this->createModelStatement->bindValue("auteur",$model->getAuteur());
        $this->createModelStatement->execute(); 
        return $this->pdo->lastInsertId();
    }

    /**
    * Met à jour un modele dans la base de donnée
    * @var Object $model
    */
    public function update($model)
    {      
        $this->updateModelStatement->bindValue(":id",$model->getId());
        $this->updateModelStatement->bindValue("titre",$model->getTitre());
        $this->updateModelStatement->bindValue("chapo",$model->getChapo());
        $this->updateModelStatement->bindValue("contenue",$model->getContenue());
        $this->updateModelStatement->bindValue("auteur",$model->getAuteur());
        $this->updateModelStatement->execute();    
        return $model->getId();
    }

   /**
    * Supprimer un article
    * @var Object $model
    */
    public function delete($model)
    {       
        $this->deleteModelStatement->bindValue(":id",$model->getId());
        $this->deleteModelStatement->execute(); 

    }


    /**
    * Cherche tous les lignes
    * @return Array array of model
    */
    public function findAll()
    {
        $this->findAllModelStatement->execute();
        $res = array();
        while (($ligne = $this->findAllModelStatement->fetch()) !== false) {
            $res[] = Article::initialize($ligne);
        } 
        return $res;
    }

    /**
    * Cherche une ligne
    * @return Object Model if exist else return null
    */
    public function find($id)
    {  
        $this->findModelStatement->bindValue("id",$id);
        $this->findModelStatement->execute();
        $res = array();
        if($ligne = $this->findModelStatement->fetch()){
            return Article::initialize($ligne);
        }
        return null;
    }
}
