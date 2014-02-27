<?php
	use MvcApp\Components\App;
?>
<!doctype html>
<html class="no-js" lang="fr">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Erreur</title>
	<link rel="stylesheet" href="<?php echo App::getApp()->getBasePath() ?>css/foundation/css/foundation.css" />
    <script src="<?php echo App::getApp()->getBasePath() ?>css/foundation/js/vendor/modernizr.js"></script>
</head>
	<body>
		
		<div class="row ">
			<h2 class="large-12 columns text-center">Erreur <?php echo $code ?></h2>
		</div>
		<div class="row panel">
			<p><?php echo $message ?></p>
		<div>


	
	</body>
</html>
