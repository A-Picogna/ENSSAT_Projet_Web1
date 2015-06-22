<div class="alert alert-info">
    <h1 class="text-center">Administration</h1>
</div>

<!--Mon autre beau graphe -->

        <script type="text/javascript" src=<?php echo base_url()."assets/js/amcharts.js"; ?>></script>
        <script type="text/javascript" src="http://www.amcharts.com/lib/3/serial.js"></script>

        <!-- amCharts javascript code -->
        <script type="text/javascript">
            AmCharts.makeChart("chartdiv",
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
                            "id": "AmGraph-1",
                            "title": "graph 1",
                            "type": "column",
                            "valueField": "column-2"
                        }
                    ],
                    "guides": [],
                    "valueAxes": [
                        {
                            "id": "ValueAxis-1",
                            "title": "Nombre de statuts"
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
                            "text": "Nombre d'enseignants par statut"
                        }
                    ],
                    "dataProvider": [
                        
                            <?php foreach ($statutETnb as $key ) { ?>
                            {
                                "category": "<?php echo $key['statut']; ?>",
                                "column-2" : <?php echo $key['count(statut)']; ?>

                            },
                            <?php } ?>
                    ]
                }
            );
    </script>

    <div id="chartdiv"></div>