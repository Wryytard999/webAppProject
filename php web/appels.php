<?php
function appel_prof($connection)
{
    $query = "SELECT * FROM professeur ORDER BY `ID_PROFESSEUR` DESC";
    $result = mysqli_query($connection,$query);
    return $result;
}
function appel_filier($connection)
{
    $query = "SELECT * FROM niveau ORDER BY `ID_FILLIERE` DESC";
    $result = mysqli_query($connection, $query);
    return $result;
}


function apepel_jury($connection)
{
    $query = "SELECT NOM,PRENOM,LBL_FILLIERE,LBL_NIVEAUX,TYPE_DE_JURY 
                FROM jury AS j ,professeur AS p ,responsable AS r,niveau AS f, niveau AS n
                WHERE j.ID_RESPONSABLE=r.ID_RESPONSABLE
                AND r.ID_PROFESSEUR =p.ID_PROFESSEUR
                AND j.ID_FILLIERE=   f.ID_FILLIERE
                AND f.ID_FILLIERE=   n.ID_FILLIERE
                AND j.ID_NIVEAU  =   n.ID_NIVEAU
                ORDER BY `ID_JURY` DESC";
    $result = mysqli_query($connection, $query);
    return $result;
}

function appel_encadrement($connection)
{
    $query = "SELECT * FROM encadrement Order by ID_ENCADREMENT desc";
    $result = mysqli_query($connection, $query);
    return $result;
}

function appel_visite($connection){}