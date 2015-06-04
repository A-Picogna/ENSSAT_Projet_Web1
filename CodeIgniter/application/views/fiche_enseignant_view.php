
<?php echo "<p> ".$infosEnseignant[0]['nom']." ".$infosEnseignant[0]['prenom']." </br>"; ?>
<?php echo "Statut : ".$infosEnseignant[0]['statut']." </p>"; ?>


<?php 
	$mod = '';
	foreach ($coursEnseignant as $cours) {

		if ($mod == '') {
			$mod = $cours["module"];
			echo "<table class='table table-striped'><tr><th colspan='2'>".$cours["libelle"]." - ".$cours["public"]."</th></tr>";
		}
		else if ($cours["module"] != $mod) {
			$mod = $cours["module"];
			echo "</table><table class='table table-striped'><tr><th colspan='2'>".$cours["libelle"]." - ".$cours["public"]."</th></tr>";
		} 
		echo "<tr><td>".$cours["partie"]."</td><td>".$cours["hed"]." h eq. TD</td></tr>";
	}

	echo "</table><table class='table table-striped'>";

	$total = ($heuresCMEnseignant[0]['sum(hed)'] + $heuresTDEnseignant[0]['sum(hed)'] + $heuresTPEnseignant[0]['sum(hed)'] + $heuresProjetEnseignant[0]['sum(hed)']);
	if ($total == null)
		$total = 0;
	echo "<tr><td>Total</td><td>". $total ." h eq. TD</tr></td></table>";

?>
