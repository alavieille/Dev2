<!doctype html>
<html class="no-js" lang="fr">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>MVCApp</title>
	<link rel="stylesheet" href="<?php echo App::getApp()->getBasePath() ?>css/foundation/css/foundation.css" />
    <script src="<?php echo App::getApp()->getBasePath() ?>css/foundation/js/vendor/modernizr.js"></script>
	
</head>
	<body>
		<!-- navigation -->
		<div class="fixed">
			<nav class="top-bar" data-topbar>
			  <ul class="title-area">
			    <li class="name">
			      <h1><a href="index.php"><?php echo App::getApp()->getName(); ?></a></h1>
			    </li>
			     <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
			  </ul>

			  <section class="top-bar-section">
			    <ul class="right">
				    <li class="divider"></li>
				    <li><a href="">Menu1</a></li>
				    <li class="divider"></li>
				    <li><a href="">Menu2</a></li>
				    <li class="divider"></li>
			    </ul>
			  </section>
			</nav>  
	  	</div>
	  	
	  	<!--content -->
 		<div role="content">
			<?php echo $content; ?>
	    </div>


	<script src="<?php echo App::getApp()->getBasePath() ?>css/foundation/js/vendor/jquery.js"></script>
    <script src="<?php echo App::getApp()->getBasePath() ?>css/foundation/js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
	</body>
</html>
