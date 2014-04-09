<?php
	use MvcApp\Core\App;
?>
<script src="<?php echo App::getApp()->getBasePath() ?>js/Article/viewAll.js"></script>
<script src="<?php echo App::getApp()->getBasePath() ?>js/masonry.min.js"></script>


<div  id="titleRow">
  <div class="row">
    <h1 class="columns large-12"> Liste des articles</h1>
  </div>
</div>
<div class="row" id="previousArticle">
	<div class="large-12 columns">
  <?php echo App::getApp()->getFlash(); ?>
		<?php $this->renderPartial("_viewAllArticle",array(
            "arrayModel" => $arrayModel,
        )); ?>
	</div>
</div>

<div class="pagination-centered">
  <ul class="pagination">
    <li class="arrow">
   			<a data-page=<?php echo 1 ?> href="">&laquo;</a>
    </li>	
	<?php for($i=1;$i<=$nbrTotalPage;$i++): ?>
		<li class="<?php echo (($i == $page) ? 'current':'') ?>">
				<a data-page=<?php echo $i ?> href="" ><?php echo $i ?></a>
		</li>
	<?php endfor; ?>
    <li class="arrow">
    		<a data-page=<?php echo $nbrTotalPage ?> href="" >&raquo;</a>
    </li>
  </ul>
</div>
