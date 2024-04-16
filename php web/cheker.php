<?php

function cheker_prof($connection,$code)
{
    if(!empty($code))
    {
        $requet = "SELECT * FROM professeur WHERE CODE_APOGE = '$code'";
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

function cheker_jury($connection,$date_start,$id_respo,$type)
{
    $query = "SELECT * FROM jury
               WHERE ID_RESPONSABLE = '$id_respo'
               AND  DATE_DEBUT = '$date_start' 
               AND  TYPE_DE_JURY = '$type'";
    $result = mysqli_query($connection, $query);
    return $result && mysqli_num_rows($result) > 0 ;
}

function cheker_encadrement($connection,$id_respo,$etudiant,$niveau)
{
    $query = "SELECT * FROM encadrement 
            WHERE ID_PROFESSEUR = '$id_respo'
            AND ETUDIANT = '$etudiant'
            AND ID_NIVEAU = '$niveau'";
    $result = mysqli_query($connection, $query);
return $result && mysqli_num_rows($result) > 0;
}