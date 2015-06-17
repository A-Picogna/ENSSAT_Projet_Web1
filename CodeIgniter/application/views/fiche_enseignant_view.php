<script>
    $(function(){$(".tooltip-link").tooltip();});
</script>

<?php echo "<p> ".$infosEnseignant[0]['nom']." ".$infosEnseignant[0]['prenom']." </br>"; ?>
<?php echo "Statut : ".$infosEnseignant[0]['statut']." </p>"; ?>

<?php echo "" 
?>

<?php 
	$mod = '';
	foreach ($coursEnseignant as $cours) {
        echo "<table class='table table-striped'>";
		if ($mod == '') {
			$mod = $cours["module"];
			echo "
				<tr><th colspan='3'>".$cours["libelle"]." - ".$cours["public"]." </th></tr>
				";
		}
		else if ($cours["module"] != $mod) {
			$mod = $cours["module"];
			echo "
				<tr><th colspan='3'>".$cours["libelle"]." - ".$cours["public"]."</th></tr>
				";
		}
		echo "  <tr>
                    <td>
                        ".$cours["partie"]."</td><td>".$cours["hed"]." h eq. TD
                    </td>
                    <td>
                        <div align='right'>            		
                            <a href='".base_url()."index.php/sedepositionner/depositionnement/".$cours['partie']."/".$cours['module']."'class=\"link tooltip-link\" data-toggle=\"tooltip\" data-original-title=\"Se dépositionner de cette partie\">
                                <button class='btn btn-danger btn-xs'>
                                    <span class='glyphicon glyphicon-pushpin'></span>
                                </button>
                            </a>
                        </div>
				    </td>
                </tr>
			";
	}

	echo "</table><div><span class='badge badge-info'><h4>";

	$total = ($heuresCMEnseignant[0]['sum(hed)'] + $heuresTDEnseignant[0]['sum(hed)'] + $heuresTPEnseignant[0]['sum(hed)'] + $heuresProjetEnseignant[0]['sum(hed)']);
	if ($total == null)
		$total = 0;
	echo "Total : ".$total." h eq. TD</tr></td></h4></span></div>";

?>
