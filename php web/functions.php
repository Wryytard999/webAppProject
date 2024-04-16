<?php
function profToRespo($connection,$id_prof,$lbl)
{
    $query = "INSERT INTO responsable (ID_PROFESSEUR,LBL_RESPO)
                VALUES ('$id_prof','$lbl')";
    $result = mysqli_query($connection, $query);
    return $result;
}
function profToChef($connection,$id_prof)
{
    $query = "SELECT * from responsable 
            Where ID_PROFESSEUR = '$id_prof'
            AND     LBL_RESPO = 'chef de filliere'";
    $chek =  mysqli_query($connection,$query); 
    if($chek && mysqli_num_rows($chek) > 0)
    {  
         return false; 
    }
    else
    {
        $query = "INSERT INTO responsable (ID_PROFESSEUR,LBL_RESPO)
                    VALUES ('$id_prof','chef de filliere')";
        $result = mysqli_query($connection, $query);
        return $result;
    }
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
    $query = "SELECT ID_FILLIERE FROM  filliere WHERE ID_RESPONSABLE = '$Chef_FIl' AND LBL_FILLIERE = '$nom'";
    $result = mysqli_query($connection, $query);
    $data = mysqli_fetch_array($result);
    return $data['ID_FILLIERE'];
}

function idProfToIdRespo($connection,$Chef_FIl)
{
    $query = "SELECT ID_RESPONSABLE FROM  responsable WHERE ID_PROFESSEUR = '$Chef_FIl'";
    $result = mysqli_query($connection, $query);
    $data = mysqli_fetch_array($result);
    return $data['ID_RESPONSABLE'];
}


function id_jury($connection,$id_respo,$date_start,$type,$niv)
{
    $query = "SELECT ID_JURY FROM jury
                WHERE ID_RESPONSABLE = '$id_respo'
                AND     DATE_DEBUT = '$date_start'
                AND     TYPE_DE_JURY = '$type'
                AND     ID_NIVEAU = '$niv'";
    $result = mysqli_query($connection, $query);
    $data = mysqli_fetch_array($result);
    return $data['ID_JURY'];

}
function idNivToFill($connection,$id_niv)
{
    $query = "SELECT f.LBL_FILLIERE ,f.ID_FILLIERE
                FROM filliere AS f,niveau AS n
                WHERE f.ID_FILLIERE = n.ID_FILLIERE
                AND     n.ID_NIVEAU = '$id_niv'";
    $result = mysqli_query($connection,$query);
    return $result;          
} 
function idNivToNiv($connection,$id_niv)
{
    $query = "SELECT * from niveau where ID_NIVEAU = '$id_niv'";
    $result = mysqli_query($connection, $query);
    return $result;
}
function encadrement_prof($connection,$id_respo,$etudiant)
{

}