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

<div  id="titleRow">
  <div class="row">
    <h1 class="columns large-12"> Liste des articles</h1>
  </div>
</div>
<div class="row" id="previousArticle">
	<div class="large-12 columns">
<?php echo App::getApp()->getFlash(); ?>
		<div id="masonryContainer">
		<?php foreach ($arrayModel as $num => $model): ?>
			<a class="panel masonry-brick columns" href="<?php echo App::createUrl('article','view',$model->getId()); ?>">
				<article >
						<h3><?php echo $model->getTitre() ?></h3>
						<div class="row details">
							<p class="auteur large-8 columns txt-left"><?php echo $model->getAuteur() ?></p>
							<p class="large-4 columns "><?php echo date("d-m-Y", strtotime($model->getDateCreation())) ?></p>		
						</div>
						<?php if($model->getChapo() != "" ) : ?>
							<p class="text-justify" ><?php echo $model->getChapo(); ?></p>
						<?php else : ?>
							<p class="text-justify" ><?php echo $model->previousContenue(); ?></p>
						<?php endif; ?>
				</article>
			</a>
		<?php endforeach; ?>
		</div>
	</div>
</div>

<div class="pagination-centered">
  <ul class="pagination">
    <li class="arrow <?php echo (($page == 1) ? 'unavailable':'') ?>">
    	<?php if($page > 1 ) : ?>
   			<a href="<?php echo App::createUrl('article','viewAll',$page-1); ?>">&laquo;</a>
   		<?php endif; ?>
    </li>	
	<?php for($i=1;$i<=$nbrTotalPage;$i++): ?>
		<li class="<?php echo (($i == $page) ? 'current':'') ?>">
				<a href="<?php echo App::createUrl('article','viewAll',$i); ?>" ><?php echo $i ?></a>
		</li>
	<?php endfor; ?>
    <li class="arrow <?php echo (($page == $nbrTotalPage) ? 'unavailable':'') ?>">
    	<?php if($page < $nbrTotalPage ) : ?>
    		<a href="<?php echo App::createUrl('article','viewAll',$page+1); ?>">&raquo;</a>
    	<?php endif; ?>
    </li>
  </ul>
</div>
