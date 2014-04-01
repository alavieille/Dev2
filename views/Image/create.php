<?php
  use MvcApp\Components\App;
  use MvcApp\Components\Form;

  $form = new Form($model,App::getApp()->createUrl('image','save',array($idArticle)),array(
        "id" => "formCreateExemple",
        "enctype"=>"multipart/form-data",
        ));
?>
<div  id="titleRow">
  <div class="row">
    <h1 class="columns large-12">Ajouter une image</h1>
  </div>
</div>

<div class="row">
  <div class="columns large-12">
    <div class="panel">
      <?php $form->beginForm(); ?>
      
      <div class="row">
          <div class="large-12 columns">
            <?php echo $form->label("titre","Titre"); ?>
            <?php echo $form->inputText("titre"); ?>
          </div>
      </div>       

      <div class="row">
          <div class="large-12 columns">
            <?php echo $form->label("fileUpload","Fichier"); ?>
            <?php echo $form->inputFile("fileUpload"); ?>
          </div>
      </div>       

     

      <div class="row">
          <div class="large-1 columns">
              <?php echo $form->submit("Ajouter");?>
          </div>
      </div>

      <?php $form->endForm(); ?>
  </div>
</div>