
<?php
//start a session if there is not one
if(!isset($_SESSION['data_status'])){
    session_start();
    $_SESSION["data_status"]='default';
    $_SESSION["data_information"]='ok';
    //$_SESSION["last_status"]='T';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Santé!</title>
        <link rel="stylesheet" href=style.css>
        <!--Linking of this file to a js file for graphic representation-->
        <script src='package/dist/chart.umd.js'></script>
    </head>
    <body>

        <?php include 'navAccueil.php'; //including the navbar?>

        <div class="container">
            <div class="informations">
                <!--The content of the information div depends on the last status-->
                <div class="menu">
                    <?php
                    //the anchor depends on the last status
                    if($_SESSION["last_status"]==='T'){
                        echo '<ul>
                    <li><a href="#" style="background-color:blue;">Température</a></li>
                    <li><a href="#" style="background-color:transparent;">Hémoglobine</a></li>
                    <li><a href="#" style="background-color:transparent;">Glycémie</a></li>;
                    </ul>';
                    }
                    else if($_SESSION["last_status"]==='G'){
                        echo '<ul>
                    <li><a href="#" style="background-color:transparent;">Température</a></li>
                    <li><a href="#" style="background-color:transparent;">Hémoglobine</a></li>
                    <li><a href="#" style="background-color:blue;">Glycémie</a></li>;
                    </ul>';
                    }
                    else{
                        echo '<ul>
                    <li><a href="#" style="background-color:transparent;">Température</a></li>
                    <li><a href="#" style="background-color:blue;">Hémoglobine</a></li>
                    <li><a href="#" style="background-color:transparent;">Glycémie</a></li>;
                    </ul>';
                    }
                    ?>
                </div>

                <?php
                if($_SESSION["last_status"]==='T'){
                    echo '<div class="info">';
                    include('temperature.php');
                }
                else if($_SESSION["last_status"]==='G'){
                    echo '<div class="info">';
                    include('glycemie.php');
                }
                else{
                    echo '<div class="info" style="margin-top:53px;">';
                    include('hemo.php');
                }
                echo '</div>';   
                ?>
            </div>
            <div class="repr">
                <!--The graphic representation depends on the last status-->
                <canvas id="barCanvas" aria-label='chart' role='img'></canvas>
                <form action=<?php 
                //the action to do when we press Mesure en cours depends on we data we want to send
                if($_SESSION["last_status"]==='T'){
                    echo "mesurerTemp.php";
                }
                else if($_SESSION["last_status"]==='H'){
                    echo "mesurerHemo.php";
                }
                else if($_SESSION["last_status"]==='G'){
                    echo "mesurerGly.php";
                }
                
                ?> method="post">
                    <div class='mesurer'><input type="submit" value="Mesure en cours" ></div>
                </form>
            </div>
        </div>
        <?php include "footer.php"; //including the footer?>
    </body>
    <!--Linking of this file to a js file-->
    <script src=script.js type='text/javascript' async></script>
</html>
<?php
//put data status to default just to hide the information below the text field 
$_SESSION["data_status"]='default';
$_SESSION["data_information"]='ok';
?>