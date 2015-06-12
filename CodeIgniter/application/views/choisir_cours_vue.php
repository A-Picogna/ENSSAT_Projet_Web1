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
			echo form_open('traitement_choix_partie');

			if ($PartiesCM != '')
			{
				
				echo "<h3>".$PartiesCM[0]['type']."</h3>";
				echo "</br>";


				foreach ($PartiesCM as $key) 
				{
		            echo form_checkbox('CM[]', $key['partie'],FALSE).$key['partie'];
		            echo " (".$key['hed']." heures eq TD) ";
		            echo "</br>";
				}

		
			}
		?>

		<?php
			if ($PartiesTD != NULL)
			{
				echo "<h3>".$PartiesTD[0]['type']."</h3>";
				echo "</br>";

				foreach ($PartiesTD as $object) 
				{
		            echo form_checkbox('TD[]', $object['partie'],FALSE).$object['partie'];
		            echo " (".$object['hed']." heures eq TD) ";
		            echo "</br>";
				}
			
			}

		?>

		<?php

			if ($PartiesTP != NULL)
			{

				echo "<h3>".$PartiesTP[0]['type']."</h3>";
				echo "</br>";
				
				foreach ($PartiesTP as $value) {

		            echo form_checkbox('TP[]', $value['partie'],FALSE).$value['partie'];
		            echo " (".$value['hed']." heures eq TD) ";
		            echo "</br>";

				}
			}

		?>

		<?php

			if ($PartiesProjet != NULL)
			{
				echo "<h3>".$PartiesProjet[0]['type']."</h3>";
				echo "</br>";

				foreach ($PartiesProjet as $value) 
				{
	
		            echo form_checkbox('Projet[]', $value['partie'],FALSE).$value['partie'];
		            echo " (".$value['hed']." heures eq TD) ";
		            echo "</br>";
				}
			}

			echo "</br>";

		?>

		<?php echo form_hidden('ident','$module')?>

		<?php echo form_submit('valider', 'Valider')?>
		<?php echo form_close() ?>


	</div>
</div>
</body>
</html>
