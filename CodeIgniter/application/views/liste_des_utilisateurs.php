<!-- Chargement du tableau intéractif -->
<script>$(document).ready( function () {$('#table_id').DataTable();} );</script>

<div class="row">
    <div class="">
        <h1 class="text-center login-title">Administration des utilisateurs</h1>
        <table id="table_id" class="table table-striped text-center table-bordered" >
            <thead>
                <tr class="titre_tableau">
                    <th></th>
                    <th>Login</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Statut</th>
                    <th>Statutaire</th>
                    <th>Actif</th>
                    <th>Administrateur</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="ligne_couleur_alterne">
<?php
    foreach($liste_utilisateurs as $l){
        echo '<tr>';
        echo '<td>'.form_checkbox('', 0, FALSE).'</td>';
        echo '<td>'.$l['login'].'</td>';
        echo '<td>'.$l['prenom'].'</td>';
        echo '<td>'.$l['nom'].'</td>';
        echo '<td>'.$l['statut'].'</td>';
        echo '<td>'.$l['statutaire'].'</td>';
        if ($l['actif']){echo '<td>Oui</td>';}else{echo '<td>Non</td>';}
        if ($l['administrateur']){echo '<td>Oui</td>';}else{echo '<td>Non</td>';}
        echo '<td><a href="'.base_url().'index.php/administration/supprimer_utilisateur/'.$l['login'].'"<button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button></a></td>';
        echo '</tr>';
    }

?>
                    
            </tbody>
        </table>
    </div>
</div>

