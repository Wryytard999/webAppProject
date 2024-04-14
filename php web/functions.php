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

function cheker_jury($connection,$date_start,$id_respo,$type)
{
    $query = "SELECT * FROM jury
               WHERE ID_RESPONSABLE = '$id_respo'
               AND  DATE_DEBUT = '$date_start' 
               AND  TYPE_DE_JURY = '$type'";
    $result = mysqli_query($connection, $query);
    return $result && mysqli_num_rows($result) > 0 ;
}
function cheker_encadrement($connection,$id_respo,$etudiant)
{
    $query = "SELECT * FROM encadrement 
    WHERE ID_RESPONSABLE = '$id_respo'
    AND ETUDIANT = '$etudiant'";
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
    $query = "SELECT NOM,PRENOM,LBL_FILLIERE,LBL_NIVEAUX,TYPE_DE_JURY 
                FROM jury AS j ,professeur AS p ,responsable AS r,filliere AS f, niveau AS n
                WHERE j.ID_RESPONSABLE=r.ID_RESPONSABLE
                AND r.ID_PROFESSEUR =p.ID_PROFESSEUR
                AND j.ID_FILLIERE=   f.ID_FILLIERE
                AND f.ID_FILLIERE=   n.ID_FILLIERE
                AND j.ID_NIVEAU  =   n.ID_NIVEAU
                ORDER BY `ID_JURY` DESC";
    $result = mysqli_query($connection, $query);
    return $result;
}


function prof_list($connection)
{
    $query = "SELECT * FROM professeur Order by ID_PROFESSEUR desc";
    $result = mysqli_query($connection, $query);
    return $result;
}

function filliere_liste($connection)
{
    $query = "SELECT * FROM filliere Order by ID_FILLIERE desc";
    $result = mysqli_query($connection, $query);
    return $result;
}

function niveau_liste($connection,$filliere)
{
    if(!empty($filliere))
        {
        $query = "SELECT * FROM niveau,filliere
                    WHERE niveau.ID_FILLIER = filliere.ID_FILLIERE
                    AND  LBL_FILLIERE ='$filliere' 
                    Order by LBL_NIVEAUX desc";
        $result = mysqli_query($connection, $query);
        return $result; 
    }
    else
    {
        $query = "SELECT * FROM niveau 
        Order by LBL_NIVEAUX desc";
        $result = mysqli_query($connection, $query);
        return $result; 
    }
}
function jury_liste($connection)
{
    $query = "SELECT * FROM jury Order by ID_JURY desc";
    $result = mysqli_query($connection, $query);
    return $result;
}




function id_respo_to_NOM($connection, $id)
{
    $apelle = "SELECT NOM , PRENOM 
                FROM professeur AS pr , responsable AS respo
                WHERE pr.ID_PROFESSEUR = respo.ID_PROFESSEUR 
                AND respo.ID_RESPONSABLE= '$id'";
    $result = mysqli_query($connection, $apelle);
    return $result;
}

function id_fillier($connection,$Chef_FIl,$nom)
{
    $query = "SELECT ID_FILLIERE FROM  Filliere WHERE ID_RESPONSABLE = '$Chef_FIl' AND LBL_FILLIERE = '$nom'";
    $result = mysqli_query($connection, $query);
    $data = mysqli_fetch_array($result);
    return $data['ID_FILLIERE'];
}

function prof_to_id_respo($connection,$Chef_FIl)
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