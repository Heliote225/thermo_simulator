<?php
//start a session to access the SESSION variables
session_start();
if($_SESSION["last_status"]==='T'){
    //if the last anchor was on temperature so change the content of info.json
    copy('temperature.json', 'info.json');
}
else if($_SESSION["last_status"]==='H'){
    //if the last anchor was on hemoglobine so change the content of info.json
    copy('hemo.json', 'info.json');
}
else if($_SESSION["last_status"]==='G'){
    //if the last anchor was on glycémie so change the content of info.json
    copy('glycemie.json', 'info.json');
}
//hidden information below the text field by putting data_status to default
$_SESSION["data_status"]='default';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Santé!</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body style='background-color:RGB(16,23,40);'>

        <?php include 'navHelp.php';//including the navbar ?>
        
        <!--Edition of the body by putting just information-->
        <div class="container" style='text-align:center;'>
            <h1>Comment utiliser notre application WEB?</h1>
            <p class='texte'>
            Notre application mobile est conçue pour rechercher, forger et développer 
            des liens entre vous, les personnes que vous connaissez et les personnes que 
            vous souhaitez connaître. Avec plusieurs startups à son actif, l'équipe derrière Kinnectric 
            travaille dur pour vous apporter la seule application sociale dont vous aurez besoin.
            </p>
        </div>
        
        <?php include "footer.php"; //including the foooter?>

        <!--Linking of this file to a js file-->
        <script src="script.js" type="module"></script>
        
    </body>
</html>