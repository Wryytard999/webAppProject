<?php
function prof_to_respo($connection,$id_prof)
{
    $query = "INSERT INTO responsable (ID_PROFESSEUR)
                VALUES ('$id_prof')";
    $result = mysqli_query($connection, $query);
    return $result;
}
function id_respo_to_NOM($connection, $id_respo)
{
    $apelle = "SELECT NOM , PRENOM 
                FROM professeur AS pr , responsable AS respo
                WHERE pr.ID_PROFESSEUR = respo.ID_PROFESSEUR 
                AND respo.ID_RESPONSABLE= '$id_respo'";
    $result = mysqli_query($connection, $apelle);
    return $result;
}

function id_fillier($connection,$Chef_FIl,$nom)
{
    $query = "SELECT ID_FILLIERE FROM  niveau WHERE ID_RESPONSABLE = '$Chef_FIl' AND LBL_FILLIERE = '$nom'";
    $result = mysqli_query($connection, $query);
    $data = mysqli_fetch_array($result);
    return $data['ID_FILLIERE'];
}

function id_prof_to_id_respo($connection,$Chef_FIl)
{
    $query = "SELECT ID_RESPONSABLE FROM  responsable WHERE ID_PROFESSEUR = '$Chef_FIl'";
    $result = mysqli_query($connection, $query);
    $data = mysqli_fetch_array($result);
    return $data['ID_RESPONSABLE'];
}


function id_jury($connection,$id_respo,$date_start,$type,$fil)
{
    $query = "SELECT ID_JURY FROM jury
                WHERE ID_RESPONSABLE = '$id_respo'
                AND     DATE_DEBUT = '$date_start'
                AND     TYPE_DE_JURY = '$type'
                AND     ID_FILLIERE = '$fil'";
    $result = mysqli_query($connection, $query);
    $data = mysqli_fetch_array($result);
    return $data['ID_JURY'];

}
function encadrement_prof($connection,$id_respo,$etudiant)
{

}