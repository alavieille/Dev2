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
	}



    /**
    * Créer la requête preparée pour l'insertion suivant le tableau des colonnes $fields fournit
    * @return PDO statement 
    */
    private function createInsertQuery()
    {
    	$values = ":id, :title, :content";
    	$query = "INSERT INTO ".$this->tableName." VALUES (".$values.")";
    	return $this->pdo->prepare($query);
    }

    /**
    * Crée la requête préparée pour la selection de tous les lignes
    * @return PDO statement
    */
    public function createSelectAllQuery(){
        $query = "  SELECT * FROM ". $this->tableName;
        return $this->pdo->prepare($query);
    }

    /**
    * Sauvegarde un modele dans la base de donnée
    * @var Object $model
    */
    public function save($model)
    {
        $this->createModelStatement->bindValue("id",$model->getID());
        $this->createModelStatement->bindValue("title",$model->getTitle());
        $this->createModelStatement->bindValue("content",$model->getContent());
		$this->createModelStatement->execute();	
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




}
