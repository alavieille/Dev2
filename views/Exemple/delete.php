<?php
	use MvcApp\Components\App;
?>

<div class="row">
  <div class="columns large-12">
    <h1>Supprimer></h1>
  </div>
</div>

<div class="row panel">
	<p>
		Etes vous sur de vouloir supprimer <?php echo $model->getTitle(); ?> ?
	</p>
	<ul class="button-group">
	  <li><a href="<?php echo App::createUrl('exemple','confirmDelete',$model->getId()); ?>" class="button small">Oui</a></li>
	  <li><a href="<?php echo App::createUrl('exemple','view',$model->getId()); ?>" class="button small">Non</a></li>
	</ul>
</div>


