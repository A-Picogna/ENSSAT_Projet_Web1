<!DOCTYPE html>
<html>
	<head>
		

<?php $resteheures = $info_user['statutaire']-$decharge-$heureslogin[0]['sum(hed)'] ?>

		</script>

		<meta name="description" content="chart created using amCharts live editor" />

		<!-- amCharts javascript sources -->
		<script type="text/javascript" src="http://cdn.amcharts.com/lib/3/amcharts.js"></script>
		<script type="text/javascript" src="http://www.amcharts.com/lib/3/pie.js"></script>

		<!-- amCharts javascript code -->
		<script type="text/javascript">
			AmCharts.makeChart("chartdiv",
				{
					"type": "pie",
					"angle": 12,
					"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
					"depth3D": 15,
					"innerRadius": "40%",
					"colors": [
						"#008080",
						"#FF7F50"
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
							"category": "Somme des heures de cours pris pas l'enseignant",
							"column-1": <?php 
							if ($heureslogin[0]['sum(hed)'] != null ){
								echo($heureslogin[0]['sum(hed)']);}
							else{
								echo 0;
							}

							?>
						},
						{
							"category": "Somme des heures restantes à l'enseignant",
							"column-1": 
							<?php 

							
								if ($resteheures == null || $resteheures<0)
								{
									echo 0;
								}
								else
								{
										echo $resteheures;																	
								}

							?>
						}
					]
				}
			);
		</script>

	</head>
	<body>
		<div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
		<?php print_r($resteheures); ?>
	</body>
</html>

