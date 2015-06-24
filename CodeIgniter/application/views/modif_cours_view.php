<div class="row">
    <h1 class="titre">Modifier le cours</h1>
    <div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
<?php echo validation_errors('<div class="alert alert-danger gras">', '</div>'); ?>
		<div>
<?php
		echo form_open('gestionModule/modificationCours/'.$ident.'/'.$cours["partie"]);
		echo '<div class="form-group">';
		echo form_label('Partie', 'partie');
		echo form_input('partie', $cours["partie"], 'class="form-control" placeholder="Nom de la partie" readonly="true"');
		echo '</div>';
		echo '<div class="form-group">';
		echo form_label('Type', 'type');
		$options = array(
					      'CM'  => 'CM',
					      'TD'    => 'TD',
					      'TP'   => 'TP',
					      'Projet' => 'Projet'
					    );
		echo form_dropdown('type', $options, array($cours["type"]), 'class="form-control"');
		echo '</div>';
		echo '<div class="form-group">';
		echo form_label('Hetd', 'hed');
		echo form_input('hed', $cours["hed"], 'class="form-control"');
		echo '</div>';
		echo '<div class="form-group">';
		echo form_label('Identifiant de l\'enseignant', 'idEnseignant');
		echo form_input('idEnseignant', $cours["enseignant"], 'class="form-control"');
		echo '</div>';
		echo '<div class="form-group">';
		echo form_submit('valider', 'Valider', 'class="btn btn-lg btn-primary');
		echo '</div>';
		echo form_close();
?>
		</div>
    </div>
</div>
