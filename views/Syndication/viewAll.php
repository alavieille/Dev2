<?php
  use MvcApp\Components\App;
?>

<div  id="titleRow">
  <header class="row">
    <h1 class="columns large-12"><?php echo $rss->getTitle() ?></h1>
  </header>
</div>
<div class="row" id="previousArticle">
	<div class="large-12 columns">
		<?php foreach ($rss->getItems() as $key => $item) : ?>
			<?php $this->renderPartial("_viewItem",array("item"=>$item)); ?>
		<?php endforeach; ?>
	</div>
</div>