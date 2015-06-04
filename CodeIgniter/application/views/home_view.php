
 <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home">Gestion des cours</a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li><a href="listeModules"><span class="glyphicon glyphicon-hand-up"></span> Liste Modules</a></li>
        <li><a href="ajoutModule"><span class="glyphicon glyphicon-book"></span> Ajouter un module</a></li>
        <li><a href="afficheEnseignant"><span class="glyphicon glyphicon-book"></span> Boulot Yasmine</a></li>
        <li><a href="afficheModule"><span class="glyphicon glyphicon-book"></span> Boulot Jihane</a></li>
        <?php		
		if ($administrateur) {
		echo '
        <li><a href="home/ajout_utilisateur"><span class="glyphicon glyphicon-user"></span> Ajouter un utilisateur</a></li>
        ';}?>
      </ul>      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-wrench"></span> Paramêtres de mon compte</a></li>
        <li><a href="home/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="alert alert-info" style="margin-top:50px;">
    <h1>Bonjour <?php echo $prenom.' '.$nom.', Vous etes '.$statut; if ($administrateur){echo " et Administrateur du site ";}?>!</h1>
</div>
