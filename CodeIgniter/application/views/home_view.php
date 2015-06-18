<div class="alert alert-info">
    <h1>Bonjour <?php echo $prenom.' '.$nom.', Vous êtes '.$statut; if ($administrateur){echo " et administrateur du site ";}?>!</h1>
</div>



<!DOCTYPE html>
<html>
	<head>
		<title>chart created with amCharts | amCharts</title>
		<meta name="description" content="chart created using amCharts live editor" />

		<!-- amCharts javascript sources -->
		<script type="text/javascript" src="http://cdn.amcharts.com/lib/3/amcharts.js"></script>
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
							"text": "Nombre d'heures par enseignant"
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


<title>chart created with amCharts | amCharts</title>
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
									"category": "Somme des heures de cours disponibles dans le module x ",
									"column-1": <?php echo $coursdispo[0]['sum(hed)']; ?>
								},
								{
									"category": "Somme des heures de cours occupées par des enseignants pour ce module",
									"column-1": <?php echo $courspris[0]['sum(hed)']; ?>
								}
							]
				}
			);
		</script>


	</head>
	<body>
		<div id="chartdiv" style="width: 300px; height: 300px; background-color: #FFFFFF;" ></div>
		<div id="chartdiv2" style="width: 1000px; height: 400px; background-color: #FFFFFF;" ></div>
		<div id="chartdiv3" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
	</body>
</html>