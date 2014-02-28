<?php
  use MvcApp\Components\App;
  use MvcApp\Components\Form;

  $form = new Form($model,App::getApp()->createUrl('exemple','save'),array(
        "id" => "formCreateExemple"
        ));
?>
<div class="row">
  <div class="columns large-12">
    <h1>Créer un exemple</h1>
  </div>
</div>

<div class="row">
  <div class="columns large-12">
    <div class="panel">
      <?php $form->beginForm(); ?>
      
      <?php echo $form->inputHidden("id"); ?>   
      <div class="row">
          <div class="large-12 columns">
            <?php echo $form->label("title","Titre"); ?>
            <?php echo $form->inputText("title"); ?>
          </div>
      </div>         

      <div class="row">
          <div class="large-12 columns">
            <?php echo $form->label("content","contenue"); ?>
            <?php echo $form->textarea("content"); ?>
          </div>
      </div>    

      <div class="row">
          <div class="large-1 columns">
              <?php echo $form->submit("valider");?>
          </div>
      </div>

      <?php $form->endForm(); ?>
  </div>
</div>