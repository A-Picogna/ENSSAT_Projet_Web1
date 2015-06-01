<div class="row">
    <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4" style="margin-top:10%;">
        <h1 class="text-center login-title">Connectez vous à votre compte</h1>
        <div class="account-wall">
<?php
    if (!isset($email) && !isset($password)){
        echo form_open('loginVerification', 'class="form-signin"');
        echo validation_errors();
            echo '<div class="form-group">';
        echo form_open("loginVerification", 'role="form"', 'style=width:800px');
            echo '<div class="form-group col-lg-12">';
                echo form_label('Login :', 'username');
                echo form_input('login', set_value('login'), 'class="form-control" placeholder="Saisir votre login"');
            echo '</div>';
            echo '<div class="form-group">';
                echo form_label('Mot de passe :', 'pwd');
                echo form_password('mdp','','class="form-control" placeholder="Saisir votre mot de passe"');
            echo '</div>';
            echo '<div class="form-group">';
                echo form_submit('submit', 'Connexion','class="btn btn-lg btn-primary btn-block"');
            echo '</div>';
            echo '<div class="form-group">';
                echo form_checkbox('remember_me', 'remember_me', FALSE).' Se souvenir de moi';
            echo '</div>';
        echo form_close();
    }                                                                            
?>
        </div>
    </div>
</div>
