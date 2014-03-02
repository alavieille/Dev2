<?php
	use MvcApp\Components\App;
?>
<div class="row">
	<article id="article" class="panel columns small-12"> 
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
			  <p class="columns small-6 text-right ">
			    <?php echo date("d-m-Y", strtotime($model->getDateCreation())) ?>
			  </p>
			</div>
		</header>

		<?php if($model->getChapo() != "" ) : ?>
			<div class="row">
				<p class="text-justify columns small-12">
					<?php echo $model->getChapo() ?>
				</p>
			</div>
		<?php endif; ?>

		<div class="row">
			<p class="text-justify columns small-12">
				<?php echo $model->getcontenue() ?>
			</p>
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

</div>