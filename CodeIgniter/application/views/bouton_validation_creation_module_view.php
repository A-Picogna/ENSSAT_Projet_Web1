<?php 

echo "<p><br/>Attention : seuls les cours validés seront pris en compte !</p>";
echo form_open('ajoutModule/creationModule');
echo form_submit('creationModule', 'Créer cours');
echo form_close();

?>
