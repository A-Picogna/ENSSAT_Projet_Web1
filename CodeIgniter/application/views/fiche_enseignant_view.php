<?php header('Content-Type: text/html; charset=utf-8'); ?>

<ul>
	<?php echo "<li> ".$infosEnseignant[0]['nom']." ".$infosEnseignant[0]['prenom']." </li>"; ?>
	<?php echo "<li>Statut : ".$infosEnseignant[0]['statut']." </li>"; ?>
</ul>


<?php 
	$mod = '';
	foreach ($coursEnseignant as $cours) {

		if ($mod == '') {
			$mod = $cours["module"];
			echo "<ul><li>".$cours["libelle"]." - ".$cours["public"];
		}
		else if ($cours["module"] != $mod) {
			$mod = $cours["module"];
			echo "</li></ul><ul><li>".$cours["libelle"]." - ".$cours["public"];
		} 
		echo "<li>".$cours["partie"]." ".$cours["hed"]." h eq. ".$cours["type"]."</li>";
	}

	echo "</li></ul><ul>";

	if ($heuresCMEnseignant[0]['sum(hed)'] != '')
		echo "<li>Total ".$heuresCMEnseignant[0]['sum(hed)']." h eq. CM</li>";
	if ($heuresTDEnseignant[0]['sum(hed)'] != '')
		echo "<li>Total ".$heuresTDEnseignant[0]['sum(hed)']." h eq. TD</li>";
	if ($heuresTPEnseignant[0]['sum(hed)'] != null)
		echo "<li>Total ".$heuresTPEnseignant[0]['sum(hed)']." h eq. TP</li>";
	if ($heuresProjetEnseignant[0]['sum(hed)'] != null)
		echo "<li>Total ".$heuresProjetEnseignant[0]['sum(hed)']." h eq. Projet</li>";

	$total = ($heuresCMEnseignant[0]['sum(hed)'] + $heuresTDEnseignant[0]['sum(hed)'] + $heuresTPEnseignant[0]['sum(hed)'] + $heuresProjetEnseignant[0]['sum(hed)']);
	if ($total == null)
		$total = 0;
	echo "<li>Total ". $total ." h eq.</li></ul>";

?>
