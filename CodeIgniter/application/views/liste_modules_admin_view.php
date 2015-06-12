<script>$(document).ready( function () {$('#table_gestion_module').DataTable();} );</script>

<div class="row">
    <div class="">
        <h1 class="text-center login-title">Administration des modules</h1>
        <table id="table_gestion_module" class="table table-striped text-center table-bordered" >
            <thead>
                <tr class="titre_tableau">
                    <th>Identifiant</th>
                    <th>Libellé</th>
                    <th>Public</th>
                    <th>Semestre</th>
                    <th>Responsable</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="ligne_couleur_alterne">
<?php
    foreach($liste_modules as $l){
        echo '<tr>';
        echo '<td>'.$l['ident'].'</td>';
        echo '<td>'.$l['libelle'].'</td>';
        echo '<td>'.$l['public'].'</td>';
        echo '<td>'.$l['semestre'].'</td>';
        echo '<td>'.$l['responsable'].'</td>';
        echo '<td><a href="'.base_url().'index.php/gestionModule/supprimeModule/'.$l['ident'].'"<button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></a></td>';
        echo '</tr>';
    }

?>
                    
            </tbody>
        </table>
    </div>
</div>
