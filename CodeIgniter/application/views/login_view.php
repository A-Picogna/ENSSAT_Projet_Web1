<h1>Connexion au service de gestion des cours</h1>
<?php

    if (!isset($email) && !isset($password)){
        echo validation_errors();
        echo form_open('http://localhost/ENSSAT_Projet_Web1/CodeIgniter/index.php/loginVerification');
        echo form_label('Login :', 'username').'<br/>'. form_input('login', set_value('login')). '<br/>';
        echo form_label('Mot de passe :', 'pwd').'<br/>'. form_password('mdp',''). '<br/><br/>';
        echo form_submit('submit', 'Connexion');
        echo form_close();
    }
                                                                            
?>
