<!-- Chargement du tableau intéractif -->
<script>
    $(document).ready( function () {$('#table_id').DataTable();} );
</script>

<div class="row">
    <div class="">
        <h1 class="text-center login-title">Vue des utilisateurs</h1>
        <table id="table_id" class="table text-center table-bordered" >
            <thead>
                <tr class="titre_tableau">
                    <th>Login</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Statutaire</th>
                    <th>Service</th>
                </tr>
            </thead>
            <tbody class="ligne_couleur_alterne">
<?php
    foreach($liste_utilisateurs as $l){
        echo '<tr>';
        echo '<td>'.$l['login'].'</td>';
        echo '<td>'.$l['prenom'].'</td>';
        echo '<td>'.$l['nom'].'</td>';
        echo '<td>'.$l['statutaire'].'</td>';
        echo '<td>'.$l['service'].'</td>';
        //if ($l['administrateur']){echo '<td>Oui</td>';}else{echo '<td>Non</td>';}        
        echo '</tr>';
    }

?>                    
            </tbody>
        </table>
    </div>
</div>