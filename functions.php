<?php

function cheker_prof($connection,$email)
{
    if(!empty($email))
    {
        $requet = "SELECT * FROM professeur WHERE Email_uni = '$email'";
        $result = mysqli_query($connection,$requet);
        return $result && mysqli_num_rows($result) >0;
    }
}