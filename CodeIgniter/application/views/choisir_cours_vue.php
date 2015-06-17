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
            echo '<div class="form-group">';
			echo $libelle[0]['libelle'];
            echo '</div>';

			if ($PartiesCM != '')
			{
				
                echo '<div class="form-group">';
				echo "<h3>".$PartiesCM[0]['type']."</h3>";
                

				foreach ($PartiesCM as $key) 
				{
		            echo form_checkbox('CM[]', $key['partie'],FALSE).' '.$key['partie'];
		            echo " (".$key['hed']." heures eq TD) ";
				}
                echo '</div>';

		
			}
		?>

		<?php
			if ($PartiesTD != NULL)
			{
                echo '<div class="form-group">';
				echo "<h3>".$PartiesTD[0]['type']."</h3>";

				foreach ($PartiesTD as $object) 
				{
		            echo form_checkbox('TD[]', $object['partie'],FALSE).' '.$object['partie'];
		            echo " (".$object['hed']." heures eq TD) ";
				}
                echo '</div>';
			
			}

		?>

		<?php

			if ($PartiesTP != NULL)
			{
                echo '<div class="form-group">';
				echo "<h3>".$PartiesTP[0]['type']."</h3>";
				
				foreach ($PartiesTP as $value) {

		            echo form_checkbox('TP[]', $value['partie'],FALSE).' '.$value['partie'];
		            echo " (".$value['hed']." heures eq TD) ";
				}
                echo '</div>';
			}

		?>

		<?php

			if ($PartiesProjet != NULL)
			{
                echo '<div class="form-group">';
				echo "<h3>".$PartiesProjet[0]['type']."</h3>";

				foreach ($PartiesProjet as $value) 
				{
	
		            echo form_checkbox('Projet[]', $value['partie'],FALSE).' '.$value['partie'];
		            echo " (".$value['hed']." heures eq TD) ";
				}
                echo '</div>';
			}


		?>

		<?php
            echo form_hidden('ident',$module);
            echo '<div class="form-group">';
            echo form_submit('valider', 'Valider');
            echo '</div>';
            echo form_close();
        
        ?>


	</div>
</div>
</body>
</html>
