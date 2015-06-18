
<div class="row">
    <div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3" style="margin-top:5%;">
        <div class="panel panel-primary">
            <div class="panel panel-heading">
                <h2 class="panel-title">Ajouter un module</h2>
            </div>
            <div class="panel-body">
<?php echo validation_errors(); ?>
<?php

echo form_open('ajoutModule/ajoutPremierCours');
echo '<div class="form-group">';
echo form_label('Identifiant', 'ident');
echo form_input('ident', set_value('ident'), 'class ="form-control" placeholder="Nom abrégé du module, Ex : ALGOC1 ou PROGWEB"');
echo '</div>';
echo '<div class="form-group">';
echo form_label('Libellé', 'libelle');
echo form_input('libelle', set_value('libelle'), 'class ="form-control" placeholder="Nom complet du module"');
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
echo form_label('Public', 'public');
echo form_multiselect('public[]', $options, 'class ="form-control" ', 'id="multiselect_public" data-placeholder="Filière(s) concernée(s)"');
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
echo form_dropdown('semestre', $options, 'class ="form-control" ');
echo '</div>';
echo '<div class="form-group">';
echo form_label('Identifiant du responsable', 'idResponsable');
echo form_input('idResponsable', set_value('idResponsable'), 'class ="form-control" placeholder="Identifiant du responsable"');
echo '</div>';
echo '<div class="form-group">';
echo form_submit('valider', 'Valider','class="btn btn-lg btn-primary btn-block"');
echo '</div>';
echo form_close();
?>
            </div>
        </div>        
    </div>
</div>
<?php
$js_array = null;
if (isset($public)) {
	$js_array = json_encode($public);
}
echo "<script type='text/javascript'>
	$(document).ready(function() {
		$('#multiselect_public').SumoSelect();";
if($js_array != null) {
	echo	"$.each($js_array, function(i,e){
				switch(e.replace(/\s/g, '')) {
					case 'IMR1' :
						$('#multiselect_public')[0].sumo.selectItem(0);
						break;
		            case 'IMR2' :
						$('#multiselect_public')[0].sumo.selectItem(1);
						break;
		            case'IMR3' :
						$('#multiselect_public')[0].sumo.selectItem(2);
						break;
		            case 'Info1' :
						$('#multiselect_public')[0].sumo.selectItem(3);
						break;
		            case 'Info2' :
						$('#multiselect_public')[0].sumo.selectItem(4);
						break;
		            case 'Info3' :
						$('#multiselect_public')[0].sumo.selectItem(5);
						break;
		            case 'TC' :
						alert('oui');
						$('#multiselect_public')[0].sumo.selectItem(6);
						break;
		            case 'Optro1' :
						$('#multiselect_public')[0].sumo.selectItem(7);
						break;
		            case 'Optro2' :
						$('#multiselect_public')[0].sumo.selectItem(8);
						break;
		            case 'Optro3' :
						$('#multiselect_public')[0].sumo.selectItem(9);
						break;
		            case 'Elec1' :
						$('#multiselect_public')[0].sumo.selectItem(10);
						break;
		            case 'Elec2' :
						$('#multiselect_public')[0].sumo.selectItem(11);
						break;
		            case 'Elec3':
						$('#multiselect_public')[0].sumo.selectItem(12);
						break;
				}
			});";
}
echo "});
</script>";
?>
