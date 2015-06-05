
<div class="row">
    <div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
<?php echo validation_errors(); ?>
<?php

echo form_open('ajoutModule/ajoutPremierCours');
echo '<div class="form-group">';
echo form_label('Identifiant', 'ident');
echo form_input('ident', set_value('ident'), 'class ="form-control" placeholder="Nom abrégé du module"');
echo '</div>';
echo '<div class="form-group">';
echo form_label('Libellé', 'libelle');
echo form_input('libelle', set_value('libelle'), 'class ="form-control" placeholder="Nom complet du module"');
echo '</div>';
echo '<div class="form-group">';
echo form_label('Public', 'public');
$options = array(
                  'IMR1'  => 'IMR1',
                  'IMR2'    => 'IMR2',
                  'IMR3'   => 'IMR3',
                  'EII1' => 'EII1',
                  'EII2'  => 'EII2',
                  'EII3'    => 'EII3',
                  'TC'    => 'TC',
                  'LSI1'    => 'LSI1',
                  'LSI2'    => 'LSI2',
                  'LSI3'    => 'LSI3',
                  'OPT1'    => 'OPT1',
                  'OPT2'    => 'OPT2',
                  'OPT3'    => 'OPT3'
                );
echo form_multiselect('public[]', $options, 'class ="form-control" ', 'id="multiselect_public"');
echo '</div>';
echo '<div class="form-group">';
echo form_label('Semestre', 'semestre');
$options = array(
                  'S1'  => 'S1',
                  'S2'    => 'S2',
                  'S3'   => 'S3',
                  'S4' => 'S4',
                  'S5'  => 'S5',
                  'S6'    => 'S6'
                );
echo form_dropdown('semestre', $options);
echo '</div>';
echo '<div class="form-group">';
echo form_label('Nom du responsable', 'nomResponsable');
echo form_input('nomResponsable', set_value('nomResponsable'), 'class ="form-control" ');
echo '</div>';
echo '<div class="form-group">';
echo form_label('Prénom du responsable', 'prenomResponsable');
echo form_input('prenomResponsable', set_value('prenomResponsable'), 'class ="form-control" ');
echo '</div>';
echo '<div class="form-group">';
echo form_submit('valider', 'Valider','class="btn btn-lg btn-primary btn-block"');
echo '</div>';
echo form_close();
?>
    </div>
</div>
<script type='text/javascript'>
	$(document).ready(function() {
		$('#multiselect_public').multiselect();
	});
</script>;
