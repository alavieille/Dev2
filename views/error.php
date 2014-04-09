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
	<script>
		$(function(){$(document).foundation()});
		App = {
			urls : "<?php echo App::getApp()->getBasePath(); ?>"
		};
	</script>
</head>
	<body>
		
		<div class="row ">
			<h2 class="large-12 columns text-center">Erreur <?php echo $code ?></h2>
		</div>
		
		<p class="row panel"><?php echo $message ?></p>

	
	</body>
</html>
