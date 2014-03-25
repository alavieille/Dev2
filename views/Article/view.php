<?php
	use MvcApp\Components\App;
?>


<div class="row">
	<?php echo App::getApp()->getFlash(); ?>

	<article id="article" class="panel columns small-12"> 
		<div class="columns small-12">
			<ul class="button-group">
				<li><a href="<?php echo App::getApp()->createUrl('article','generatePDF',$model->getId()); ?>" class="button small">Format PDF</a></li>
				<li><a href="<?php echo App::getApp()->createUrl('article','sendEmail',$model->getId()); ?>" class="button small">Envoyer par Email</a></li>
				
			</ul>
		</div>
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

		<?php if (count($arrayPicture)>0) : ?>
			<div class="row" id="pictures">
					<ul class="columns small-12  small-block-grid-3 "> 
						<?php foreach ($arrayPicture as $image) : ?>
							
							<li>
							<a href="<?php echo App::getApp()->createUrl('image','delete',$image->getId()); ?>" class="close">&times;</a>
							<a class="th" href="<?php echo App::getApp()->getBasePath().App::getApp()->getConfig("uploadFolder").$image->getFile() ?>"> 
								<img src="<?php echo App::getApp()->getBasePath().App::getApp()->getConfig("uploadFolder").$image->getFile() ?>" alt="<?php echo $image->getTitre() ?>" /> 
							</a>
							</li>
							
						<?php endforeach; ?>
					</ul>
			</div>
		<?php endif; ?>


		<footer>
			<div class="columns small-12">
				<ul class="button-group">
				  <li><a href="<?php echo App::getApp()->createUrl('image','create',$model->getId()); ?>" class="button small">Ajouter une image</a></li>
				  <li><a href="<?php echo App::getApp()->createUrl('article','update',$model->getId()); ?>" class="button small">Modifier</a></li>
				  <li><a href="<?php echo App::getApp()->createUrl('article','delete',$model->getId()); ?>" class="button small">Supprimer</a></li>
				</ul>
			</div>
		</footer>
	</article>

</div>