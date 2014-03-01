<?php
	use MvcApp\Components\App;
?>
<article> 
	<header>
		<div class="row">
		  <h1 class="columns large-12">
		    <?php echo $model->getTitre() ?>
		  </h1>
		</div>
		<div class="row">
		  <p class="columns large-6">
		    <?php echo $model->getAuteur() ?>
		  </p>  
		  <p class="columns large-6 text-right">
		    <?php echo $model->getDateCreation() ?>
		  </p>
		</div>
	</header>

	<?php if($model->getChapo() != "" ) : ?>
		<div class="row">
			<div class="panel">
				<?php echo $model->getChapo() ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="row">
		<div class="panel">
			<?php echo $model->getcontenue() ?>
		</div>
	</div>
	<footer>
		<div class="row">
			<ul class="button-group">
			  <li><a href="<?php echo App::createUrl('article','update',$model->getId()); ?>" class="button small">Modifier</a></li>
			  <li><a href="<?php echo App::createUrl('article','delete',$model->getId()); ?>" class="button small">Supprimer</a></li>
			</ul>
		</div>
	</footer>
</article>

