<?php
//start a session
session_start();
$_SESSION["data_status"]='default';
$_SESSION["data_information"]='ok';
$_SESSION["last_status"]='T';
if(isset($_POST['username']) && isset($_POST['password']))
{
 // connexion à la base de données
 $db_username = 'root';
 $db_password = '';
 $db_name = 'measure_db';
 $db_host = 'localhost';
 $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
 or die('could not connect to database');
 
 // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
 // pour éliminer toute attaque de type injection SQL et XSS
 $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
 $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
 
 if($username !== "" && $password !== "")
 {
 $requete = "SELECT count(*) FROM utilisateurs where 
 nom_utilisateur = '".$username."' and mot_de_passe = '".$password."' ";
 $exec_requete = mysqli_query($db,$requete);
 $reponse = mysqli_fetch_array($exec_requete);
 $count = $reponse['count(*)'];
 
 if($count!=0) // nom d'utilisateur et mot de passe correctes
 {
 $_SESSION['username'] = $username;
 $requete = "SELECT reg_date FROM measures LIMIT 1";
 $exec_requete = mysqli_query($db,$requete);
 $reponse = mysqli_fetch_array($exec_requete);
 $result=$reponse["0"];
 if(substr($result,0,10)!=date('Y-m-d')){
    //if it is another day
    $requete = "TRUNCATE TABLE measures";
    $exec_requete = mysqli_query($db,$requete);
 }
 header('Location: accueil.php');
 }
 else
 {
 header('Location: index.php?erreur=1'); // utilisateur ou mot de passe incorrect
 }
 }
 else
 {
 header('Location: index.php?erreur=2'); // utilisateur ou mot de passe vide
 }
}
else
{
 header('Location: index.php');
}
mysqli_close($db); // fermer la connexion
?>