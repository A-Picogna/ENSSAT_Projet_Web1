<h1 class="col-lg-12">Connexion au service de gestion des cours</h1>
<?php

    if (!isset($email) && !isset($password)){
        echo validation_errors();
        echo form_open('http://localhost/ENSSAT_Projet_Web1/CodeIgniter/index.php/loginVerification', 'role="form"', 'style=width:800px');
            echo '<div class="form-group col-lg-12">';
                echo form_label('Login :', 'username');
                echo form_input('login', set_value('login'), 'class="form-control"'). '<br/>';
            echo '</div>';
            echo '<div class="form-group col-lg-12">';
                echo form_label('Mot de passe :', 'pwd');
                echo form_password('mdp','','class="form-control"'). '<br/><br/>';
            echo '</div>';
            echo '<div class="form-group col-lg-2">';
                echo form_submit('submit', 'Connexion','class="btn btn-default"');
            echo '</div>';
        echo form_close();
    }
    
                                                                            
?>

