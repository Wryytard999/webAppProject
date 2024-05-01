<?php
function appel_prof($connection,$id_prof)
{
    if(!isset($id_prof))
    {
        $query = "SELECT * FROM professeur ORDER BY `ID_PROFESSEUR` DESC";
        $result = mysqli_query($connection,$query);
        return $result;
    }
    else
    {
      $query = "SELECT * FROM professeur WHERE ID_PROFESSEUR = '$id_prof' ORDER BY `ID_PROFESSEUR` DESC";
      $result = mysqli_query($connection,$query);
        return $result;
    }
}
function appel_filier($connection,$id_fillier)
{
    if(!isset($id_fillier))
    {
        $query = "SELECT * FROM filliere ORDER BY `ID_FILLIERE` DESC";
        $result = mysqli_query($connection, $query);
        return $result;
    }
    else
    {
        $query = "SELECT * FROM filliere WHERE ID_FILLIERE = '$id_fillier' ORDER BY  `ID_FILLIERE` DESC";
        $result = mysqli_query($connection, $query);
        return $result;
    }
}



function apepel_jury($connection,$id_jury)
{
    if(!isset($id_jury))
    {
    $query = "SELECT *
                FROM jury 
                ORDER BY `ID_JURY` DESC";
    $result = mysqli_query($connection, $query);
    return $result;
    }
    else
    {
        $query = "SELECT *
        FROM jury 
        WHERE ID_JURY = '$id_jury'
        ORDER BY `ID_JURY` DESC";
        $result = mysqli_query($connection, $query);
        return $result;
    }
}

function appel_encadrement($connection,$id_encadrement)
{
    if(!isset($id_encadrement))
    {
        $query = "SELECT * FROM encadrement Order by ID_ENCADREMENT desc";
        $result = mysqli_query($connection, $query);
        return $result;
    }
    else
    {
        $query = "SELECT * FROM encadrement WHERE ID_ENCADREMENT = '$id_encadrement' Order by ID_ENCADREMENT desc";
        $result = mysqli_query($connection, $query);
        return $result;
    }
}

function appel_visite($connection,$id_visit)
{
    if(!isset($id_visit))
    {
        $query = "SELECT * FROM visite ORDER BY ID_VISITE DESC";
        $result = mysqli_query($connection, $query);
        return $result;
    }
    else
    {
        $query = "SELECT * FROM visite WHERE ID_VISITE = '$id_visit' ORDER BY ID_VISITE DESC";
        $result = mysqli_query($connection, $query);
        return $result;
    }
}