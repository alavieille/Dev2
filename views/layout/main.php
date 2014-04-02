<?php
	use MvcApp\Components\App;
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
    <script src="<?php echo App::getApp()->getBasePath() ?>css/foundation/js/foundation/foundation.abide.js"></script>
	<script src="<?php echo App::getApp()->getBasePath() ?>js/utils.js"></script>
	<script>
		$(document).foundation();
		App = {
			urls : "<?php echo App::getApp()->getBasePath(); ?>"
		};
	</script>
</head>
	<body>
<div id="myModal" class="reveal-modal" data-reveal>
  <h2>Awesome. I have it.</h2>
  <p class="lead">Your couch.  It is mine.</p>
  <p>Im a cool paragraph that lives inside of an even cooler modal. Wins</p>
  <a class="close-reveal-modal">&#215;</a>
</div>
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

				    <li><a href="<?php echo App::getApp()->createUrl('article','create') ?>">Créer un article</a></li>
				 
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
