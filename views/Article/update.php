<?php
  use MvcApp\Components\App;
  use MvcApp\Components\Form;

  $form = new Form($model,App::getApp()->createUrl('article','confirmUpdate'),array(
        "id" => "formCreateExemple"
        ));
?>
<div class="row">
  <div class="columns large-12">
    <h1>Créer un article</h1>
  </div>
</div>

<div class="row">
  <div class="columns large-12">
    <div class="panel">
      <?php $form->beginForm(); ?>
      <?php echo $form->inputHidden("id"); ?>
      <div class="row">
          <div class="large-12 columns">
            <?php echo $form->label("titre","Titre"); ?>
            <?php echo $form->inputText("titre"); ?>
          </div>
      </div>       

      <div class="row">
          <div class="large-12 columns">
            <?php echo $form->label("auteur","Auteur"); ?>
            <?php echo $form->inputText("auteur"); ?>
          </div>
      </div>    

      <div class="row">
          <div class="large-12 columns">
            <?php echo $form->label("chapo","Chapô"); ?>
            <?php echo $form->textarea("chapo"); ?>
          </div>
      </div>         

      <div class="row">
          <div class="large-12 columns">
            <?php echo $form->label("contenue","Contenue"); ?>
            <?php echo $form->textarea("contenue",array("rows"=>"10")); ?>
          </div>
      </div>    

      <div class="row">
          <div class="large-1 columns">
              <?php echo $form->submit("Mettre à jour");?>
          </div>
      </div>

      <?php $form->endForm(); ?>
  </div>
</div>