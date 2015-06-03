<?php echo validation_errors(); ?>

<h2>Ajouter un cours</h2>
<?php

echo form_open('ajoutModule/ajoutCours');
echo form_label('Partie', 'partie');
echo form_input('partie', set_value('partie'));
echo "<br/>";
echo form_label('Type', 'type');
$options = array(
                  'CM'  => 'CM',
                  'TD'    => 'TD',
                  'TP'   => 'TP',
                  'Projet' => 'Projet'
                );
echo form_dropdown('type', $options);
echo "<br/>";
echo form_label('Hed', 'hed');
echo form_input('hed', set_value('hed'));
echo "<br/>";
echo form_label('Nom enseignant', 'nomEnseignant');
echo form_input('nomEnseignant', set_value('nomEnseignant'));
echo "<br/>";
echo form_label('Prenom enseignant', 'prenomEnseignant');
echo form_input('prenomEnseignant', set_value('prenomEnseignant'));
echo "<br/>";
echo form_submit('valider', 'Valider');
echo form_close();

?>
