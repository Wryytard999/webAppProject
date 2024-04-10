<?php
include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    if(isset($_POST['nom']) && isset($_POST['prenom']) 
        && isset( $_POST['emailUni']) && isset($_POST['adr']) 
        && isset($_POST['tel']))
    {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email_uni = htmlspecialchars($_POST['emailUni']);
        $email_sec = htmlspecialchars($_POST['emailSec']);
        $tel = htmlspecialchars($_POST['tel']);
        if(!cheker_prof($connection,$email_uni))
        {
            $requet="INSERT INTO professeur (nom,prenom,emailUni,emailSec,adr,tel) 
            values ('$nom','$prenom','$email_uni','$email_sec','$adr','$tel')";
            $result = mysqli_query($connection, $requet);
            echo "<script> alert('<h3>professeur'. $prenom . $nom .'est enregistrer  </h3>')</script>";
        }
        else{
            echo "<script> alert('<h3>professeur'. $prenom . $nom .'deja exist  </h3>')</script>";
        }
    }

}
