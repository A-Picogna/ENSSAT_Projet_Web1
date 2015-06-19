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

        
        <meta name="description" content="chart created using amCharts live editor" />

        <!-- amCharts javascript sources -->
        <script type="text/javascript" src="http://cdn.amcharts.com/lib/3/amcharts.js"></script>
        <script type="text/javascript" src="http://www.amcharts.com/lib/3/pie.js"></script>

        <!-- amCharts javascript code -->
        <script type="text/javascript">
            AmCharts.makeChart("chartdiv3",
                {
                    "type": "pie",
                    "angle": 12,
                    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                    "depth3D": 15,
                    "colors": [
                        "#FF7F50",
                        "#008080",
                        "#BDB76B"
                    ],
                    "titleField": "category",
                    "valueField": "column-1",
                    "allLabels": [],
                    "balloon": {},
                    "legend": {
                        "align": "center",
                        "markerType": "circle"
                    },
                    "titles": [],
                    "dataProvider": [
                                {
                                    "category": "<?php echo "Somme des heures de cours disponibles dans le module " .$Modules[0]['libelle'].""; ?>",
                                    "column-1": <?php 
                                    if ($coursdispo[0]['sum(hed)']==null){echo 0;}
                                    else{ echo $coursdispo[0]['sum(hed)'];}

                                    ?>
                                },
                                {
                                    "category": "Somme des heures de cours occupées par des enseignants pour ce module",
                                    "column-1": <?php 
                                    if ($courspris[0]['sum(hed)']==null){echo 0;}
                                    else{ echo $courspris[0]['sum(hed)'];}

                                    ?>
                                }
                            ]
                }
            );
        </script>
        <div id="chartdiv3" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>

        </div>
	</div>

</div>
</body>
</html>
