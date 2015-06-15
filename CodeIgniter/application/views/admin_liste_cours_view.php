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
        echo '<td><a href="'.base_url().'index.php/gestionModule/modifierModule/'.$module['ident'].'/'.$l['partie'].'"<button class="btn btn-success btn-xs"><span title="Modifier" class="glyphicon glyphicon-pencil"></span></button></a></td>';
        echo '<td><a href="'.base_url().'index.php/gestionModule/supprimeModule/'.$module['ident'].'/'.$l['partie'].'"<button class="btn btn-danger btn-xs" onclick="return confirm(\'Attention ! Etes-vous sûr de vouloir supprimer ce cours ?\')"><span title="Supprimer" class="glyphicon glyphicon-trash" ></span></button></a></td>';
        echo '</tr>';
    }

?>
                    
            </tbody>
        </table>
    </div>
</div>
