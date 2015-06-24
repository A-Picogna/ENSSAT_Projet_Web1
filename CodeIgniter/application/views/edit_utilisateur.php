<div class="row">
    <h1 class="titre">Modifier les paramètres du compte</h1>
    <div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
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


        echo form_open('editUtilisateurVerification', 'data-toggle="validator"');
        echo validation_errors('<div class="alert alert-danger gras">', '</div>');
        echo '<div class="form-group">';
            echo form_label('Login', 'username');
            echo form_input('login', set_value('login', $info_user['login']), 'class="form-control" readonly');
        echo '</div>';        
        echo form_open('home/changer_mdp', '');


        echo '<div class="form-group">';
            echo form_label('Nom', 'nom');
            echo form_input('nom', $info_user['nom'], 'class="form-control"');
        echo '</div>';
        echo '<div class="form-group">';
            echo form_label('Prénom', 'prenom');
            echo form_input('prenom', $info_user['prenom'], 'class="form-control"');
        echo '</div>';   
        echo '<div class="form-group">';
            echo form_label('Nombre d\'heures statutaires', 'statut');
            echo form_input('statutaire', $info_user['statutaire'], 'class="form-control"');
        echo '</div>';    
        echo '<div class="form-group">';
            echo form_label('Volume horaire de décharge', 'decharge');
            echo form_input('decharge', $decharge, 'class="form-control"');
        echo '</div>';      
        echo '<div class="form-group">';
            echo form_label('Statut', 'statut');
            echo form_dropdown('statut',$options_statut, $info_user['statut'], 'class="form-control"');
        echo '</div>'; 
        
        if($this->session->userdata('info_user')['administrateur']){
            echo '<div class="form-group">';
                echo form_label('Administrateur', 'admin');
                echo form_dropdown('admin', $options_admin, $info_user['administrateur'], 'class="form-control"');
            echo '</div>';
        }


        echo '<div class="form-group">';
            echo form_label('Mot de passe', 'mdp');
            echo form_password('mdp', '', 'class="form-control" placeholder="Saisir le nouveau mot de passe"');
        echo '</div>';
        echo '<div class="form-group">';
            echo form_label('Vérification du mot de passe', 'Vmdp');
            echo form_password('Vmdp', '', 'class="form-control" placeholder="Confirmer le nouveau mot de passe"');
        echo '</div>';

        echo '<div class="form-group">';
            echo form_submit('submit', 'Valider la saisie','class="btn btn-lg btn-success btn-block"');
        echo '</div>';         
        echo '<div class="form-group">';
            echo form_reset('submit', 'reset','class="btn btn-lg btn-info btn-block"');
        echo '</div>';

        echo form_close();  

             
                                                               
?>        
    </div>
</div>
