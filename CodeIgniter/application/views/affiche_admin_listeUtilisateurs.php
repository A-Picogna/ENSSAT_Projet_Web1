<script>
    $(document).ready( function () {$('#table_id').DataTable();} );
    $(function(){$(".tooltip-link").tooltip();});
    $(document).ready(function(){
        var user_data;
        $('.my_button').click(function(){
            <?php 
                $liste = json_encode($liste_utilisateurs); 
                echo "user_data = $liste;";
            ?>
            var user_index = ($(this).val());
            user_data = user_data[user_index];
            $("input[name='login']").val(user_data["login"]);
            $("input[name='nom']").val(user_data["nom"]);
            $("input[name='prenom']").val(user_data["prenom"]);
            $("input[name='statutaire']").val(user_data["statutaire"]);
            $("input[name='decharge']").val(user_data["decharge"]);
            $("input[name='statut']").val(user_data["statut"]);
            $("input[name='admin']").val(user_data["admin"]);
        });
    });
    $(document).ready(function(){
    });
</script>


<div class="row">
    <div class="">
        <h1 class="text-center">Administration des utilisateurs</h1>
        <?php echo validation_errors(); ?>
        <table id="table_id" class="table text-center table-bordered" >
            <thead>
                <tr class="titre_tableau">
                    <th>Login</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Statut</th>
                    <th>Statutaire</th>
                    <th>Decharge</th>
                    <th>Administrateur</th>
                    <th>Etat</th>
                    <th>Edit</th>
                    <th>Del</th>
                </tr>
            </thead>
            <tbody class="ligne_couleur_alterne">
<?php
    $i = 0;
    foreach($liste_utilisateurs as $l){
        echo '<tr>';
        echo '<td>'.$l['login'].'</td>';
        echo '<td>'.$l['prenom'].'</td>';
        echo '<td>'.$l['nom'].'</td>';
        echo '<td>'.$l['statut'].'</td>';
        echo '<td>'.$l['statutaire'].'</td>';
        echo '<td>'.$l['decharge'].'</td>';
        if ($l['administrateur']){echo '<td>Oui</td>';}else{echo '<td>Non</td>';}
        if ($l['actif']){
        echo '  <td>
                <a href="'.base_url().'index.php/administration/desactiver_utilisateur/'.$l['login'].'" 	  
                    class="link tooltip-link" 
                    data-toggle="tooltip"
                    data-original-title="Rendre inactif">
                <button class="btn btn-success btn-xs" onclick="return confirm(\'Etes-vous sûr de vouloir désactiver cet utilisateur ? \')">
                <span class="glyphicon glyphicon-flash"></span>
                </button>
                </a>
                </td>';
        }
        else{
        echo '  <td>
                <a href="'.base_url().'index.php/administration/activer_utilisateur/'.$l['login'].'" 	  
                    class="link tooltip-link" 
                    data-toggle="tooltip"
                    data-original-title="Rendre actif">
                <button class="btn btn-warning btn-xs">
                <span class="glyphicon glyphicon-flash" ></span>
                </button>
                </a>
                </td>';        
        }
        echo '  <td>
                <a href="#" 	  
                    class="link tooltip-link" 
                    data-toggle="tooltip"
                    data-original-title="Modifier">
                <button value='.$i.' class="btn btn-primary btn-xs my_button" data-toggle="modal" data-target="#myModal">
                <span class="glyphicon glyphicon-pencil"></span>
                </button>
                </a>
                </td>';
        echo '  <td>
                <a href="'.base_url().'index.php/administration/supprimer_utilisateur/'.$l['login'].'" 	  
                    class="link tooltip-link" 
                    data-toggle="tooltip"
                    data-original-title="Supprimer">
                <button class="btn btn-danger btn-xs" onclick="return confirm(\'Attention ! Etes-vous sûr de vouloir supprimer cet utilisateur ? \')">
                <span class="glyphicon glyphicon-trash" ></span>
                </button>
                </a>
                </td>';        
        echo '</tr>';
        $i++;
    }

?>                    
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 class="modal-title text-center login-title">Modifier les paramètres du compte</h1>
            </div>
            <div class="modal-body">
                <?php

$options_statut = array(
                  'administratif'  => 'Administratif',
                  'contractuel'    => 'Contractuel',
                  'titulaire'   => 'Titulaire',
                  'vacataire' => 'Vacataire',
                  'permanent' => 'Permanent',
                );
$options_admin = array(
                  1  => 'Oui',
                  0    => 'Non',
                );


        echo form_open('editUtilisateurVerification', '');
        echo '<div class="form-group">';
            echo form_label('Login', 'username');
            echo form_input('login', set_value('login', ''), 'class="form-control" readonly');
        echo '</div>';        
        echo form_open('home/changer_mdp', '');


        echo '<div class="form-group">';
            echo form_label('Nom', 'nom');
            echo form_input('nom', '', 'class="form-control"');
        echo '</div>';
        echo '<div class="form-group">';
            echo form_label('Prenom', 'prenom');
            echo form_input('prenom', '', 'class="form-control"');
        echo '</div>';   
        echo '<div class="form-group">';
            echo form_label('Nombre d\'heure statutaire', 'statut');
            echo form_input('statutaire', '', 'class="form-control"');
        echo '</div>';    
        echo '<div class="form-group">';
            echo form_label('Volume horaire de decharge', 'decharge');
            echo form_input('decharge', '', 'class="form-control"');
        echo '</div>';      
        echo '<div class="form-group">';
            echo form_label('Statut', 'statut');
            echo form_dropdown('statut',$options_statut, '', 'class="form-control"');
        echo '</div>'; 
        
        if($this->session->userdata('info_user')['administrateur']){
            echo '<div class="form-group">';
                echo form_label('Administrateur', 'admin');
                echo form_dropdown('admin', $options_admin, '', 'class="form-control"');
            echo '</div>';
        }


        echo '<div class="form-group">';
            echo form_label('Mot de passe', 'mdp');
            echo form_password('mdp', '', 'class="form-control" placeholder="Saisir le nouveau mot de passe"');
        echo '</div>';
        echo '<div class="form-group">';
            echo form_label('Verification du mot de passe', 'Vmdp');
            echo form_password('Vmdp', '', 'class="form-control" placeholder="Confirmer le nouveau mot de passe"');
        echo '</div>';
        echo '<div class="modal-footer">';
        echo '<div class="form-group">';
            echo form_submit('submit', 'Valider la saisie','class="btn btn-lg btn-success"');
            echo form_reset('submit', 'reset','class="btn btn-lg btn-info"');
        echo '</div>';
        echo '</div>';

        echo form_close();  

             
                                                               
?>
            </div>
        </div>
    </div>
</div>

