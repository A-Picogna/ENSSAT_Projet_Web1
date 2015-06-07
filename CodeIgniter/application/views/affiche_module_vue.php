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

		<?php echo "<p> Module : " .$Modules[0]['libelle']."</br>"; ?>
		<?php echo "Responsable : " .$ResponsablesETfiliere[0]['prenom']." "; ?>
		<?php echo " ".$ResponsablesETfiliere[0]['nom']." </br>"; ?>

		<?php echo " Public : " .$ResponsablesETfiliere[0]['public']. "</p>"; ?>
	

		<?php
			if ($Cours != Null)
			{

				foreach ($Cours as $object) 
				{
					echo "<table class='table table-striped'><tr><th colspan='2'> ".$object["partie"]."";
					echo "(".$object['hed']." h eq. TD)</th></tr>";
					echo " <tr><td>".$object['prenom']." ".$object['nom']."</td></tr></table>";
	 			}
	 		}
	 		else
	 		{
	 			echo "Il n'existe pas de partionnement de cours";
	 		}
		?>
	</div>
</div>
</body>
</html>
