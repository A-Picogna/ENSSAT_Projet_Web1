<?php echo validation_errors(); ?>

<div class="row">
    <div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<div id="accordAjoutCours">
        	<h1 class="text-center login-title">Ajoutez un cours</h1>
			<div>
<?php
			echo form_open('ajoutModule/ajoutCours');
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
