<?php
session_start();
if (isset($_POST['gly']) && is_numeric($_POST['gly']))
{
    //if a numerical value is transmitted
    $glycemie=round((float)$_POST['gly'],2);
    if($glycemie<0.1 || $glycemie>1.5)
    {
        //if the entered value is less than 0.1 or bigger than 1.5
            $_SESSION["data_status"]='not_transmitted';
            $_SESSION["data_information"]='Veuillez entrer une valeur de glycemie comprise entre 0.10 et 1.50!';
            $_SESSION['last_status']='G';
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
            $_SESSION['last_status']='G';
            include 'accueil.php';
        }
        else{
            // sql to create new record
            $sql = "INSERT INTO measures (val_measure, type_measure)
            VALUES (".$glycemie.", 'G')";
            if ($conn->query($sql) === TRUE) {
                //if the query is excecuted correctly
                $_SESSION["data_status"]='transmitted';
                $_SESSION["data_information"]='Transmission réussie!';
                $_SESSION['last_status']='G';
                //execute query
                $sql = "SELECT reg_date ,val_measure FROM measures WHERE type_measure='G' ORDER BY reg_date ASC";
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
                file_put_contents("glycemie.json", $json);
                file_put_contents("info.json", $json);
                file_put_contents('courant.txt', $glycemie." G");
                include 'accueil.php';
            } else {
                $_SESSION["data_status"]='not_transmitted';
                $_SESSION["data_information"]='Transmission échouée!';
                $_SESSION['last_status']='G';
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
    $_SESSION["data_information"]='Veuillez entrer une valeur de glycemie comprise entre 0.10 et 1.50!';
    $_SESSION['last_status']='G';
    include 'accueil.php';
};

?>