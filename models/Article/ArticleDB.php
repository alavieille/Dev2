<?php
/**
* Classe qui gére le modèle article en base de donnée
* @author Amaury Lavieille
*/
namespace Dev2AL\Article;


use MvcApp\Components\Db;
use \PDO;

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
    private $findLimitModelStatement;
    private $countAllModelStatement;
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
        $this->findLimitModelStatement = $this->createSelectLimitQuery();
        $this->countAllModelStatement = $this->createCountAllQuery();
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
    * Crée la requête préparée pour la selection de $nbrligne lignes à partir de $offset 
    * @return PDO statement
    */
    public function createSelectLimitQuery()
    {
        $query = "  SELECT * FROM ". $this->tableName." ORDER BY id desc LIMIT :offset,:nbrligne";
        return $this->pdo->prepare($query);
    }    

    /**
    * Crée la requête préparée pour compter le nombre de ligne
    * @return PDO statement
    */
    public function createCountAllQuery()
    {
        $query = "  SELECT count(*) as nbr FROM ". $this->tableName;
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
    * Cherche les $nbrLigne à partir de $offset
    * @param int $offset Début de la recherche
    * @param int $nbrLigne Nombre de ligne à rechercher
    * @return Array array of model
    */
    public function findLimit($offset,$nbrligne)
    {
        $this->findLimitModelStatement->bindValue(":offset",$offset,PDO::PARAM_INT);
        $this->findLimitModelStatement->bindValue(":nbrligne",$nbrligne,PDO::PARAM_INT);
        $this->findLimitModelStatement->execute();
        $res = array();
        while (($ligne = $this->findLimitModelStatement->fetch()) !== false) {

            $res[] = Article::initialize($ligne);
        } 
        return $res;
    }

    /**
    * Comtpe le nombre de ligne
    * @return integer
    */
    public function countAll()
    {
        $this->countAllModelStatement->execute();
        if($ligne = $this->countAllModelStatement->fetch()) {
            return (int) $ligne["nbr"];
        }
        return 0;
    }

    /**
    * Cherche une ligne
    * @return Object Model if exist else return null
    */
    public function find($id)
    {  
        $this->findModelStatement->bindValue("id",$id);
        $this->findModelStatement->execute();
        if($ligne = $this->findModelStatement->fetch()) {
            return Article::initialize($ligne);
        }
        return null;
    }
}
