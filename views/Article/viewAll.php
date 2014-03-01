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
<div class="row">
	<div class="large-12 columns">
		<div id="masonryContainer">
		<?php foreach ($arrayModel as $num => $model): ?>
			<div class="panel masonry-brick columns">
				<h3 class="" ><?php echo $model->getTitre() ?></h3>
				<?php if($model->getChapo() != "" ) : ?>
					<p class="" ><?php echo $model->getChapo(); ?></p>
				<?php else : ?>
					<p class="" ><?php echo $model->previousContenue(); ?></p>
				<?php endif; ?>
				<a class=" button tiny" href="<?php echo App::createUrl('article','view',$model->getId()); ?>">Voir</a>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
</div>