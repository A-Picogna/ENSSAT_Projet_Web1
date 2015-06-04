<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $titre; ?></title>        
        <link href=<?php echo base_url()."assets/css/css_perso.css"; ?> rel="stylesheet">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <!-- Bootstrap -->
        <link href=<?php echo base_url()."assets/css/bootstrap.min.css"; ?> rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url();?>index.php/home">Gestion des cours</a>
                </div>
                <div>
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url();?>index.php/listeModules"><span class="glyphicon glyphicon-hand-up"></span> Liste Modules</a></li>
                        <li><a href="<?php echo base_url();?>index.php/ajoutModule"><span class="glyphicon glyphicon-book"></span> Ajouter un module</a></li>
                        <li><a href="<?php echo base_url();?>index.php/afficheEnseignant"><span class="glyphicon glyphicon-book"></span> Boulot Yasmine</a></li>
                        <li><a href="<?php echo base_url();?>index.php/afficheModule"><span class="glyphicon glyphicon-book"></span> Boulot Jihane</a></li>
                        <?php		
                        if (isset($this->session->userdata('info_user')['login']) && ($this->session->userdata('info_user')['administrateur'])) {
                        echo '
                        <li><a href="'.base_url().'index.php/home/ajout_utilisateur"><span class="glyphicon glyphicon-user"></span> Ajouter un utilisateur</a></li>
                        ';}?>
                    </ul>      
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo base_url();?>index.php/"><span class="glyphicon glyphicon-wrench"></span> Paramêtres de mon compte</a></li>
                        <li><a href="<?php echo base_url();?>index.php/home/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container"  style="margin-top:50px;">
      
      
    