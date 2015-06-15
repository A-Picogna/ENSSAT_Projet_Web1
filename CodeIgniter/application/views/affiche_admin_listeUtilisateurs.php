<!-- Chargement du tableau intéractif -->
<script>
    $(document).ready( function () {$('#table_id').DataTable();} );
</script>

<div class="row">
    <div class="">
        <h1 class="text-center login-title">Administration des utilisateurs</h1>
        <table id="table_id" class="table table-striped text-center table-bordered" >
            <thead>
                <tr class="titre_tableau">
                    <th>Login</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Statut</th>
                    <th>Statutaire</th>
                    <th>Actif</th>
                    <th>Administrateur</th>
                    <th>Edit</th>
                    <th>Del</th>
                    <th>Etat</th>
                </tr>
            </thead>
            <tbody class="ligne_couleur_alterne">
<?php
    foreach($liste_utilisateurs as $l){
        echo '<tr>';
        echo '<td>'.$l['login'].'</td>';
        echo '<td>'.$l['prenom'].'</td>';
        echo '<td>'.$l['nom'].'</td>';
        echo '<td>'.$l['statut'].'</td>';
        echo '<td>'.$l['statutaire'].'</td>';
        if ($l['actif']){echo '<td>Oui</td>';}else{echo '<td>Non</td>';}
        if ($l['administrateur']){echo '<td>Oui</td>';}else{echo '<td>Non</td>';}
        echo '<td><a href="'.base_url().'index.php/home/modifier_utilisateur/'.$l['login'].'"<button class="btn btn-primary btn-xs"><span title="Modifier" class="glyphicon glyphicon-pencil"></span></button></a></td>';
        echo '<td><a href="'.base_url().'index.php/administration/supprimer_utilisateur/'.$l['login'].'"<button class="btn btn-danger btn-xs" onclick="return confirm(\'Attention ! Etes-vous sûr de vouloir supprimer cet utilisateur ? \')"><span title="Supprimer" class="glyphicon glyphicon-trash" ></span></button></a></td>';
        if ($l['actif']){
        echo '<td><a href="'.base_url().'index.php/administration/desactiver_utilisateur/'.$l['login'].'"<button class="btn btn-success btn-xs" onclick="return confirm(\'Etes-vous sûr de vouloir désactiver cet utilisateur ? \')"><span title="Rendre inactif" class="glyphicon glyphicon-flash" ></span></button></a></td>';
        }
        else{
        echo '<td><a href="'.base_url().'index.php/administration/activer_utilisateur/'.$l['login'].'"<button class="btn btn-warning btn-xs"><span title="Rendre actif" class="glyphicon glyphicon-flash" ></span></button></a></td>';        
        }
        echo '</tr>';
    }

?>                    
            </tbody>
        </table>
    </div>
</div>
