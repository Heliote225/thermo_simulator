<?php
//content of hemoglobine information
echo "<form action='traitementHemo.php' method='post'>
        <div class='label'><label for='hemo'>Hémoglobine (g/dL) :</label></div>
        <div class='entree'><input type='text' id='hemo' name='hemo' placeholder='Entrez une valeur (ex 15.2)' required autofocus></div>
        <div class='label' id='label_hct'><label for='hct'>HCT (%) :</label></div>
        <div class='entree'><input type='text' id='hct' name='hct' placeholder='Entrez une valeur (ex 35)'></div>
        <p class=".$_SESSION["data_status"].">".$_SESSION["data_information"]."</p>
        <div class='envoyer' style='margin-top:53px;'><input type='submit' value='Envoyer'></div>
    </form>";
?>