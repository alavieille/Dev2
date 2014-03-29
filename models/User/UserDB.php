<?php
/**
* Classe qui gére le modèle user en base de donnée
* @author Amaury Lavieille
*/
namespace Dev2AL\User;


use MvcApp\Components\ModelDB;

class UserDB extends ModelDB
{
    

    /**
    * Contructeur protégé, 
    * utiliser getInstance() pour acceder à l'instance de classe
    */
    protected function __construct()
    {
        $this->tableName = "User";
        $this->className = "\\".__NAMESPACE__."\\"."User";
        parent::__construct();

    
    }

 
    protected function queryData($model)
    {
        return array(
            "email" => $model->email,
            "password" => $model->password,
            "nom" => $model->nom,
            "prenom" => $model->prenom,
            "statut" => $model->statut
        );
    }


    protected function partQuery()
    {
        $sql = " SET email=:email, password=:password, nom=:nom, prenom=:prenom, statut=:statut ";
        return $sql;
    }



}
