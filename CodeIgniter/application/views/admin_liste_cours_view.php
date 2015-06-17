<script>$(document).ready( function () {$('#table_gestion_cours').DataTable();} );</script>

<div class="row">
    <div class="">
        <table id="table_gestion_cours" class="table table-striped text-center table-bordered" >
            <thead>
                <tr class="titre_tableau">
                    <th>Partie</th>
                    <th>Type</th>
                    <th>Hetd</th>
                    <th>Enseignant</th>
					<th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="ligne_couleur_alterne">
<?php
    foreach($liste_cours as $l){
        echo '<tr>';
        echo '<td>'.$l['partie'].'</td>';
        echo '<td>'.$l['type'].'</td>';
        echo '<td>'.$l['hed'].'</td>';
        echo '<td>'.$l['enseignant'].'</td>';
        echo '<td><a href="'.base_url().'index.php/gestionModule/modifierCours/'.$module['ident'].'/'.$l['partie'].'" <button class="btn btn-success btn-xs"><span title="Modifier" class="glyphicon glyphicon-pencil"></span></button></a></td>';
        echo '<td><a href="'.base_url().'index.php/gestionModule/supprimeCours/'.$module['ident'].'/'.$l['partie'].'" <button class="btn btn-danger btn-xs" onclick="return confirm(\'Attention ! Etes-vous sûr de vouloir supprimer ce cours ?\')"><span title="Supprimer" class="glyphicon glyphicon-trash" ></span></button></a></td>';
        echo '</tr>';
    }

?>       
            </tbody>
        </table>
		<div id="accordAjoutCours">
			<h3>Ajouter un cours</h3>
			<div>
<?php
			echo form_open('gestionModule/ajoutCours/'.$module['ident']);
			echo '<div class="form-group">';
			echo form_label('Partie', 'partie');
			echo form_input('partie', set_value('partie'));
			echo '</div>';
			echo '<div class="form-group">';
			echo form_label('Type', 'type');
			$options = array(
						      'CM'  => 'CM',
						      'TD'    => 'TD',
						      'TP'   => 'TP',
						      'Projet' => 'Projet'
						    );
			echo form_dropdown('type', $options);
			echo '</div>';
			echo '<div class="form-group">';
			echo form_label('Hetd', 'hed');
			echo form_input('hed', set_value('hed'));
			echo '</div>';
			echo '<div class="form-group">';
			echo form_label('Identifiant de l\'enseignant', 'idEnseignant');
			echo form_input('idEnseignant', set_value('idEnseignant'));
			echo '</div>';
			echo '<div class="form-group">';
			echo form_submit('valider', 'Valider');
			echo '</div>';
			echo form_close();
?>
			</div>
		</div>
    </div>
</div>
<script type='text/javascript'>
	$(document).ready(function() {
		$('#accordAjoutCours').accordion({
			collapsible: true,
		  	active: false,
			icons: { "header": "ui-icon-plus", "activeHeader": "ui-icon-minus"}
		});
	});
</script>
