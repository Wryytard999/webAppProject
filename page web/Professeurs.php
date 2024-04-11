<?php
include("../php web/connection.php");
include("../php web/functions.php");
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
                $data =appel_prof($connection);
                while ($row = mysqli_fetch_assoc($data)) {
                  echo "<a href='affichageProf.php'>";
                    echo "<div class='tableRow'>";
                      echo "<p class='data'>";
                          echo $row["Nom"] . " ". $row["prenom"];
                      echo "</p>";
                                    //  affichage du tableau d'apres BD
                      echo "<p class='data'>";
                          echo $row["Email_uni"];
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
              <label for="adr">Adresse:</label>
              <input type="text" id="adr" name="adr" placeholder="El houda Agadir 80000">
            </div>
            <div class="inputContainer">
              <label for="tel">Telephone:</label>
              <input type="tel" id="tel" name="tel" placeholder="0699999999">
            </div>
            <div class="buttonContainer">
              <input type="submit" value="Ajouter" class="brownButton">
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    if(isset($_POST['nom']) && isset($_POST['prenom']) 
        && isset( $_POST['emailUni']) && isset($_POST['adr']) 
        && isset($_POST['tel']))
    {
        if(!empty($_POST['nom']) && !empty($_POST['prenom']) 
        && !empty( $_POST['emailUni']) )
      {
          $nom = htmlspecialchars($_POST['nom']);
          $prenom = htmlspecialchars($_POST['prenom']);
          $email_uni = htmlspecialchars($_POST['emailUni']);
          $email_sec = htmlspecialchars($_POST['emailSec']);
          $adr = htmlspecialchars($_POST['adr']);
          $tel = htmlspecialchars($_POST['tel']);
          if(!cheker_prof($connection,$email_uni))
          {
              $requet="INSERT INTO professeur (Nom,prenom,Email_uni,Email_sec,adrress,telephone) 
              values ('$nom','$prenom','$email_uni','$email_sec','$adr','$tel')";
              if($result = mysqli_query($connection, $requet))
              {
                echo '<script  type="text/javascript"> 
                      alert("professeur ' . $prenom . ' ' . $nom . 'est enregistrer par sucees");
                      </script>';
                header('Location:professeurs.php');
          
              }
          }
          else{
              echo '<script type="text/javascript">
                    alert("professeur ' . $prenom . ' ' . $nom . ' déjà exist");
                    </script>';
                  header('Location:professeurs.php');
          }

      }
    }
}
?>