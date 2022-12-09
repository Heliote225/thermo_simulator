<?php
//content of temperature information
echo "<form action='traitementTemp.php' method='post'>
            <div class='label'><label for='temp'>Température (°C) :</label></div>
            <div class='entree'><input type='text' id='temp' name='temp' inputmode='numeric' placeholder='Entrez une valeur (ex 37.6)' required autofocus></div>
            <p class=".$_SESSION["data_status"].">".$_SESSION["data_information"]."</p>
            <div class='envoyer'><input type='submit' value='Envoyer'></div>
        </form>";
?>