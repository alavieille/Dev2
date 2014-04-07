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
  <header class="row">
    <h1 class="columns large-12"><?php echo $rss->channel->title ?></h1>
  </header>
</div>
<div class="row" id="previousArticle">
	<div class="large-12 columns">
		<div id="masonryContainer">
		<?php foreach ($items as $item) : ?>
			<?php $this->renderPartial("_viewItem",array("item"=>$item)); ?>
		<?php endforeach; ?>

	</div>
</div>