<?php
  use MvcApp\Core\App;
  use MvcApp\Core\Form;

  $form = new Form($model,App::getApp()->createUrl('user','login'),array(
        "id" => "formCreateExemple"
        ));
?>

<div  id="titleRow">
  <div class="row">
    <h1 class="columns large-12">Connexion</h1>
  </div>
</div>

<div class="row">
  <div class="columns large-12">
    <div class="panel">
      <?php $form->beginForm(); ?>
      
      <div class="row">
          <div class="large-12 columns">
         
            <?php echo $form->label("email","Email"); ?>
            <?php echo $form->inputEmail("email"); ?>

         
          </div>
      </div>       

      <div class="row">
          <div class="large-12 columns">
            <?php echo $form->label("password","Mot de passe"); ?>
            <?php echo $form->inputPassword("password"); ?>
          </div>
      </div> 

      <div class="row">
          <div class="large-1 columns">
              <?php echo $form->submit("Valider");?>
          </div>
      </div>

      <?php $form->endForm(); ?>
  </div>
</div>