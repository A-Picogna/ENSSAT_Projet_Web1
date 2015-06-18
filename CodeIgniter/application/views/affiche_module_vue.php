<h1 class="titre">Détails du module</h1>
<div class="panel panel-warning">
    <div class="panel panel-heading">
        <h2 class="panel-title">
            <?php 
                echo "Module : ".$Modules[0]['libelle']."</br>"."Responsable : ";
                if (!empty($ResponsablesETfiliere[0]['nom']) && !empty($ResponsablesETfiliere[0]['prenom'])){
                    echo $ResponsablesETfiliere[0]['prenom']." ";
                    echo " ".$ResponsablesETfiliere[0]['nom']."</br>"." Public : ";
                }
                else{
                    echo "<div class=text-color-red>Aucun Responsable</div>"."</br>"." Public : ";
                }
                if (!empty($ResponsablesETfiliere[0]['public'])){
                    echo " ".$ResponsablesETfiliere[0]['public']."</br>";
                }
                else{
                    echo "<div class=text-color-red>Non renseigné</div>";
                }
            ?>          
        </h2>
    </div>
    <div class="panel-body">
        <div class="row row-centered">      
              
            <?php
                if ($Cours != Null){
                    foreach ($Cours as $object){
                        echo'
                            <div class="col-centered">
                            <div class="thumbnail">
                            <div class="caption">
                            <div class="panel panel-info">
                            <div class="panel panel-heading">
                                <h2 class="panel-title">'.$object["partie"].'</h2>
                            </div>
                            <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-info">
                                    <a href="#"><span class="badge">'.$object["hed"].' heq TD</span></a>
                                </li>
                                <li class="list-group-item">';
                                if (!empty($object['prenom']) && !empty($object['nom'])){
                                    echo $object['prenom'].' '.$object['nom'];
                                }
                                else{
                                    echo '<div class="text-color-red">Disponible</div>';
                                }
                        echo'   </li>
                            </ul>                                
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            ';
                    }
                }
                else
                {
                    echo "Il n'existe pas de partionnement de cours";
                }
            ?>
        </div>
        <div class="panel-footer">
            <a href="<?php echo base_url().'index.php/choisirCours/positionnement/'.$Modules[0]['ident'];?>">
                <button class="btn btn-primary pull-right">
                    Choisir des cours libres
                </button>
            </a>
            <?php
                /*GRAPHES DE JIHANE*/
                /*CODER ICI*/
                /*CODER ICI*/
                /*CODER ICI*/
                /*CODER ICI*/
                /*CODER ICI*/
                /*CODER ICI*/
                /*CODER ICI*/
                /*CODER ICI*/
                /*CODER ICI*/
                /*CODER ICI*/
                /*CODER ICI*/
                /*CODER ICI*/
            ?>
        </div>
	</div>
</div>
</body>
</html>
