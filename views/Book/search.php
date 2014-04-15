<?php
	use MvcApp\Core\App;
?>
<script src="<?php echo App::getApp()->getBasePath() ?>js/Book/search.js"></script>

<div  id="titleRow">
  <div class="row">
    <h1 class="columns large-12"> Recherche Google Books </h1>
  </div>
</div>
<div class="row">
	<div class="large-12 columns">
		 <form class="panel" id="searchBook">
		    <div class="row">
    			<div class="large-8 large-offset-2 columns">
     				 <div class="row collapse">
        				<div class="small-10 columns">
         					<input class="searchContent" type="text" placeholder="Recherche">
       				 	</div>
	        			<div class="small-2 columns">
	          			<a href="#" class="button postfix">Valider</a>
	        			</div>
     			    </div>
    			</div>
			</div>
		</form>
		<div class="panel">
			<h4>Résultats</h4>
			<div class="res">
				<p class="text-center">Aucun résultats</p>

			</div>
		</div>
	</div>	
</div>


