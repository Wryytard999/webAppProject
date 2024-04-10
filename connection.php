<?php

$dbhost = "Localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "projet web";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$connection){
    die("Erreur de connection a la base de donneé");
}
