<?php

$dbhost = "Localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "projet web";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$connection){
    echo "erreur prof.php";
    //die("Erreur de connection a la base de donneé");
}

$apelle = "SELECT * FROM professeur ORDER BY id desc";
$data = mysqli_query($connection, $apelle);
