<?php
	use MvcApp\Core\App;

?>

<script src="<?php echo App::getApp()->getBasePath() ?>js/Article/view.js"></script>
<div class="row">
	<?php echo App::getApp()->getFlash(); ?>

	<article id="article" class="panel columns small-12"> 
		<div class="columns small-12">
			<ul class="button-group">
				<li><a href="<?php echo App::getApp()->createUrl('article','generatePDF',array($model->id)); ?>" class="button small">Format PDF</a></li>
				<li><a href="<?php echo App::getApp()->createUrl('article','sendEmail',array($model->id)); ?>" class="button small">Envoyer par Email</a></li>
				
			</ul>
		</div>
		<header>

			<div class="row">
			  <h1 class="columns small-12">
			    <?php echo $model->titre ?>
			  </h1>
			</div>
			<div class="row">
			  <p class="columns small-6">
			    <?php echo $auteur->nom." ".$auteur->prenom ?>
			  </p>  
			  <p class="columns small-6 text-right ">
			    <?php echo date("d-m-Y", strtotime($model->dateCreation)) ?>
			  </p>
			</div>
		</header>

		<?php if($model->chapo != "" ) : ?>
			<div class="row">
				<p class="text-justify columns small-12">
					<?php echo $model->chapo ?>
				</p>
			</div>
		<?php endif; ?>

		<div class="row">
			<p class="text-justify columns small-12">
				<?php echo $model->contenue ?>
			</p>
		</div>		

		<?php if (count($arrayPicture)>0) : ?>
			<div class="row" id="pictures">
					<ul class="columns small-12  small-block-grid-3 "> 
						<?php foreach ($arrayPicture as $image) : ?>
							
							<li>
							<a href="" data-link="<?php echo App::getApp()->createUrl('image','delete',array($image->id)); ?>" class="close">&times;</a>
							<a class="th" href="<?php echo App::getApp()->getBasePath().App::getApp()->getConfig("uploadFolder").$image->file ?>"> 
								<img src="<?php echo App::getApp()->getBasePath().App::getApp()->getConfig("uploadFolder").$image->file ?>" alt="<?php echo $image->titre ?>" /> 
							</a>
							</li>
							
						<?php endforeach; ?>
					</ul>
			</div>
		<?php endif; ?>

		<?php if($isAuthor) : ?>
			<footer>
				<div class="columns small-12">
					<ul class="button-group">
					  <li><a id="addImage" href="<?php echo App::getApp()->createUrl('image','create',array($model->id)); ?>" class="button small">Ajouter une image</a></li>
					  
					  <li><a href="<?php echo App::getApp()->createUrl('article','update',array($model->id)); ?>" class="button small">Modifier</a></li>
					  <li><a href="<?php echo App::getApp()->createUrl('article','delete',array($model->id)); ?>" class="button small">Supprimer</a></li>
					</ul>
				</div>
			</footer>
	<?php endif; ?>
	</article>

</div>