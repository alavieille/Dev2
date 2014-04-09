<?php
	use MvcApp\Core\App;
?>
<div class="row">
	<article id="article" class="panel columns small-12"> 
		<header>
			<div class="row">
			  <h1 class="columns small-12">
			    <?php echo $model->titre ?>
			  </h1>
			</div>
			<div class="row">
			  <p class="columns small-6">
			    <?php echo $model->auteur ?>
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
								<img src="<?php echo App::getApp()->getConfig("path") . App::getApp()->getConfig("uploadFolder").$image->file ?>" alt="<?php echo $image->titre ?>" /> 

							</li>
							
						<?php endforeach; ?>
					</ul>
			</div>
		<?php endif; ?>
	</article>

</div>