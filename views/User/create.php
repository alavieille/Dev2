<?php
  use MvcApp\Components\App;
  use MvcApp\Components\Form;

  $form = new Form($model,App::getApp()->createUrl('user','save'),array(
        "id" => "formCreateExemple"
        ));
?>
<div  id="titleRow">
  <div class="row">
    <h1 class="columns large-12">Inscription</h1>
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
          <div class="large-12 columns">
            <?php echo $form->label("confirm","Confirmation du mot de passe"); ?>
            <?php echo $form->inputPassword("confirm"); ?>
          </div>
      </div> 

      <div class="row">
          <div class="large-12 columns">
            <?php echo $form->label("nom","Nom"); ?>
            <?php echo $form->inputPassword("nom"); ?>
          </div>
      </div>   

      <div class="row">
          <div class="large-12 columns">
            <?php echo $form->label("prenom","Prenom"); ?>
            <?php echo $form->inputPassword("prenom"); ?>
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