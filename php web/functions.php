<?php

function cheker_prof($connection,$email)
{
    if(!empty($email))
    {
        $requet = "SELECT * FROM professeur WHERE Email_uni = '$email'";
        $result = mysqli_query($connection,$requet);
        return $result && mysqli_num_rows($result) >0;
    }
}
function appel_prof($connection)
{
    $query = "SELECT * FROM professeur ORDER BY `id` DESC";
    return mysqli_query($connection, $query);
}
function appel_filier($connection)
{
    $query = "SELECT * FROM filiere ORDER BY `id-fillier` DESC";
    return mysqli_query($connection, $query);
}

function id_nom_prof($connection, $id)
{
    $apelle = "SELECT Nom , prenom 
                FROM professeur
                WHERE id = '$id'";
    return mysqli_query($connection, $apelle);
}