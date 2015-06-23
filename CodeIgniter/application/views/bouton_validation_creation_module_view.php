<?php 

echo "<p style='color:red;'><br/>Attention : seuls les cours validés seront pris en compte !</p>";
echo form_open('ajoutModule/creationModule');
echo form_submit('creationModule', 'Créer cours', 'class="btn btn-lg btn-primary"');
echo form_close();

?>
