<?php
/**
* Classe qui gére le modèle article en base de donnée
* @author Amaury Lavieille
*/
namespace Dev2AL\Article;


use MvcApp\Components\ModelDB;

class ArticleDB extends ModelDB
{
    

    /**
    * Contructeur protégé, 
    * utiliser getInstance() pour acceder à l'instance de classe
    */
    protected function __construct()
    {
        $this->tableName = "Article";
        $this->className = "\\".__NAMESPACE__."\\"."Article";
        parent::__construct();

    
    }

 
    protected function queryData($model)
    {
        return array(
            "titre" => $model->getTitre(),
            "chapo" => $model->getChapo(),
            "contenue" => $model->getContenue(),
            "auteur" => $model->getAuteur()
        );
    }


    protected function partQuery()
    {
        $sql = " SET titre=:titre, chapo=:chapo, contenue=:contenue, auteur=:auteur, date_creation=NOW() ";
        return $sql;
    }



}
