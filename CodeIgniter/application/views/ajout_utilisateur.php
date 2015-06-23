<div class="row">
    <div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3" style="margin-top:5%;">
        <div class="panel panel-primary">
            <div class="panel panel-heading">
                <h2 class="panel-title">Ajouter un utilisateur</h2>
            </div>
            <div class="panel-body">
<?php

$options_statut = array(
                  'administratif'  => 'Administratif',
                  'contractuel'    => 'Contractuel',
                  'titulaire'   => 'Titulaire',
                  'vacataire' => 'Vacataire',
                  'permanent' => 'Permanent',
                );

    
        echo form_open('ajoutUtilisateurVerification', '');
        echo validation_errors('<div class="alert alert-danger gras">', '</div>');
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
                echo form_label('Statut :', 'statut');
                echo form_dropdown('statut', $options_statut, '','class="form-control"');
            echo '</div>';  
            echo '<div class="form-group">';
                echo form_checkbox('admin', 1, FALSE).' Cet utilisateur sera administrateur';
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
    </div>
</div>