<?php

function cheker_prof($connection,$email)
{
    if(!empty($email))
    {
        $requet = "SELECT * FROM professeur WHERE EMAIL_EDU = '$email'";
        $result = mysqli_query($connection,$requet);
        return $result && mysqli_num_rows($result) > 0;
    }
}
function appel_prof($connection)
{
    $query = "SELECT * FROM professeur ORDER BY `ID_PROFESSEUR` DESC";
    $result = mysqli_query($connection,$query);
    return $result;
}
function appel_filier($connection)
{
    $query = "SELECT * FROM filliere ORDER BY `ID_FILLIERE` DESC";
    $result = mysqli_query($connection, $query);
    return $result;
}
function apepel_jury($connection)
{
    $query = "SELECT * FROM jury ORDER BY `ID_JURY` DESC";
    $result = mysqli_query($connection, $query);
    return $result;
}
function id_nom_prof($connection, $id)
{
    $apelle = "SELECT NOM , PRENOM 
                FROM professeur
                WHERE ID_PROFESSEUR = '$id'";
    $result = mysqli_query($connection, $apelle);
    return $result;
}
function prof_list($connection)
{
    $query = "SELECT NOM, PRENOM , ID_PROFESSEUR FROM professeur";
    $result = mysqli_query($connection, $query);
    return $result;
}
function cheker_Fill($connection,$Chef_FIl,$nom)
{
    $query = "SELECT * FROM filliere 
                WHERE LBL_FILLIERE = '$nom'
                AND ID_PROFESSEUR = '$Chef_FIl'";
    $result = mysqli_query($connection, $query);
    return $result && mysqli_num_rows($result) > 0;
}