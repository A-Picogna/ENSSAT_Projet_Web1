<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
</head>
<body>

<div id="container">
	
	<h2> <?php echo $page_header ?></h2>
	<div id="body">

		<?php

			foreach ($liste as $object) 
			{

				echo "<table class='table table-striped'><tr><th colspan='1'>".$object['libelle']."</th></tr></table>";
	 		}
	 	
		?>

	</div>
</div>
</body>
</html>
