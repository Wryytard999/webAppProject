<?php
include("../php web/connection.php");
include("../php web/functions.php");

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(isset($_POST['submit']))
    {
        if(!empty($_POST['nom']) && !empty($_POST['Niv']) 
           && !empty( $_POST['chefFil']) )
      {
          
          $nom = htmlspecialchars($_POST['nom']);
          $Niv = htmlspecialchars($_POST['Niv']);
          $Chef_FIl = htmlspecialchars($_POST['chefFil']);
          
          if(!cheker_Fill(CONNECTION , $Chef_FIl , $nom))
          {
              
              $requet= "INSERT INTO filliere (ID_PROFESSEUR,LBL_FILLIERE,NBR_NIVEAU) values ('$Chef_FIl','$nom','$Niv')";
              $result = mysqli_query(CONNECTION, $requet);
              
              if($result)
              {
                echo '<div class="success-message">';
                echo '<p>La filliere ' . htmlspecialchars($nom, ENT_QUOTES) . ' a été enregistrée avec succès</p>';
                echo '</div>'; 
                header('refresh');
              }
          }
        else
        {
          echo '<div class="error-message">';
          echo '<p>La Filiere ' . htmlspecialchars($nom, ENT_QUOTES) .' existe déjà </p>';
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
    <link rel="stylesheet" href="../style web/Filiere.css" />
    <title>Document</title>
    <script defer src="../LoadSidebar.js"></script>
    
  </head>
  <body>
    <div class="containAll">
      <div id="sidebarContainer"></div>
      <div class="mainPage">
        <div><h1 class="bigTitle">Filieres:</h1></div>
        <div class="table">
          <div class="tableHead">
            <p class="data">Nom</p>
            <p class="data">Chef de filiere</p>
          </div>
          <div class="tableContainer">
          
            <?php

            $data = appel_filier(CONNECTION);
            if($data)
            {
                  while($row = mysqli_fetch_assoc($data))
                {
                    echo "<a href='affichageFil.php'>";
                      echo "<div class='tableRow'>";
                        echo "<p class='data'>";
                            echo $row["LBL_FILLIERE"];
                        echo "</p>";
                          //  affichage du tableau d'apres BD
                          $prof_data = id_nom_prof(CONNECTION,$row["ID_PROFESSEUR"]);
                          while($prof = mysqli_fetch_assoc($prof_data))
                          {
                            echo "<p class='data'>";
                            echo $prof['NOM'] . ' ' . $prof['PRENOM'];
                            echo "</p>";
                          }

                      echo "</div>";
                    echo "</a>";
                  }
            }
            ?>
                      



          </div>
        </div>
        <div><h1 class="bigTitle">Ajouter une filiere:</h1></div>
        <div class="formContainer">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="inputContainer">
              <label for="nom">Nom:</label>
              <input type="text" id="nom" name="nom" placeholder="Nom">
            </div>
            <div class="inputContainer">
              <label for="chefFil">Chef de filiere:</label>
              <select id="chefFil" name="chefFil" class="dropDown">
                  <?php
                  $data = prof_list(CONNECTION);
                  while ($row = mysqli_fetch_assoc($data)) {
                    printf(
                      "<option value='%d'>%s %s</option>",
                      htmlspecialchars($row['ID_PROFESSEUR'], ENT_QUOTES),
                      htmlspecialchars($row['PRENOM'], ENT_QUOTES),
                      htmlspecialchars($row['NOM'], ENT_QUOTES)
                  );  
                    //echo "<option value='{$row['ID_PROFESSEUR']}'>{$row['PRENOM']} {$row['NOM']}</option>";
                  }
                 ?>
              </select>
            </div>
            <div class="inputContainer">
              <label for="Niv">Nombre des niveaux:</label>
              <select id="Niv" name="Niv" class="dropDown">
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
            <div class="filler"></div>
            <div class="buttonContainer">
              <input type="submit" name="submit" value="Ajouter" class="brownButton">
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
