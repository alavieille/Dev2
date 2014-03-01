<?php
	use MvcApp\Components\App;
?>
<article> 
	<header>
		<div class="row">
		  <h1 class="columns small-12">
		    <?php echo $model->getTitre() ?>
		  </h1>
		</div>
		<div class="row">
		  <p class="columns small-6">
		    <?php echo $model->getAuteur() ?>
		  </p>  
		  <p class="columns small-6 text-right">
		    <?php echo $model->getDateCreation() ?>
		  </p>
		</div>
	</header>

	<?php if($model->getChapo() != "" ) : ?>
		<div class="row">
			<div class="panel columns small-12">
				<?php echo $model->getChapo() ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="row">
		<div class="panel columns small-12">
			<?php echo $model->getcontenue() ?>
		</div>
	</div>
	<footer>
		<div class="columns small-12">
			<ul class="button-group">
			  <li><a href="<?php echo App::createUrl('article','update',$model->getId()); ?>" class="button small">Modifier</a></li>
			  <li><a href="<?php echo App::createUrl('article','delete',$model->getId()); ?>" class="button small">Supprimer</a></li>
			</ul>
		</div>
	</footer>
</article>

