<div class="row">
    <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4" style="margin-top:10%;">
        <h1 class="text-center login-title">Ajoutez un utilisateur</h1>
        <div class="account-wall">
<?php

$options_statut = array(
                  'administratif'  => 'Administratif',
                  'contractuel'    => 'Contractuel',
                  'titulaire'   => 'Titulaire',
                  'vacataire' => 'Vacataire',
                  'permanent' => 'Permanent',
                );





    if (!isset($email) && !isset($password)){
        echo form_open('ajoutUtilisateurVerification', '');
        echo validation_errors();
            echo '<div class="form-group">';
                echo form_label('Login :', 'username');
                echo form_input('login', set_value('login'), 'class="form-control" placeholder="Saisir votre login"');
            echo '</div>';
            echo '<div class="form-group">';
                echo form_label('Mot de passe', 'mdp');
                echo form_password('mdp', '', 'class="form-control" placeholder="Saisir le mot de passe"');
            echo '</div>';
            echo '<div class="form-group">';
                echo form_label('Verification du mot de passe :', 'Vmdp');
                echo form_password('Vmdp', '', 'class="form-control" placeholder="Saisir de nouveau le mot de passe"');
            echo '</div>';
            echo '<div class="form-group">';
                echo form_label('Nom :', 'nom');
                echo form_input('nom', set_value('nom'), 'class="form-control" placeholder="Saisir le nom"');
            echo '</div>';
            echo '<div class="form-group">';
                echo form_label('Prenom :', 'prenom');
                echo form_input('prenom', set_value('prenom'), 'class="form-control" placeholder="Saisir le prenom"');
            echo '</div>';   
            echo '<div class="form-group">';
                echo form_dropdown('statut', $options_statut, '');
            echo '</div>';  
            echo '<div class="form-group">';
                echo form_checkbox('admin', 1, FALSE).' Cet utilisateur sera administrateur';
            echo '</div>';         
            echo '<div class="form-group">';
                echo form_submit('submit', 'Valider la saisie','class="btn btn-lg btn-success"');
            echo '</div>';         
            echo '<div class="form-group">';
                echo form_reset('submit', 'reset','class="btn btn-lg btn-info"');
            echo '</div>';
        
        echo form_close();
    }                                                                            
?>
        </div>
    </div>
</div>