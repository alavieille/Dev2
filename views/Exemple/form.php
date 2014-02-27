<?php
  use MvcApp\Components\App;
  use MvcApp\Components\Form;


  $form = new Form($model,"action");
  echo $form->label("title","Titre");
  echo $form->inputText("title",array("class"=>"test"));
  $form->endForm();
?>
<div class="row">
  <div class="columns large-12">
    <h1>Créer un exemple</h1>
  </div>
</div>

<div class="row">
  <div class="columns large-12">
    <div class="panel">
  
      <form action="<?php echo App::getApp()->createUrl('exemple','save') ?>" method="post"> 
         <input type="hidden" name="id" value="<?php echo $model->getId(); ?>" />

         <div class="row">
            <div class="large-12 columns">
             <label>Titre<label>
                <input class="<?php if(isset($model->getErrors()['title'])) echo 'error' ?>" id="title" name="title" type="text" placeholder="Votre titre" value="<?php echo $model->getTitle(); ?>" />
            <?php if(isset($model->getErrors()['title'])) : ?>
                 <small class="error"><?php echo $model->getErrors()['title'] ?></small>
            <?php endif;?>
            </div>
        </div>         

        <div class="row">
            <div class="large-12 columns">
              <label>Contenue<label>
              <textarea class="<?php if(isset($model->getErrors()['content'])) echo 'error' ?>" id="content" name="content"><?php echo $model->getContent(); ?></textarea>
              <?php if(isset($model->getErrors()['content'])) : ?>
                <small class="error"><?php echo $model->getErrors()['content'] ?></small>
              <?php endif;?>
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