<?php
	use MvcApp\Components\App;
?>

<div class="row">
  <h1 class="columns large-12">Supprimer</h1>
</div>

<div class="row panel">
	<p>
		Etes vous sur de vouloir supprimer <?php echo $model->getTitre(); ?> ?
	</p>
	<ul class="button-group">
	  <li><a href="<?php echo App::createUrl('article','confirmDelete',$model->getId()); ?>" class="button small">Oui</a></li>
	  <li><a href="<?php echo App::createUrl('article','view',$model->getId()); ?>" class="button small">Non</a></li>
	</ul>
</div>



