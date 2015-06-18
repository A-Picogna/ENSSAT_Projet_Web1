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
<?php
$js_array = json_encode($filtered_text);
echo "<script type='text/javascript'>
	$(document).ready(function() {
		$('#multiselect_public_mod').SumoSelect();
		$.each($js_array, function(i,e){
			switch(e.replace(/\s/g, '')) {
				case 'IMR1' :
					$('#multiselect_public_mod')[0].sumo.selectItem(0);
					break;
                case 'IMR2' :
					$('#multiselect_public_mod')[0].sumo.selectItem(1);
					break;
                case'IMR3' :
					$('#multiselect_public_mod')[0].sumo.selectItem(2);
					break;
                case 'Info1' :
					$('#multiselect_public_mod')[0].sumo.selectItem(3);
					break;
                case 'Info2' :
					$('#multiselect_public_mod')[0].sumo.selectItem(4);
					break;
                case 'Info3' :
					$('#multiselect_public_mod')[0].sumo.selectItem(5);
					break;
                case 'TC' :
					alert('oui');
					$('#multiselect_public_mod')[0].sumo.selectItem(6);
					break;
                case 'Optro1' :
					$('#multiselect_public_mod')[0].sumo.selectItem(7);
					break;
                case 'Optro2' :
					$('#multiselect_public_mod')[0].sumo.selectItem(8);
					break;
                case 'Optro3' :
					$('#multiselect_public_mod')[0].sumo.selectItem(9);
					break;
                case 'Elec1' :
					$('#multiselect_public_mod')[0].sumo.selectItem(10);
					break;
                case 'Elec2' :
					$('#multiselect_public_mod')[0].sumo.selectItem(11);
					break;
                case 'Elec3':
					$('#multiselect_public_mod')[0].sumo.selectItem(12);
					break;
			}
			alert(e);
		});
	});
</script>";
?>
