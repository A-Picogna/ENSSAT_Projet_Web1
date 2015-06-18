<h1 class="titre"> <?php echo $page_header ?></h1>
		<?php
            echo '<div class="panel panel-primary">';
            echo '<div class="panel panel-heading">';
			echo form_open('traitement_choix_partie');
			echo '<h2 class="panel-title"> Module : '.$libelle[0]['libelle'].'</h2>';
            echo '</div>';
            echo '<div class="panel-body">';
            echo '<div class="row row-centered">';            

			if ($PartiesCM != '')
			{       
                echo '<div class="col-centered">';
                echo '<div class="thumbnail">';
                echo '<div class="caption">';
                echo '<div class="panel panel-info">';
                echo '<div class="panel panel-heading">';
				echo '<h2 class="panel-title">'.$PartiesCM[0]['type'].'</h2>';
                echo '</div>';
                echo '<div class="panel-body">';
                
				foreach ($PartiesCM as $key) 
				{
                    echo '<div class="form-group">';
		            echo form_checkbox('CM[]', $key['partie'],FALSE).' '.$key['partie'];
		            echo " (".$key['hed']." heures eq TD) ";
                    echo '</div>';
				}
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
			}

			if ($PartiesTD != NULL)
			{   
                echo '<div class="col-centered">';
                echo '<div class="thumbnail">';
                echo '<div class="caption">';
                echo '<div class="panel panel-info">';
                echo '<div class="panel panel-heading">';
				echo "<h2 class='panel-title'>".$PartiesTD[0]['type']."</h2>";
                echo "</div>";
                echo '<div class="panel-body">';

				foreach ($PartiesTD as $object) 
				{   
                    echo '<div class="form-group">';
		            echo form_checkbox('TD[]', $object['partie'],FALSE).' '.$object['partie'];
		            echo " (".$object['hed']." heures eq TD) ";
                    echo '</div>';
				}
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
			
			}

			if ($PartiesTP != NULL)
			{
                echo '<div class="col-centered">';
                echo '<div class="thumbnail">';
                echo '<div class="caption">';
                echo '<div class="panel panel-info">';
                echo '<div class="panel panel-heading">';
				echo "<h2 class='panel-title'>".$PartiesTP[0]['type']."</h2>";
                echo "</div>";
                echo '<div class="panel-body">';
				
				foreach ($PartiesTP as $value) 
                {
                    echo '<div class="form-group">';
		            echo form_checkbox('TP[]', $value['partie'],FALSE).' '.$value['partie'];
		            echo " (".$value['hed']." heures eq TD) ";
                    echo '</div>';
				}
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
			}


			if ($PartiesProjet != NULL)
			{
                echo '<div class="col-centered">';
                echo '<div class="thumbnail">';
                echo '<div class="caption">';
                echo '<div class="panel panel-info">';
                echo '<div class="panel panel-heading">';
				echo "<h2 class='panel-title'>".$PartiesProjet[0]['type']."</h2>";
                echo "</div>";
                echo '<div class="panel-body">';

				foreach ($PartiesProjet as $value) 
				{
                    echo '<div class="form-group">';	
		            echo form_checkbox('Projet[]', $value['partie'],FALSE).' '.$value['partie'];
		            echo " (".$value['hed']." heures eq TD) ";
                    echo '</div>';
				}
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
			}
            
            echo '</div>';	

            echo form_hidden('ident',$module);
            echo '<div class="form-group">';
            echo form_submit('valider', 'Valider', 'class="btn btn-lg btn-primary btn-block"');
            echo '</div>';
            echo form_close();
            echo '</div>';
            echo '</div>';        
        ?>

