<?php
	use MvcApp\Core\App;
?>
<!doctype html>
<html class="no-js" lang="fr">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Dev2</title>
	<link rel="stylesheet" href="<?php echo App::getApp()->getBasePath() ?>css/foundation/css/normalize.css" />
	<link rel="stylesheet" href="<?php echo App::getApp()->getBasePath() ?>css/foundation/css/foundation.css" />
	<link rel="stylesheet" href="<?php echo App::getApp()->getBasePath() ?>css/main.css" />
	<script src="<?php echo App::getApp()->getBasePath() ?>css/foundation/js/vendor/jquery.js"></script>
    <script src="<?php echo App::getApp()->getBasePath() ?>css/foundation/js/vendor/modernizr.js"></script>
    <script src="<?php echo App::getApp()->getBasePath() ?>css/foundation/js/foundation.min.js"></script>
	<script src="<?php echo App::getApp()->getBasePath() ?>js/utils.js"></script>
	<script src="<?php echo App::getApp()->getBasePath() ?>js/main.js"></script>
	<script>
		$(function(){$(document).foundation()});
		App = {
			urls : "<?php echo App::getApp()->getBasePath(); ?>"
		};
	</script>
</head>
	<body>
		<!-- navigation -->
		<div class="fixed">
			<nav class="top-bar" data-topbar>
			  <ul class="title-area">
			    <li class="name">
			      <h1><a href="<?php echo App::getApp()->getBasePath() ?>"><?php echo App::getApp()->getName(); ?></a></h1>
			    </li>
			     <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
			  </ul>

			  <section class="top-bar-section">
			    <ul class="left">
				   
				    <li><a href="<?php echo App::getApp()->createUrl('article','viewAll');?>">Liste des articles</a></li>
					<?php if(! App::getApp()->getAuth()->isLogged()) :?>
				    <li><a href="<?php echo App::getApp()->createUrl('article','create') ?>">Créer un article</a></li>
					<?php endif; ?>

				    <li class="has-dropdown">

        				<a href="#">Flux Rss</a>
				        <ul class="dropdown">
				    		<li><a href="<?php echo App::getApp()->createUrl('syndication','leMondeRss') ?>">Le Monde Sport</a></li>
				    		<li><a href="<?php echo App::getApp()->createUrl('syndication','newYorkTimeRss') ?>">New York Times</a></li>
				    		<li><a href="<?php echo App::getApp()->createUrl('syndication','w3cRss') ?>">W3C</a></li>
				    		<li><a href="<?php echo App::getApp()->createUrl('syndication','googleRss') ?>">Google</a></li>
				        </ul>
				    </li>

				    <li class="has-dropdown">
        				<a href="#">Evènement</a>
				        <ul class="dropdown">
				    		<li><a href="<?php echo App::getApp()->createUrl('evenement','eventLocation',array("paris")) ?>">Paris</a></li>
				    		<li><a class="eventPos" href="<?php echo App::getApp()->createUrl('evenement','eventCoord') ?>">Postiton Actuel</a></li>
				        </ul>
				    </li>
					
				 
			    </ul>			    
			    <ul class="right">
				   	<?php if(! App::getApp()->getAuth()->isLogged()) :?>
				    <li><a href="<?php echo App::getApp()->createUrl('user','create');?>">Inscription</a></li>
				    <li><a href="<?php echo App::getApp()->createUrl('user','login') ?>">Connexion</a></li>
					<?php else : ?>
				    <li><a href="<?php echo App::getApp()->createUrl('user','logout') ?>">Deconnexion</a></li>
				 	<?php endif; ?>
			    </ul>
			  </section>
			</nav>  
	  	</div>
	  	
	  	<!--content -->
 		<div role="content">
 			<?php //var_dump(App::getApp()->getAuth()); ?>
			<?php echo $content; ?>
	    </div>



   

	</body>


   

</html>
