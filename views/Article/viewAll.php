<?php
	use MvcApp\Components\App;

?>
<script src="<?php echo App::getApp()->getBasePath() ?>js/masonry.min.js"></script>
<script>
$(window).load(function(){
  $('#masonryContainer').masonry({  
    itemSelector: '.masonry-brick',
    isFitWidth: true,
  });  
});    
</script>
<div class="row">
  <div class="columns large-12">
    <h1>Liste des Articles</h1>
  </div>
</div>
<div class="row" id="previousArticle">
	<div class="large-12 columns">
		<div id="masonryContainer">
		<?php foreach ($arrayModel as $num => $model): ?>
			<a class="panel masonry-brick columns" href="<?php echo App::createUrl('article','view',$model->getId()); ?>">
				<article >
						<h3><?php echo $model->getTitre() ?></h3>
						<div class="row details">
							<p class="auteur large-9 columns txt-left"><?php echo $model->getAuteur() ?></p>
							<p class="large-3 columns"><?php echo $model->getDateCreation()?> </p>		
						</div>
						<?php if($model->getChapo() != "" ) : ?>
							<p class="" ><?php echo $model->getChapo(); ?></p>
						<?php else : ?>
							<p class="" ><?php echo $model->previousContenue(); ?></p>
						<?php endif; ?>
				</article>
			</a>
		<?php endforeach; ?>
		</div>
	</div>
</div>