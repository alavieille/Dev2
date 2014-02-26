<?php
	use MvcApp\Components\App;
?>
<div class="row">
  <div class="columns large-12">
    <h1>Liste des exemples</h1>
  </div>
</div>
	

<?php foreach ($arrayModel as $num => $model): ?>



<div class="row panel">
	<p class="large-1 columns"><?php echo $num?></p>
	<p class="large-2 columns" ><?php echo $model->getTitle() ?></p>
	<p class="large-8 columns" ><?php echo $model->getContent() ?></p>
	<a href="<?php echo App::createUrl('exemple','view',$model->getId()); ?>" class="large-1 columns button tiny">Voir</a>

</div>

<?php endforeach; ?>

