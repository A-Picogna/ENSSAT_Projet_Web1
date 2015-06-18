<script>
    $(function(){$(".tooltip-link").tooltip();});
</script>
	
<div class="row">
    <div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3" style="margin-top:5%;">
        <div class="panel panel-primary">
            <div class="panel panel-heading">
                <h2 class="panel-title">Liste des modules</h2>
            </div>
            <div class="panel-body">

		<?php
            echo "<table class='table table-striped table-bordered'>";
			foreach ($liste as $object){
				echo "
                    <tr>
                        <td>
                            <a href='".base_url()."index.php/afficheModule/module/{$object['ident']}'>
                                <div>{$object['libelle']}</div>
                            </a>
                        </td>
                        <td>
                            <div align='right'>
                                <a href='".base_url()."index.php/choisirCours/positionnement/{$object['ident']}' class=\"link tooltip-link\" data-toggle=\"tooltip\" data-original-title=\"Se positionner sur le cours\">
                                    <button class='btn btn-success btn-xs'>
                                        <span class='glyphicon glyphicon-pushpin'></span> 
                                    </button>
                                </a>
                            </div>
                        </td>
                    </tr>
                    ";
            }
            echo "</table>";
	 	
		?>
            </div>
        </div>        
    </div>
</div>
