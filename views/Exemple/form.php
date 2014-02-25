<?php
  use MvcApp\Components\App;
?>
<div class="row">
  <div class="columns large-12">
    <h1>Créer un exemple</h1>
  </div>
</div>
<div class="row">
  <div class="columns large-12">
    <div class="panel">
      <form action="<?php echo App::getApp()->getBasePath() ?>exemple/validCreate" method="post">
        
         <input type="hidden" value="<?php echo $model->getId(); ?>" />

         <div class="row">
            <div class="large-12 columns">
             <label>Titre<label>
                <input id="title" name="title" type="text" placeholder="Votre titre" value="<?php echo $model->getTitle(); ?>" />
            </div>
        </div>         

        <div class="row">
            <div class="large-12 columns">
              <label>Contenue<label>
              <textarea id="content" name="content"><?php echo $model->getContent(); ?></textarea>
            </div>
        </div>    

        <div class="row">
            <div class="large-1 columns">
               <input class="button" type="submit" name="" value="valider">
            </div>
        </div>


      </form>
  </div>
</div>