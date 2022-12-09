<?php
//start a session send the info and come back
session_start();
$_SESSION['last_status']='H';
copy('hemo.json', 'info.json');
file_put_contents('courant.txt', "ok I");
include 'accueil.php';
?>