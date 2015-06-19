<div class="alert alert-info">
    <h1>Bonjour <?php echo $prenom.' '.$nom.', Vous êtes '.$statut; if ($administrateur){echo " et administrateur du site ";}?>!</h1>
</div>



<!DOCTYPE html>
<html>
	<head>
		
		<meta name="description" content="chart created using amCharts live editor" />

		<!-- amCharts javascript sources -->
		
		<!-- amCharts javascript sources -->
		<script type="text/javascript" src="http://cdn.amcharts.com/lib/3/amcharts.js"></script>
		<script type="text/javascript" src="http://www.amcharts.com/lib/3/gauge.js"></script>

		<!-- amCharts javascript code -->
		<script type="text/javascript">
			AmCharts.makeChart("chartdiv",
				{
					"type": "gauge",
					"marginBottom": 20,
					"marginTop": 40,
					"startDuration": 0,
					"fontSize": 13,
					"arrows": [
						{
							"id": "GaugeArrow-1",
							"value": <?php echo($heureslogin[0]['sum(hed)']);?>
						}
					],
					"axes": [
						{
							"bottomText": "0 h",
							"bottomTextYOffset": -20,
							"endValue": <?php echo($info_user['statutaire']-$decharge); ?>,
							"id": "GaugeAxis-1",
							"valueInterval": 10,
							"bands": [
								{
									"color": "#00CC00",
									"endValue": 90,
									"id": "GaugeBand-1",
									"startValue": 0
								},
								{
									"color": "#ffac29",
									"endValue": 130,
									"id": "GaugeBand-2",
									"startValue": 90
								},
								{
									"color": "#ea3838",
									"endValue": 192,
									"id": "GaugeBand-3",
									"innerRadius": "95%",
									"startValue": 130
								}
							]
						}
					],
					"allLabels": [],
					"balloon": {},
					"titles": [
						{
							"id": "Title-1",
							"size": 15,
							"text": "Nombre d'heures que vous avez consommé"
						}
					]
				}
			);
		</script>

	</head>
	<body>
		<div id="chartdiv" style="width: 400px; height: 400px; background-color: #FFFFFF;" ></div>
	</body>
</html>