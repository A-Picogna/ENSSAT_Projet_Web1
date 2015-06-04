<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
</head>
<body>

<div id="container">
	
	<h2> <?php echo $page_header ?></h2>
	<div id="body">

		<?php
			foreach ($liste as $object) 
			{

				echo "  
                        <table class='table table-striped'>
                            <tr>                                
                                <td>
                                    <a href='afficheModule/module/{$object['ident']}'>
                                        <div>{$object['libelle']}</div>
                                    </a>
                                </td>
                                <td>
                                    <div><button class='btn btn-primary btn-xs'>Se positionner sur ce cours</button></div>
                                </td>
                            </tr>
                        </table>
                    ";
	 		}
	 	
		?>

	</div>
</div>
</body>
</html>
