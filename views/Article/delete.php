<?php
	use MvcApp\Core\App;
?>

<div  id="titleRow">
  <div class="row">
    <h1 class="columns large-12">Supprimer</h1>
  </div>
</div>
<div class="row panel">
	<p>
		Etes vous sur de vouloir supprimer <?php echo $model->titre; ?> ?
	</p>
	<ul class="button-group">
	  <li><a href="<?php echo App::getApp()->createUrl('article','confirmDelete',array($model->id)); ?>" class="button small">Oui</a></li>
	  <li><a href="<?php echo App::getApp()->createUrl('article','view',array($model->id)); ?>" class="button small">Non</a></li>
	</ul>
</div>



