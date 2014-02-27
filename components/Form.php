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
		echo $this->beginForm();
	}

	/**
	* Retourne la balise ouvrante d'un formulaire
	*/
	private function beginForm()
	{
		$res = "";
		$res .= "<form action='".$this->action."' method='".$this->method."' ";
		foreach ($this->htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$res .= "/>\n";
		return $res;
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
	* Ajoute un input search
	* @var String $name name de l'input
	* @var Array $htmlOptions 
	*/
	public function inputCheckbox($name, $htmlOptions=array())
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
		$methodGet = "get".ucfirst($name);
		$res .="value='".$this->model->$methodGet()."'";
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
	* @var String $name name de l'input
	* @var String $value
	* @var Array $htmlOptions 
	*/
	public function submit($name,$value,$htmlOptions=array())
	{
		$res = "";	
		$res .= "<input type='submit' id='".$name."' name='".$name."' ";
		foreach ($htmlOptions as $option => $valeur) {
			$res .= $option."='".$valeur."' ";
		}
		$methodGet = "get".ucfirst($name);
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
		$methodGet = "get".ucfirst($name);
		$res .="value='".$value."'";
		$res .="/>\n";
		return $res;
	}

// <select name="select">
//   <option value="value1">Valeur 1</option> 
//   <option value="value2" selected>Valeur 2</option>
//   <option value="value3">Valeur 3</option>
// </select>


// <input list="navigateurs" />
// <datalist id="navigateurs">
//   <option value="Chrome">
//   <option value="Firefox">
//   <option value="Internet Explorer">
//   <option value="Opera">
//   <option value="Safari">
// </datalist>
	
// <radio id="yellow" label="Jaune"/>
	
// 	<radiogroup>
//   <radio id="orange" label="Orange"/>
//   <radio id="violet" selected="true" label="Violet"/>
//   <radio id="Jaune" label="Jaune"/>
// </radiogroup>
}
