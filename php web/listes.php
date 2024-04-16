<?php


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

function niveau_liste($connection)
{
        $query = "SELECT * FROM niveau 
        Order by LBL_NIVEAUX desc";
        $result = mysqli_query($connection, $query);
        return $result; 
}
function jury_liste($connection)
{
    $query = "SELECT * FROM jury Order by ID_JURY desc";
    $result = mysqli_query($connection, $query);
    return $result;
}

