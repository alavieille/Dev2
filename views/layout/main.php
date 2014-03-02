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
    <script src="<?php echo App::getApp()->getBasePath() ?>css/foundation/js/vendor/modernizr.js"></script>
	<script src="<?php echo App::getApp()->getBasePath() ?>css/foundation/js/vendor/jquery.js"></script>

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

				    <li><a href="<?php echo App::createUrl('article','create') ?>">Créer un article</a></li>
				 
			    </ul>
			  </section>
			</nav>  
	  	</div>
	  	
	  	<!--content -->
 		<div role="content">
			<?php echo $content; ?>
	    </div>



    <script src="<?php echo App::getApp()->getBasePath() ?>css/foundation/js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
	</body>
</html>
