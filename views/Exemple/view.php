<?php
	use MvcApp\Components\App;
?>

<div class="row">
  <div class="columns large-12">
    <h1><?php echo $model->getTitle() ?></h1>
  </div>
</div>

<div class="row">
	<div class="panel">
		<?php echo $model->getcontent() ?>
	</div>
</div>

<div class="row">
	<ul class="button-group">
  <li><a href="<?php echo App::createUrl('exemple','view',$model->getId()); ?>" class="button small">Modifier</a></li>
  <li><a href="<?php echo App::createUrl('exemple','view',$model->getId()); ?>" class="button small">Supprimer</a></li>
</ul>
</div>


