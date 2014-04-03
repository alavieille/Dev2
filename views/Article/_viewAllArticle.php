<?php
	use MvcApp\Components\App;
?>
<div id="masonryContainer">
		<?php foreach ($arrayModel as $num => $model): ?>
			<a class="panel masonry-brick columns" href="<?php echo App::getApp()->	createUrl('article','view',array($model->id)); ?>">
				<article >
						<h3><?php echo $model->titre?></h3>
						<div class="row details">
						<p class="large-4 columns "><?php echo date("d-m-Y", strtotime($model->dateCreation)) ?></p>		
						</div>
						<?php if($model->chapo != "" ) : ?>
							<p class="text-justify" ><?php echo $model->chapo; ?></p>
						<?php else : ?>
							<p class="text-justify" ><?php echo $model->excerptContenue(); ?></p>
						<?php endif; ?>
				</article>
			</a>
		<?php endforeach; ?>
</div>