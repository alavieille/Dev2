<?php
/**
* Classe qui gére le modèle exemple en base de donnée
* @author Amaury Lavieille
*/

namespace MonAppli\Exemple;
use MvcApp\Components\Db;

class ExempleDB extends Db
{
	
	/**
	* @param String $dbName Nom de la table 
	*/
	protected $tableName;


    private $createModelStatement;
    private $findAllModelStatement;
	private $findModelStatement;

	/**
	* Contructeur protégé, 
	* utiliser getInstance() pour acceder à l'instance de classe
	*/
	protected function __construct()
	{
		$this->tableName = "Exemple";
		parent::__construct();
		$this->createModelStatement = $this->createInsertQuery();
        $this->findAllModelStatement = $this->createSelectAllQuery();
		$this->findModelStatement = $this->createSelectQuery();
	}



    /**
    * Créer la requête preparée pour l'insertion suivant le tableau des colonnes $fields fournit
    * @return PDO statement 
    */
    private function createInsertQuery()
    {
    	$values = ":title, :content";
    	$query = "INSERT INTO ".$this->tableName." VALUES ('',".$values.")";
    	return $this->pdo->prepare($query);
    }

    /**
    * Crée la requête préparée pour la selection de tous les lignes
    * @return PDO statement
    */
    public function createSelectAllQuery(){
        $query = "  SELECT * FROM ". $this->tableName." ORDER BY id desc";
        return $this->pdo->prepare($query);
    }

    /**
    * Crée la requête préparée pour la selection d'une ligne
    * @return PDO statement
    */
    public function createSelectQuery(){
        $query = "  SELECT * FROM ". $this->tableName." WHERE id=:id";
        return $this->pdo->prepare($query);
    }

    /**
    * Sauvegarde un modele dans la base de donnée
    * @var Object $model
    */
    public function save($model)
    {
        
        $this->createModelStatement->bindValue("title",$model->getTitle());
        $this->createModelStatement->bindValue("content",$model->getContent());
		$this->createModelStatement->execute();	
        return $this->pdo->lastInsertId();
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
            $res[] = Exemple::initialize($ligne);
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
            return Exemple::initialize($ligne);
        }
        return null;
    }




}
