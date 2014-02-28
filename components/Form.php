<?php
/**
* Classe pour créer et gérer un formulaire
* @author Amaury Lavieille
*/

namespace MvcApp\Components;

/**
* Classe qui représente un formulaire
*/
class Form 
{	
	/**
	* @param String $action 
	*/
	private $action;
	
	/**
	* @param Array $htmlOptions
	*/
	private $htmlOptions;
	
	/**
	* @param String $method
	*/
	private $method;

	/**
	* @param Object $model
	*/
	private $model;

	/**
	* Constructeur
	* @var Object $model Model utilisé pour le formulaire
	* @var String $action action lors de la validation
	* @var Array $htmlOptions exemple array("id"=>"monid")
	* @var String $method $_GET ou $_POST par défaut POST
	*/
	public function __construct($model,$action,$htmlOptions=array(),$method="post")
	{
		$this->action = $action;
		$this->model = $model;
		$this->htmlOptions = $htmlOptions;
		$this->method = $method;
	}

	/**
	* Retourne la balise ouvrante d'un formulaire
	*/
	public function beginForm()
	{
		$res = "";
		$res .= "<form action='".$this->action."' method='".$this->method."' ";
		foreach ($this->htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$res .= "/>\n";
		echo $res;
	}

	/**
	* Affiche la balise fermante du formulaire
	**/
	public function endForm()
	{
		echo "</form>\n";
	}

	/**
	* Ajoute un label
	* @var String $name champ for du label
	* @var String $content contenue du label
	* @var Array $htmlOptions 
	*/
	public function label($name,$content,$htmlOptions=array())
	{
		$res = "<label for='".$name."' ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$res .= ">".$content."</label>\n";
		return $res;
	}


	/**
	* Ajoute un input texte
	* @var String $name name de l'input
	* @var Array $htmlOptions 
	*/
	public function inputText($name, $htmlOptions=array())
	{
		$res = "";	

		if(isset($this->model->getErrors()[$name])) {
			$htmlOptions['class'] = isset($htmlOptions["class"])? $htmlOptions["class"] : "";
			$htmlOptions['class'] .= " error";
		}

		$res .= "<input type='text' id='".$name."' name='".$name."' ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$methodGet = "get".ucfirst($name);
		$res .="value='".$this->model->$methodGet()."'";
		$res .="/>\n";

		if(isset($this->model->getErrors()[$name])) {
			$res .= "<small class='error'>".$this->model->getErrors()[$name]."</small>\n";
		}
		return $res;
	}

	/**
	* Ajoute un input email
	* @var String $name name de l'input
	* @var Array $htmlOptions 
	*/
	public function inputEmail($name, $htmlOptions=array())
	{
		$res = "";	

		if(isset($this->model->getErrors()[$name])) {
			$htmlOptions['class'] = isset($htmlOptions["class"])? $htmlOptions["class"] : "";
			$htmlOptions['class'] .= " error";
		}

		$res .= "<input type='email' id='".$name."' name='".$name."' ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$methodGet = "get".ucfirst($name);
		$res .="value='".$this->model->$methodGet()."'";
		$res .="/>\n";

		if(isset($this->model->getErrors()[$name])) {
			$res .= "<small class='error'>".$this->model->getErrors()[$name]."</small>\n";
		}
		return $res;
	}

	/**
	* Ajoute un input hidden
	* @var String $name name de l'input
	* @var Array $htmlOptions 
	*/
	public function inputHidden($name, $htmlOptions=array())
	{
		$res = "";	

		if(isset($this->model->getErrors()[$name])) {
			$htmlOptions['class'] = isset($htmlOptions["class"])? $htmlOptions["class"] : "";
			$htmlOptions['class'] .= " error";
		}

		$res .= "<input type='hidden' id='".$name."' name='".$name."' ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$methodGet = "get".ucfirst($name);
		$res .="value='".$this->model->$methodGet()."'";
		$res .="/>\n";

		if(isset($this->model->getErrors()[$name])) {
			$res .= "<small class='error'>".$this->model->getErrors()[$name]."</small>\n";
		}
		return $res;
	}

	/**
	* Ajoute un input password
	* @var String $name name de l'input
	* @var Array $htmlOptions 
	*/
	public function inputPassword($name, $htmlOptions=array())
	{
		$res = "";	

		if(isset($this->model->getErrors()[$name])) {
			$htmlOptions['class'] = isset($htmlOptions["class"])? $htmlOptions["class"] : "";
			$htmlOptions['class'] .= " error";
		}

		$res .= "<input type='password' id='".$name."' name='".$name."' ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$methodGet = "get".ucfirst($name);
		$res .="value='".$this->model->$methodGet()."'";
		$res .="/>\n";

		if(isset($this->model->getErrors()[$name])) {
			$res .= "<small class='error'>".$this->model->getErrors()[$name]."</small>\n";
		}
		return $res;
	}

	/**
	* Ajoute un input file
	* @var String $name name de l'input
	* @var Array $htmlOptions 
	*/
	public function inputFile($name, $htmlOptions=array())
	{
		$res = "";	

		if(isset($this->model->getErrors()[$name])) {
			$htmlOptions['class'] = isset($htmlOptions["class"])? $htmlOptions["class"] : "";
			$htmlOptions['class'] .= " error";
		}

		$res .= "<input type='file' id='".$name."' name='".$name."' ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$methodGet = "get".ucfirst($name);
		$res .="/>\n";

		if(isset($this->model->getErrors()[$name])) {
			$res .= "<small class='error'>".$this->model->getErrors()[$name]."</small>\n";
		}
		return $res;
	}

	/**
	* Ajoute un input date
	* @var String $name name de l'input
	* @var Array $htmlOptions 
	*/
	public function inputDate($name, $htmlOptions=array())
	{
		$res = "";	

		if(isset($this->model->getErrors()[$name])) {
			$htmlOptions['class'] = isset($htmlOptions["class"])? $htmlOptions["class"] : "";
			$htmlOptions['class'] .= " error";
		}

		$res .= "<input type='date' id='".$name."' name='".$name."' ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$methodGet = "get".ucfirst($name);
		$res .="value='".$this->model->$methodGet()."'";
		$res .="/>\n";

		if(isset($this->model->getErrors()[$name])) {
			$res .= "<small class='error'>".$this->model->getErrors()[$name]."</small>\n";
		}
		return $res;
	}

	/**
	* Ajoute un input number
	* @var String $name name de l'input
	* @var Array $htmlOptions 
	*/
	public function inputNumber($name, $htmlOptions=array())
	{
		$res = "";	

		if(isset($this->model->getErrors()[$name])) {
			$htmlOptions['class'] = isset($htmlOptions["class"])? $htmlOptions["class"] : "";
			$htmlOptions['class'] .= " error";
		}

		$res .= "<input type='number' id='".$name."' name='".$name."' ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$methodGet = "get".ucfirst($name);
		$res .="value='".$this->model->$methodGet()."'";
		$res .="/>\n";

		if(isset($this->model->getErrors()[$name])) {
			$res .= "<small class='error'>".$this->model->getErrors()[$name]."</small>\n";
		}
		return $res;
	}	

	/**
	* Ajoute un input url
	* @var String $name name de l'input
	* @var Array $htmlOptions 
	*/
	public function inputUrl($name, $htmlOptions=array())
	{
		$res = "";	

		if(isset($this->model->getErrors()[$name])) {
			$htmlOptions['class'] = isset($htmlOptions["class"])? $htmlOptions["class"] : "";
			$htmlOptions['class'] .= " error";
		}

		$res .= "<input type='url' id='".$name."' name='".$name."' ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$methodGet = "get".ucfirst($name);
		$res .="value='".$this->model->$methodGet()."'";
		$res .="/>\n";

		if(isset($this->model->getErrors()[$name])) {
			$res .= "<small class='error'>".$this->model->getErrors()[$name]."</small>\n";
		}
		return $res;
	}

	/**
	* Ajoute un input tel
	* @var String $name name de l'input
	* @var Array $htmlOptions 
	*/
	public function inputTel($name, $htmlOptions=array())
	{
		$res = "";	

		if(isset($this->model->getErrors()[$name])) {
			$htmlOptions['class'] = isset($htmlOptions["class"])? $htmlOptions["class"] : "";
			$htmlOptions['class'] .= " error";
		}

		$res .= "<input type='tel' id='".$name."' name='".$name."' ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$methodGet = "get".ucfirst($name);
		$res .="value='".$this->model->$methodGet()."'";
		$res .="/>\n";

		if(isset($this->model->getErrors()[$name])) {
			$res .= "<small class='error'>".$this->model->getErrors()[$name]."</small>\n";
		}
		return $res;
	}

	/**
	* Ajoute un input checkbox
	* @var String $name name de l'input
	* @var String $value 
	* @var Boolean $checked bouton coché ou non
	* @var Array $htmlOptions 
	*/
	public function inputCheckbox($name, $value, $checked=false, $htmlOptions=array())
	{
		$res = "";	

		if(isset($this->model->getErrors()[$name])) {
			$htmlOptions['class'] = isset($htmlOptions["class"])? $htmlOptions["class"] : "";
			$htmlOptions['class'] .= " error";
		}

		$res .= "<input type='checkbox' id='".$name."' name='".$name."' ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$res .="value='".$value."'";
		if($checked) {
			$res .= " checked";
		}
		$res .="/>\n";

		if(isset($this->model->getErrors()[$name])) {
			$res .= "<small class='error'>".$this->model->getErrors()[$name]."</small>\n";
		}
		return $res;
	}


	/**
	* Ajoute un textarea
	* @var String $name name de l'input
	* @var Array $htmlOptions 
	*/
	public function textarea($name, $htmlOptions=array())
	{
		$res = "";	

		if(isset($this->model->getErrors()[$name])) {
			$htmlOptions['class'] = isset($htmlOptions["class"])? $htmlOptions["class"] : "";
			$htmlOptions['class'] .= " error";
		}

		$res .= "<textarea id='".$name."' name='".$name."' ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$methodGet = "get".ucfirst($name);
		$res .= "/>\n";
		$res .= $this->model->$methodGet();
		$res .= "</textarea>\n";

		if(isset($this->model->getErrors()[$name])) {
			$res .= "<small class='error'>".$this->model->getErrors()[$name]."</small>\n";
		}
		return $res;
	}

	/**
	* Ajoute bouton submit
	* @var String $value
	* @var Array $htmlOptions 
	*/
	public function submit($value,$htmlOptions=array())
	{
		$res = "";	
		$htmlOptions['class'] = isset($htmlOptions["class"])? $htmlOptions["class"] : "";
		$htmlOptions['class'] .= " button";
		$res .= "<input type='submit'  ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$res .="value='".$value."'";
		$res .="/>\n";
		return $res;
	}

	/**
	* Ajoute un bouton 
	* @var String $name name de l'input
	* @var String $value
	* @var Array $htmlOptions 
	*/
	public function button($name,$value,$htmlOptions=array())
	{
		$res = "";	
		$res .= "<input type='button' id='".$name."' name='".$name."' ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$res .="value='".$value."'";
		$res .="/>\n";
		return $res;
	}

	/**
	* Ajoute un input radio
	* @var String $name name de l'input
	* @var String $value
	* @var Array $htmlOptions 
	*/
	public function inputRadio($name, $value, $htmlOptions=array())
	{
		$res = "";	

		if(isset($this->model->getErrors()[$name])) {
			$htmlOptions['class'] = isset($htmlOptions["class"])? $htmlOptions["class"] : "";
			$htmlOptions['class'] .= " error";
		}

		$res .= "<input type='radio' id='".$name."' name='".$name."' ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$res .="value='".$value."'";
		$res .="/>\n";

		if(isset($this->model->getErrors()[$name])) {
			$res .= "<small class='error'>".$this->model->getErrors()[$name]."</small>\n";
		}
		return $res;
	}

	/**
	* Ajoute select 
	* @var String $name name de l'input
	* @var Array $htmlOptions 
	*/
	public function selectOption($name, $options,$htmlOptions=array())
	{
		$res = "";	

		if(isset($this->model->getErrors()[$name])) {
			$htmlOptions['class'] = isset($htmlOptions["class"])? $htmlOptions["class"] : "";
			$htmlOptions['class'] .= " error";
		}

		$res .= "<select id='".$name."' name='".$name."' ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$res .= ">\n";
		foreach ($options as $value => $content) {
			$res .= "<option value='".$value."' >".$content."</option>\n";
		}

		$res .= "</seclect>\n";

		if(isset($this->model->getErrors()[$name])) {
			$res .= "<small class='error'>".$this->model->getErrors()[$name]."</small>\n";
		}
		
		return $res;
	}


}



