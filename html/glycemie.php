<?php
//content of glycemie information
echo "<form action='traitementGly.php' method='post'>
<div class='label'><label for='gly'>Glycémie (g/L) :</label></div>
<div class='entree'><input type='text' id='gly' name='gly' placeholder='Entrez une valeur (ex 0.80)' required autofocus></div>
<p class=".$_SESSION["data_status"].">".$_SESSION["data_information"]."</p>
<div class='envoyer'><input type='submit' value='Envoyer'></div>
</form>";
?>