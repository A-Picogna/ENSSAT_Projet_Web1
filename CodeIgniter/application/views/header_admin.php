<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $titre; ?></title>        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- JQuery -->
		<link rel="stylesheet" href=<?php echo base_url()."assets/css/jquery-ui.min.css"; ?> type="text/css"/>
		<script type="text/javascript" src=<?php echo base_url()."assets/js/jquery.min.js"; ?>></script>
		<script type="text/javascript" src=<?php echo base_url()."assets/js/jquery-ui.min.js"; ?>></script>
        
        <!-- Bootstrap -->
        <link href=<?php echo base_url()."assets/css/bootstrap.min.css"; ?> rel="stylesheet">
        <link rel="stylesheet" href=<?php echo base_url()."assets/css/bootstrap.min.css"; ?> type="text/css">
		<script type="text/javascript" src=<?php echo base_url()."assets/js/bootstrap.min.js"; ?>></script>
        
        <!-- Chosen -->
		<link rel="stylesheet" href=<?php echo base_url()."assets/css/chosen.css"; ?> type="text/css"/>
		<script type="text/javascript" src=<?php echo base_url()."assets/js/chosen.jquery.js"; ?>></script>
        
        <!-- DataTables -->
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>

        <!-- Le CSS perso quand la flemme de chercher dans les 14 trilliards de librairies :D -->
        <link href=<?php echo base_url()."assets/css/css_perso.css"; ?> rel="stylesheet">

        
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
                    <a class="navbar-brand" href="<?php echo base_url();?>index.php/home"> <span class="glyphicon glyphicon-home"></span> Accueil</a>
                </div>
                <div>
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href='#' class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ajouter...<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url();?>index.php/administration/ajout_utilisateur"><span class="glyphicon glyphicon-user"></span> Ajouter un utilisateur</a></li>
                                <li><a href="<?php echo base_url();?>index.php/ajoutModule"><span class="glyphicon glyphicon-book"></span> Ajouter un module</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href='#' class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Gerer...<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url();?>index.php/administration/listeUtilisateurs"><span class="glyphicon glyphicon-list-alt"></span> Gerer les utilisateurs</a></li>
                                <li><a href="<?php echo base_url();?>index.php/gestionModule"><span class="glyphicon glyphicon-book"></span> Gérer les modules</a></li> 
                            </ul>
                        </li>
                    </ul>      
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo base_url();?>index.php/home/modifier_utilisateur/<?php echo $this->session->userdata('info_user')['login'];?>"><span class="glyphicon glyphicon-wrench"></span> Mon compte</a></li>
                        <li><a href="<?php echo base_url();?>index.php/home/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container"  style="margin-top:50px;">