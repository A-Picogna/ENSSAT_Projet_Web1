<h1 class="text-center login-title">Fiche enseignant</h1>
<?php echo "<p> ".$infosEnseignant[0]['nom']." ".$infosEnseignant[0]['prenom']." </br>"; ?>
<?php echo "Statut : ".$infosEnseignant[0]['statut']." </p>"; ?>

<?php echo "" 
?>

<?php 
	$mod = '';
	foreach ($coursEnseignant as $cours) {

		if ($mod == '') {
			$mod = $cours["module"];
			echo "
					<table class='table table-striped'><tr><th colspan='2'>".$cours["libelle"]." - ".$cours["public"]." </th></tr>

				";
		}
		else if ($cours["module"] != $mod) {
			$mod = $cours["module"];
			echo "
					</table><table class='table table-striped'><tr><th colspan='2'>".$cours["libelle"]." - ".$cours["public"]."</th></tr>
				";
		}

		echo "
				<tr><td>".$cours["partie"]."</td><td>".$cours["hed"]." h eq. TD


					<div align='right'>
            		
            			<a href='".base_url()."index.php/sedepositionner/depositionnement/".$cours['partie']."/".$cours['module']."'>
	            			<button class='btn btn-primary btn-xs'>
	                			Se dépositionner de cette partie
	            			</button>
           				</a>
           				

				</td></tr>
			";
	}

	echo "</table><table class='table table-striped'>";

	$total = ($heuresCMEnseignant[0]['sum(hed)'] + $heuresTDEnseignant[0]['sum(hed)'] + $heuresTPEnseignant[0]['sum(hed)'] + $heuresProjetEnseignant[0]['sum(hed)']);
	if ($total == null)
		$total = 0;
	echo "<tr><td>Total</td><td>". $total ." h eq. TD</tr></td></table>";

?>
