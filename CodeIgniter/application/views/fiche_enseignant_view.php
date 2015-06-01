<?php header('Content-Type: text/html; charset=utf-8'); ?>

	<?php echo "<p> ".$infosEnseignant[0]['nom']." ".$infosEnseignant[0]['prenom']." </br>"; ?>
	<?php echo "Statut : ".$infosEnseignant[0]['statut']." </p>"; ?>


<?php 
	$mod = '';
	foreach ($coursEnseignant as $cours) {

		if ($mod == '') {
			$mod = $cours["module"];
			echo "<table><tr><th colspan='2'>".$cours["libelle"]." - ".$cours["public"]."</th></tr>";
		}
		else if ($cours["module"] != $mod) {
			$mod = $cours["module"];
			echo "</table><table><tr><th colspan='2'>".$cours["libelle"]." - ".$cours["public"]."</th></tr>";
		} 
		echo "<tr><td>".$cours["partie"]."</td><td>".$cours["hed"]." h eq. ".$cours["type"]."</td></tr>";
	}

	echo "</table><table>";

	if ($heuresCMEnseignant[0]['sum(hed)'] != '')
		echo "<tr><td>Total</td><td>".$heuresCMEnseignant[0]['sum(hed)']." h eq. CM</tr></td>";
	if ($heuresTDEnseignant[0]['sum(hed)'] != '')
		echo "<tr><td>Total</td><td>".$heuresTDEnseignant[0]['sum(hed)']." h eq. TD</tr></td>";
	if ($heuresTPEnseignant[0]['sum(hed)'] != null)
		echo "<tr><td>Total</td><td>".$heuresTPEnseignant[0]['sum(hed)']." h eq. TP</tr></td>";
	if ($heuresProjetEnseignant[0]['sum(hed)'] != null)
		echo "<tr><td>Total</td><td>".$heuresProjetEnseignant[0]['sum(hed)']." h eq. Projet</tr></td>";

	$total = ($heuresCMEnseignant[0]['sum(hed)'] + $heuresTDEnseignant[0]['sum(hed)'] + $heuresTPEnseignant[0]['sum(hed)'] + $heuresProjetEnseignant[0]['sum(hed)']);
	if ($total == null)
		$total = 0;
	echo "<tr><td>Total</td><td>". $total ." h</tr></td></table>";

?>
