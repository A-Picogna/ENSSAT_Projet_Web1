<!-- Chargement du tableau intéractif -->
<script>
    $(document).ready( function () {$('#table_id').DataTable();} );
</script>

<div class="row">
    <div class="">
        <h1 class="titre">Vue des utilisateurs</h1>



<!-- Mon beauuuuu Graphe -->

        <!-- amCharts javascript sources -->
        <script type="text/javascript" src=<?php echo base_url()."assets/js/amcharts.js"; ?>></script>
        <script type="text/javascript" src=<?php echo base_url()."assets/js/serial.js"; ?>></script>

        <!-- amCharts javascript code -->
        <script type="text/javascript">
        AmCharts.makeChart("chartdiv2",
                {
                    "type": "serial",
                    "categoryField": "category",
                    "angle": 30,
                    "depth3D": 30,
                    "colors": [
                        "#FF7F50"
                    ],
                    "startDuration": 1,
                    "categoryAxis": {
                        "gridPosition": "start"
                    },
                    "trendLines": [],
                    "graphs": [
                        {
                            "balloonText": "[[title]] of [[category]]:[[value]]",
                            "fillAlphas": 1,
                            "id": "AmGraph-2",
                            "title": "graph 2",
                            "type": "column",
                            "valueField": "column-2"
                        }
                    ],
                    "guides": [],
                    "valueAxes": [
                        {
                            "id": "ValueAxis-1",
                            "title": "Nombre d'heures"
                        }
                    ],
                    "allLabels": [],
                    "balloon": {},
                    /*"legend": {
                        "useGraphSettings": true
                    },*/
                    "titles": [
                        {
                            "id": "Title-1",
                            "size": 15,
                            "text": "Nombre d'heures de cours prises par chaque enseignant"
                        }
                    ],
                    "dataProvider": [
                        
                            <?php foreach ($enseignant as $key ) { ?>
                            {
                                "category": "<?php echo $key['prenom']." ".$key['nom']; ?>",
                                "column-2" : <?php echo $key['sum(hed)']; ?>

                            },
                            <?php } ?>
                        
                    ]
                }
            );
        </script>
        
        <div id="chartdiv2"></div>





        <table id="table_id" class="table text-center table-bordered" >
            <thead>
                <tr class="titre_tableau">
                    <th>Login</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Statutaire</th>
                    <th>Service</th>
                </tr>
            </thead>
            <tbody class="ligne_couleur_alterne">

<?php
    foreach($liste_utilisateurs as $l){
        echo '<tr>';
        echo '<td>'.$l['login'].'</td>';
        echo '<td>'.$l['prenom'].'</td>';
        echo '<td>'.$l['nom'].'</td>';
        echo '<td>'.$l['statutaire'].'</td>';
        echo '<td>'.$l['service'].'</td>';
        //if ($l['administrateur']){echo '<td>Oui</td>';}else{echo '<td>Non</td>';}        
        echo '</tr>';
    }

?>                    
            </tbody>
        </table>
    </div>
</div>
