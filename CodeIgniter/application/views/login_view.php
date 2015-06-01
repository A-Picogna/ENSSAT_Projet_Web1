<h1 class="col-lg-12">Connexion au service de gestion des cours</h1>
<?php

    if (!isset($email) && !isset($password)){
        echo validation_errors();
        echo form_open('loginVerification', 'role="form"', 'style=width:800px');
            echo '<div class="form-group col-lg-12">';
                echo form_label('Login :', 'username');
                echo form_input('login', set_value('login'), 'class="form-control" placeholder="Saisir votre login"'). '<br/>';
            echo '</div>';
            echo '<div class="form-group col-lg-12">';
                echo form_label('Mot de passe :', 'pwd');
                echo form_password('mdp','','class="form-control" placeholder="Saisir votre mot de passe"'). '<br/><br/>';
            echo '</div>';
            echo '<div class="form-group col-lg-2">';
                echo form_submit('submit', 'Connexion','class="btn btn-default"');
            echo '</div>';
        echo form_close();
    }
    
                                                                            
?>

