<script>
    $(function(){$(".tooltip-link").tooltip();});
</script>
<h1 class="titre">Votre fiche enseignant</h1>
<div class="progress">
<?php
	if ($totalHeuresEnseignant == null)
		$totalHeuresEnseignant = 0;
    $max = $info_user['statutaire']-$decharge;
    $progress = round(($totalHeuresEnseignant/$max) * 100);
    echo '
    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="'.$totalHeuresEnseignant.'" aria-valuemin="0" aria-valuemax="'.$max.'" style="width: '.$progress.'%">
    '.$totalHeuresEnseignant.' h eq. TD sur '.$max.' heures totales ('.$progress.'%)';
?>
    </div>
</div>

<div class="row row-centered">
    
<?php 



	$mod = '';
    if (isset($coursEnseignant) && !empty($coursEnseignant)){
        foreach ($coursEnseignant as $cours) {
            if ($mod == '') {            
                $mod = $cours["module"];
                echo '				        
                    <div class="col-centered">
                        <div class="thumbnail">
                            <div class="caption">
                                <div class="panel panel-primary">
                                    <div class="panel panel-heading">
                                        <h2 class="panel-title">'.$cours["libelle"].'</h2>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="list-group">
                    ';
            }
            else if ($cours["module"] != $mod) {
                $mod = $cours["module"];
                echo '			
                                        </ul>                                
                                    </div>
                                    <div class="panel-footer">
                                        Public : '.$cours["public"].'
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>				        
                    <div class="col-centered">
                        <div class="thumbnail">
                            <div class="caption">
                                <div class="panel panel-primary">
                                    <div class="panel panel-heading">
                                        <h2 class="panel-title">'.$cours["libelle"].'</h2>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="list-group">
                    ';
            }

            echo' <li class="gras list-group-item  list-group-item-warning">';
            echo $cours["partie"];
            echo ' - '.$cours["hed"].' heq TD ';
            echo '           		
                <a href="'.base_url().'index.php/sedepositionner/depositionnement/'.$cours['partie'].'/'.$cours['module'].'"class="link tooltip-link" data-toggle="tooltip" data-original-title="Se dépositionner de cette partie">
                    <button class="btn btn-danger btn-xs">
                        <span class="glyphicon glyphicon-pushpin"></span>
                    </button>
                </a>';
            echo '</li>'; 
        }


        echo '			
                                        </ul>                                
                                    </div>
                                    <div class="panel-footer">
                                        Public : '.$cours["public"].'
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>		
            ';
    }
?>

	<head>
		
</div>


