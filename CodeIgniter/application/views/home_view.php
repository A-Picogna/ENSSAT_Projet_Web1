<script>
$(document).ready( function (){
    $("#navbar_content_left").append('<li><a></a></li>');
});

</script>


<?php $resteheures = $info_user['statutaire']-$decharge-$heureslogin[0]['sum(hed)'] ?>

		</script>

		<meta name="description" content="chart created using amCharts live editor" />

		<!-- amCharts javascript sources -->
		
		<script type="text/javascript" src=<?php echo base_url()."assets/js/amcharts.js"; ?>></script>
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
							"category": "Somme des heures de cours prises par l'enseignant",
							"column-1": <?php 
							if ($heureslogin[0]['sum(hed)'] != null ){
								echo($heureslogin[0]['sum(hed)']);}
							else{
								echo 0;
							}

							?>
						},
						{
							"category": "Somme des heures restantes de l'enseignant",
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

<div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
	



<button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#myModal">Export CSV</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 class="modal-title titre">Choisir un export CSV</h1>
            </div>
            <div class="modal-body">
<?php
echo'
    <a href="'.base_url().'index.php/home/exportCSV"class="link tooltip-link" data-toggle="tooltip" data-original-title="CSV">
        <button class="btn btn-danger btn-lg">
            <span class="glyphicon glyphicon-arrow"></span>
            Liste Enseignants
        </button>
    </a>';
?>
            </div>
        </div>
    </div>
</div>
