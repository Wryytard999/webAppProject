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

function cheker_Fill($connection,$Chef_FIl,$nom)
{
    $query = "SELECT * FROM filliere 
                WHERE LBL_FILLIERE = '$nom'
                AND ID_RESPONSABLE = '$Chef_FIl'";
    $result = mysqli_query($connection, $query);
    return $result && mysqli_num_rows($result) > 0;
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


function id_nom_respo_prof($connection, $id)
{
    $apelle = "SELECT NOM , PRENOM 
                FROM professeur AS pr , responsable AS respo
                WHERE pr.ID_PROFESSEUR = respo.ID_PROFESSEUR 
                AND respo.ID_RESPONSABLE= '$id'";
    $result = mysqli_query($connection, $apelle);
    return $result;
}


function prof_list($connection)
{
    $query = "SELECT NOM, PRENOM , ID_PROFESSEUR FROM professeur Order by ID_PROFESSEUR desc";
    $result = mysqli_query($connection, $query);
    return $result;
}
function id_fillier($connection,$Chef_FIl,$nom)
{
    $query = "SELECT ID_FILLIERE FROM  Filliere WHERE ID_RESPONSABLE = '$Chef_FIl' AND LBL_FILLIERE = '$nom'";
    $result = mysqli_query($connection, $query);
    $data = mysqli_fetch_array($result);
    return $data['ID_FILLIERE'];
}

function id_respo($connection,$Chef_FIl)
{
    $query = "SELECT ID_RESPONSABLE FROM  responsable WHERE ID_PROFESSEUR = '$Chef_FIl'";
    $result = mysqli_query($connection, $query);
    $data = mysqli_fetch_array($result);
    return $data['ID_RESPONSABLE'];
}

