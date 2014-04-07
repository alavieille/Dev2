<?php
  use MvcApp\Components\App;
?>

<div class="panel masonry-brick columns" href="<?php echo $item->link ?>">
	<article >
		<h3><?php echo $item->title ?></h3>
		<div><?php echo $item->description ?></div>
		<a class="button tiny" href="<?php echo $item->link ?>">Voir l'article</a>
	</article>
</div>