<?php
  use MvcApp\Core\App;
?>

<div  id="titleRow">
  <header class="row">
    <h1 class="columns large-12">Evenement de Paris</h1>
  </header>
</div>
<div class="row" id="previousArticle">
	<div class="large-12 columns">
		<?php foreach ($events as $event) : ?>
			<div class="panel">
				<article>
					<h3><?php echo $event->title ?></h3>
					<p><?php echo date("d-m-Y", strtotime($event->startDate)) ?></p>
					<p><?php echo $event->venue->name; ?> - <?php echo $event->venue->location->city ?></p>
					<p><?php echo $event->venue->location->street ?></p>
					<a target="_blank" 	class="button tiny" href="<?php echo  $event->url; ?>">Voir sur LastFm</a>

				</article>
	
			</div>
		<?php endforeach; ?>
	</div>
</div>