<?php
include("../php web/connection.php");
include("../php web/functions.php");
if($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    if(isset($_POST['submit']))
    {
        if(!empty($_POST['nom']) && !empty($_POST['prenom']) 
        && !empty($_POST['emailUni']))
        {
          $nom = htmlspecialchars($_POST['nom']);
          $prenom = htmlspecialchars($_POST['prenom']);
          $email_uni = htmlspecialchars($_POST['emailUni']);
          $email_sec = htmlspecialchars($_POST['emailSec']);
          $code_APOGEE = htmlspecialchars($_POST['codeAPOGEE']);
          $tel = htmlspecialchars($_POST['tel']);
          if(!cheker_prof(CONNECTION,$email_uni))
          {
              $requet="INSERT INTO professeur (CODE_APOGE,PRENOM,NOM,CONTACT,EMAIL_EDU,EMAIL_PERS) 
              values ('$code_APOGEE','$prenom','$nom','$tel','$email_uni','$email_sec')";
              $result = mysqli_query(CONNECTION, $requet);
              
                if($result)
                {
                  echo '<div class="success-message">';
                  echo '<p>Le Prof ' . htmlspecialchars($nom, ENT_QUOTES) ." ".htmlspecialchars($prenom, ENT_QUOTES) . ' a été enregistrée avec succès</p>';
                  echo '</div>'; 
                  header('refresh');
                }
          }
          else
          {
            
            echo '<div class="error-message">';
            echo '<p>Le Prof ' . htmlspecialchars($nom, ENT_QUOTES) ." ".htmlspecialchars($prenom, ENT_QUOTES) . ' existe déjà </p>';
            echo '</div>';
            header('refresh');
          }
          
      

    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style web/Professeurs.css" />
    <title>Document</title>
    <script defer src="../LoadSidebar.js"></script>
    
  </head>
  <body>
    <div class="containAll">
    <div id="sidebarContainer"></div>
          <div class="mainPage">
            <div><h1 class="bigTitle">Professeurs insérées:</h1></div>
                <div class="table">
                  <div class="tableHead">
                    <p class="data">Nom complet</p>
                    <p class="data">Email universitaire</p>
                  </div>
                  <div class="tableContainer">
                      <?php
                          $data =appel_prof(CONNECTION);
                          while ($row = mysqli_fetch_assoc($data)) 
                          {
                            echo "<a href='affichageProf.php'>";
                              echo "<div class='tableRow'>";
                                echo "<p class='data'>";
                                    echo $row["NOM"] . " ". $row["PRENOM"];
                                      echo "</p>";
                                          //  affichage du tableau d'apres BD
                                      echo "<p class='data'>";
                                    echo $row["EMAIL_EDU"];
                                echo "</p>";
                              echo "</div>";
                            echo "</a>";
                          }
                          
                      ?>
                  </div>
                </div>
                <div><h1 class="bigTitle">Ajouter un professeur:</h1></div>
                <div class="formContainer">
                  <form action="" method="post">
                    <div class="inputContainer">
                      <label for="nom">Nom:</label>
                      <input type="text" id="nom" name="nom" placeholder="Nom">
                    </div>
                    <div class="inputContainer">
                      <label for="prenom">Prenom:</label>
                      <input type="text" id="prenom" name="prenom" placeholder="Prenom">
                    </div>
                    <div class="inputContainer">
                      <label for="emailUni">Email universitaire:</label>
                      <input type="email" id="emailUni" name="emailUni" placeholder="exemple@uiz.ac.ma">
                    </div>
                    <div class="inputContainer">
                      <label for="emailSec">Email secondaire:</label>
                      <input type="email" id="emailSec" name="emailSec" placeholder="exemple@gmail.com">
                    </div>
                    <div class="inputContainer">
                      <label for="adr">CODE APOGEE:</label>
                      <input type="text" id="adr" name="codeAPOGEE" placeholder="Code professeur">
                    </div>
                      <div class="inputContainer">
                        <label for="tel">Telephone:</label>
                        <input type="tel" id="tel" name="tel" placeholder="0699999999">
                      </div>
                      <div class="buttonContainer">
                        <input type="submit" name="submit" value="Ajouter" class="brownButton">
                      </div>
                  </form>
                </div>
        </div>
    </div>
  </body>
</html>