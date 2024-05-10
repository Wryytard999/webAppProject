<?php
include("../php web/connection.php");
include("../php web/functions.php");
include("../php web/appels.php");
include("../php web/cheker.php");
include("../php web/listes.php");

$id_prof=null;

if(isset($_GET['ID_PROFESSEUR']))
{
  $id_prof = $_GET['ID_PROFESSEUR'];
  
}
  
    if(isset($_POST['submit']))
    {
        if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['codeAPOGEE']) && isset($_POST['ID_PROF']))
        {
          $id_prof = htmlspecialchars($_POST['ID_PROF']);
          $nom = htmlspecialchars($_POST['nom']);
          $prenom = htmlspecialchars($_POST['prenom']);
          $email_uni = htmlspecialchars($_POST['emailUni']);
          $email_sec = htmlspecialchars($_POST['emailSec']);
          $code_APOGEE = htmlspecialchars($_POST['codeAPOGEE']);
          $tel = htmlspecialchars($_POST['tel']);

      
          $requet = "UPDATE professeur
                      SET PRENOM = ?,
                          NOM = ?,
                          CONTACT = ?,
                          EMAIL_EDU = ?,
                          EMAIL_PERS = ?,
                          CODE_APOGE = ?
                      WHERE ID_PROFESSEUR = ?";

          $stmt = mysqli_prepare(CONNECTION, $requet);
          mysqli_stmt_bind_param($stmt, "ssssssi", $prenom, $nom, $tel, $email_uni, $email_sec, $code_APOGEE, $id_prof);
          $result = mysqli_stmt_execute($stmt);
            if($result)
              {
                printf("<div class='success-message'>
                          <p> Le Prof  %s %s est modifier par succes </p>
                      </div>"
                      ,htmlspecialchars($nom, ENT_QUOTES),htmlspecialchars($prenom, ENT_QUOTES));
                header('refresh ');
              }
          
          if(!cheker_prof(CONNECTION,$code_APOGEE))
          {
            printf("<div class='error-message'>
                      <p> Le Prof  %s %s  existe déjà </p>
                    </div>"
                    ,htmlspecialchars($nom, ENT_QUOTES),htmlspecialchars($prenom, ENT_QUOTES));
            header('refresh');
          }
        }
        else{
          printf("<div class='error'>
                      <p> Erreur  </p>
                    </div>");
            header('refresh');

        }
      }
      elseif(isset($_POST['supprimer']))
      {
        if(isset($_POST['delete_id_prof']))
        {
            $id_prof = $_POST['delete_id_prof'];
            $query = "DELETE FROM professeur WHERE ID_PROFESSEUR = '$id_prof'";
            $result = mysqli_query(CONNECTION,$query);
            if($result)
            {
              printf("<div class='success-message'>
                          <p> Le Prof est supprimer par succes </p>
                      </div>"
                      );
                      header('Location: Professeurs.php');
            }
        }

      }



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style web/modifierProf.css" />
    <title>Document</title>
    <script src="../LoadSidebar.js"></script>
  </head>
  <body onload="loadData()">
    <div class="containAll">
    <div class="sideContainer">
      <div class="navBar">
        <div class="Logo">
          <a href="Main.html"><img src="../assets/logo.svg" alt="Logo" /></a>
        </div>
        <div class="container">
          <div class="title">
            <a href="Professeurs.php" class="selected"><h3>Professeurs</h3></a>
          </div>
          <div class="title">
            <a href="Filiere.php"><h3>Filieres</h3></a>
          </div>
          <div class="title">
            <a href="jury.php"><h3>Jury</h3></a>
          </div>
          <div class="title">
            <a href="visites.php"><h3>Visites</h3></a>
          </div>
          <div class="title">
            <a href="encadrement.php"><h3>Encadrement</h3></a>
          </div>
        </div>
        <a href="Main.html"><button class="whiteButton">END</button></a>
      </div>
    </div>
      <div class="mainPage">
        <div class="header">
            <div><h1 class="bigTitle">Professeur</h1></div>
        </div>
        <div class="dataContainersContainer"> 
        <div>
                <div class="formContainer">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="inputContainer">
                      <label for="nom">Nom:</label>
                      <input type="text" id="nom" name="nom" placeholder="Nom ">
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
                      <input type="text" id="adr" name="codeAPOGEE" placeholder="Code professeur" required>
                    </div>
                      <div class="inputContainer">
                        <label for="tel">Telephone:</label>
                        <input type="tel" id="tel" name="tel" placeholder="0699999999">
                      </div>
                      <div class="inputContainer">
                      <input type="hidden" name="ID_PROF" value="<?php printf("%d",$id_prof) ?>">

                      </div>
                      <div class="buttonContainer">
                        <input type="submit" name="submit" value="Sauvegarder" class="brownButton">
                          <div>
                              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                              <input type="hidden" name="delete_id_prof" value="<?php  printf("%d",$id_prof) ?>">
                              <input class='whiteButton' type="submit" name="supprimer" value="Supprimer" class="whiteButton">
                              </form>
                          </div>
                        <div><button class="brownButton" id="creerRapport">Creer rapport</button></div>
                      </div>
                  </form>
                </div>
        </div> 
        <?php
        $data = appel_prof(CONNECTION, $id_prof);
        while($row = mysqli_fetch_assoc($data))
        {
          printf("<script>// Function to load data into the form fields
                  function loadData() {
                  // Example data (you can replace this with data loaded from a source like an API)
                  var loadedData = {
                      nom: '%s',
                      prenom: '%s',
                      emailsec: '%s',
                      emailuni: '%s',
                      codeapogee: '%s',
                      tel: '%s'
                  };
          
                  // Set the input field values with the loaded data
                  document.getElementById('nom').value = loadedData.nom;
                  document.getElementById('prenom').value = loadedData.prenom;
                  document.getElementById('emailUni').value = loadedData.emailuni;
                  document.getElementById('emailSec').value = loadedData.emailsec;
                  document.getElementById('adr').value = loadedData.codeapogee;
                  document.getElementById('tel').value = loadedData.tel;
              }
          </script>",$row['NOM'],$row['PRENOM'],$row['EMAIL_PERS'],$row['EMAIL_EDU'],$row['CODE_APOGE'],$row['CONTACT']);
        }
        
        
        ?>

      </div>
        <h3 class="miniTitle">Jurys:</h3>
        <div class="table">
          <div class="tableHead">
            <p class="data">Type</p>
            <p class="data">Filiere</p>
            <p class="data">Niveau</p>
          </div>
          <div class='tableContainer'>
          <?php
          $id_respo = idProfToIdRespo(CONNECTION, $id_prof,'jury');
          $query = "SELECT j.TYPE_DE_JURY , n.LBL_NIVEAUX ,f.LBL_FILLIERE , j.ID_JURY
                    FROM jury AS j , niveau AS n , filliere AS f
                    WHERE j.ID_NIVEAU = n.ID_NIVEAU
                    AND   n.ID_FILLIERE = f.ID_FILLIERE 
                    AND j.ID_RESPONSABLE = '$id_respo'
                    ORDER BY ID_JURY";
          $result = mysqli_query(CONNECTION,$query);
          while($row = mysqli_fetch_assoc($result))
          {
            printf("
                    <a href='affichageJury.php?ID_JURY=%s'>
                      <div class='tableRow'>
                        <p class='data'>%s</p>
                        <p class='data'>%s</p>
                        <p class='data'>%s</p>
                      </div>
                    </a>
                  "
                ,$row['ID_JURY'],$row['TYPE_DE_JURY'],$row['LBL_FILLIERE'],$row['LBL_NIVEAUX']);             
          }
          ?>
          </div>
        </div>

          
        <h3 class="miniTitle">Visites:</h3>
        <div class="table">
          <div class="tableHead">
            <p class="data">Destination</p>
            <p class="data">Niveau</p>
            <p class="data">Date depart</p>
          </div>
          <div class="tableContainer">
              <?php
              $id_respo = idProfToIdRespo(CONNECTION, $id_prof,'visite');
                  if(isset($id_respo) && !empty($id_respo)) // khasa xihj l cas ta3 prof maxi respo aslan kayt3 error waslan makhsx ytl3 wallo!!
                  {
                    $query = "SELECT v.LIEU ,n.LBL_NIVEAUX,v.DATE_DEBUT,v.ID_VISITE
                              FROM visite AS v , niveau AS n 
                              WHERE v.ID_NIVEAU = n.ID_NIVEAU 
                              AND v.ID_RESPONSABLE = '$id_respo'
                              ORDER BY ID_VISITE";
                    $result = mysqli_query(CONNECTION,$query);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        printf("<a href='affichageVis.php?ID_VISITE=%s'>
                                  <div class='tableRow'>
                                    <p class='data'>%s</p>
                                    <p class='data'>%s</p>
                                    <p class='data'>%s</p>
                                  </div>
                                 </a>
                                ",$row['ID_VISITE'],$row['LIEU'],$row['LBL_NIVEAUX'],$row['DATE_DEBUT']);
          }
        }
                ?>
          </div>
        </div>
        <h3 class="miniTitle">Encadrements:</h3>
        <div class="table">
          <div class="tableHead">
            <p class="data">Etudiant</p>
            <p class="data">Filiere</p>
            <p class="data">Niveau</p>
          </div>
          <div class="tableContainer">
            <?php
                
                $query = "SELECT e.ID_ENCADREMENT,e.ETUDIANT , n.LBL_NIVEAUX ,f.LBL_FILLIERE 
                          FROM encadrement AS e , niveau AS n , filliere AS f
                          WHERE e.ID_NIVEAU = n.ID_NIVEAU
                          AND   n.ID_FILLIERE = f.ID_FILLIERE 
                          AND e.ID_PROFESSEUR = '$id_prof'
                          ORDER BY ID_ENCADREMENT";
                $result = mysqli_query(CONNECTION,$query);
                while($row = mysqli_fetch_assoc($result))
                {
                  printf("
                          <a href='affichageEnca.php?ID_ENCADREMENT=%s'>
                            <div class='tableRow'>
                              <p class='data'>%s</p>
                              <p class='data'>%s</p>
                              <p class='data'>%s</p>
                            </div>
                          </a>
                        "
                      ,$row['ID_ENCADREMENT'],$row['ETUDIANT'],$row['LBL_FILLIERE'],$row['LBL_NIVEAUX']);             
                }

            ?>

          </div>
        </div>
      </div>
    </div>

  </body>
  <script src="../creerRapport.js"></script>
</html>
