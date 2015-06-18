<script>
    $(function(){$(".tooltip-link").tooltip();});
    $(document).ready( function () {$('#table_gestion_module').DataTable();} );
</script>

<div class="row">
    <div class="">
        <h1 class="titre">Liste des modules</h1>
        <table id="table_gestion_module" class="table text-center table-bordered" >
            <thead>
                <tr class="titre_tableau">
                    <th>Libellé</th>
                    <th>Public</th>
                    <th>Semestre</th>
                    <th>Responsable</th>
                    <th>Voir</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="ligne_couleur_alterne">
<?php
    foreach($liste as $l){
        echo '<tr>';
        echo '  <td>
                    <a href="'.base_url().'index.php/afficheModule/module/'.$l['ident'].'" 	  
                    class="link tooltip-link" 
                    data-toggle="tooltip"
                    data-original-title="Voir le module">
                        '.$l['libelle'].'
                    </a>
                </td>';
        echo '<td>'.$l['public'].'</td>';
        echo '<td>'.$l['semestre'].'</td>';
        echo '<td>'.$l['responsable'].'</td>';
        echo '  <td>
                <a href="'.base_url().'index.php/afficheModule/module/'.$l['ident'].'" 	  
                    class="link tooltip-link" 
                    data-toggle="tooltip"
                    data-original-title="Voir le module">
                <button class="btn btn-info btn-xs">
                <span class="glyphicon glyphicon-eye-open" ></span>
                </button>
                </a>
                </td>';
        if ($l['complet']){
            echo '  <td>
                    <a href="#"  	  
                        class="link tooltip-link" 
                        data-toggle="tooltip"
                        data-original-title="Plus de place">
                    <button class="btn btn-danger btn-xs">
                    <span class="glyphicon glyphicon-pushpin" ></span>
                    </button>
                    </a>
                    </td>';            
        }
        else{
            echo '  <td>
                    <a href="'.base_url().'index.php/choisirCours/positionnement/'.$l['ident'].'"  	  
                        class="link tooltip-link" 
                        data-toggle="tooltip"
                        data-original-title="Se positionner sur des cours">
                    <button class="btn btn-success btn-xs">
                    <span class="glyphicon glyphicon-pushpin" ></span>
                    </button>
                    </a>
                    </td>';    
        }
        echo '</tr>';
    }

?>                    
            </tbody>
        </table>
    </div>
</div>