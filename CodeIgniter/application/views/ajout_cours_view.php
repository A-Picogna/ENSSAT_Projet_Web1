<?php echo validation_errors(); ?>

<h2>Ajouter un cours</h2>
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
