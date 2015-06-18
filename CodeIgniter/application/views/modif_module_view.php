<div class="row">
    <div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <h1 class="text-center login-title">Modifier le module</h1>
<?php echo validation_errors(); ?>
<?php

echo form_open('gestionModule/modificationModule');
echo '<div class="form-group">';
echo form_label('Identifiant', 'ident');
echo form_input('ident', $module["ident"], 'class="form-control" placeholder="Nom abrégé du module" readonly="true"');
echo '</div>';
echo '<div class="form-group">';
echo form_label('Libellé', 'libelle');
echo form_input('libelle', $module["libelle"], 'class ="form-control" placeholder="Nom complet du module"');
echo '</div>';
echo '<div class="form-group">';
$options = array(
                  'IMR1'  => 'IMR1',
                  'IMR2'  => 'IMR2',
                  'IMR3'  => 'IMR3',
                  'Info1' => 'Info1',
                  'Info2' => 'Info2',
                  'Info3' => 'Info3',
                  'TC'    => 'TC',
                  'Optro1'  => 'Optro1',
                  'Optro2'  => 'Optro2',
                  'Optro3'  => 'Optro3',
                  'Elec1'  => 'Elec1',
                  'Elec2'  => 'Elec2',
                  'Elec3'  => 'Elec3'
                );
$filtered_text = explode( "  ", str_replace(["commun", "et"], "", $module["public"]));
echo form_label('Public', 'public');
echo form_multiselect('public[]', $options, 'class ="form-control chosen-select" ', 'id="multiselect_public_mod" data-placeholder="Filière(s) concernée(s)"');
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
echo form_dropdown('semestre', $options, $module["semestre"], 'class ="form-control" ');
echo '</div>';
echo '<div class="form-group">';
echo form_label('Identifiant du responsable', 'idResponsable');
echo form_input('idResponsable', $module["responsable"], 'class ="form-control" placeholder="Identifiant du responsable"');
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
		$('#multiselect_public_mod').chosen({width: '100%'});
	});
</script>;
