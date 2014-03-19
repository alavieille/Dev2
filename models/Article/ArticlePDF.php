<?php 
/**
* Classe qui représente la génération en pdf d'un article
* @author Amaury Lavieille
*/
namespace Dev2AL\Article;

use MvcApp\Components\App;

class ArticlePDF extends \FPDF {

	/**
	* @param Article 
	*/
	protected $article;

	/**
	* @param Images Tableau d'objet Image
	*/
	protected $arrayImages;

	/**
	* @param FPDF instance de fpdf
	*/
	protected $pdf;

	public function __construct(Article $article, $images)
	{
		parent::__construct();
		$this->article = $article;
		$this->arrayImages = $images;
		$this->setTitle($this->article->getTitre());
			
	}

	/**
	* Genere titre du fichier pdf 
	*/
	public function Header()
	{
		 $this->SetFont('Arial','B',15);
		 $this->Cell(80);
		 $this->Cell(30,10,$this->article->getTitre());
		 $this->Ln(10);
		 $this->SetFont('Arial','',10);
		 $this->Cell(30,10,$this->article->getAuteur());
		 $this->Cell(30,10,date("d-m-Y", strtotime($this->article->getDateCreation()))) ;
		 $this->Ln(20);
	}

	/**
	* Genere le chapo de l'article en pdf
	*/
	public function  addChapo()
	{
		$this->SetFont('Arial','',12);
		$this->MultiCell(0,5,$this->article->getChapo());
		$this->Ln(10);
	}

	/**
	* Genere le contenue de l'article en pdf
	*/
	public function  addContent()
	{
		$this->SetFont('Arial','',12);
		$this->MultiCell(0,5,$this->article->getContenue());
		$this->Ln(10);
	}	

	/**
	* Ajout des images d'un article
	*/
	public function addPicture()
	{
		foreach ($this->arrayImages as $image) {

			$this->Cell(30,10,$image->getTitre());
			$this->Ln(10);
			$path = App::getApp()->getConfig("uploadFolder").$image->getFile();
			$this->Image($path);
			$this->Ln(10);
		}
	}


	/**
	*	
	*/
	public function generate()
	{
		$this->addPage();	
		$this->addChapo();
		$this->addContent();
		$this->addPicture();
	}




}