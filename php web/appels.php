<?php
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
    $query = "SELECT *
                FROM jury 
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