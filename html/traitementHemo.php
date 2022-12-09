<?php
session_start();
if (isset($_POST['hemo']) && is_numeric($_POST['hemo']))
{
    //if a numerical value is transmitted
    $hemo=round((float)$_POST['hemo'],1);
    if($hemo<0 || $hemo>20)
    {
        //if the entered value is less than 0 or bigger than 20
            $_SESSION["data_status"]='not_transmitted';
            $_SESSION["data_information"]="Veuillez entrer une valeur d'hémoglobine comprise entre 0 et 20!";
            $_SESSION['last_status']='H';
            include 'accueil.php';
    }
    else{
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "measure_db";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if (mysqli_connect_error()){
            $_SESSION["data_status"]='not_transmitted';
            $_SESSION["data_information"]='Erreur de connexion!';
            $_SESSION['last_status']='H';
            include 'accueil.php';
        }
        else{
            if(isset($_POST['hct']) && is_numeric($_POST['hct']) && $_POST['hct']>=0 && $_POST['hct']<=100){
                //checking the transmitted value
                $hct=(int)$_POST['hct'];
            }
            else{
                //taking the default value if nothing is transmitted
                $hct=35;
            }
            // sql to create new record
            $sql = "INSERT INTO measures (val_measure, alt_val_measure, type_measure)
            VALUES (".$hemo.",".$hct.", 'H')";
            if ($conn->query($sql) === TRUE) {
                //if the query is excecuted correctly
                $_SESSION["data_status"]='transmitted';
                $_SESSION["data_information"]='Transmission réussie!';
                $_SESSION['last_status']='H';
                //execute query
                $sql = "SELECT reg_date ,val_measure FROM measures WHERE type_measure='H' ORDER BY reg_date ASC";
                $result = $conn->query($sql);

                //loop through the returned data
                $data = array();
                foreach ($result as $row) {
                $data[] = $row;
                };
                //free memory associated with result
                $result->close();
                //now print the data
                $json=json_encode($data);
                file_put_contents("hemo.json", $json);
                file_put_contents("info.json", $json);
                file_put_contents('courant.txt', $hemo." H");
                include 'accueil.php';
            } else {
                $_SESSION["data_status"]='not_transmitted';
                $_SESSION["data_information"]='Transmission échouée!';
                $_SESSION['last_status']='H';
                include 'accueil.php';
            }
        }
        //close the connection
        $conn->close();
    }

}
else{
    //if the entered value is not a numerical value 
    $_SESSION["data_status"]='not_transmitted';
    $_SESSION["data_information"]="Veuillez entrer une valeur d'hémoglobine comprise entre 0 et 20!";
    $_SESSION['last_status']='H';
    include 'accueil.php';
};

?>