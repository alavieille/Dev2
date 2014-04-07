<?php
  use MvcApp\Components\App;
?>

<div class="panel" href="<?php echo $item->link ?>">
	<article>
		<h3><?php echo $item->title ?></h3>
		<?php if( isset($item->description) ) :  ?>
			<div><?php echo $item->description ?></div>
		<?php elseif( isset($item->content)) : ?>
			<div><?php echo $item->content ?></div>
		<?php endif; ?>
	</article>
	<div>
		<a class="button tiny" href="<?php echo $item->link ?>">Voir l'article</a>
	</div>
</div>