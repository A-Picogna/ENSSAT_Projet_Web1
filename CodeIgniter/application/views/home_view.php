
<div class="alert alert-info">
    <h1>Bonjour <?php echo $prenom.' '.$nom.', Vous etes '.$statut; if ($administrateur){echo " et Administrateur du site ";}?>!</h1>
</div>

<a href="home/logout" class="form-group col-lg-12">
    <button class="btn btn-primary">Logout</button>
</a>

<?php

if ($administrateur) {
	echo '
		<a href="home/ajout_utilisateur" class="form-group col-lg-12">
	    	<button class="btn btn-primary">Ajouter un utilisateur</button>
		</a>
	';
}
