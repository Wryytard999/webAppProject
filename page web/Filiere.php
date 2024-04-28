<?php
include("../php web/connection.php");
include("../php web/functions.php");
include("../php web/appels.php");
include("../php web/cheker.php");
include("../php web/listes.php");

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
          
          if(!cheker_Fill(CONNECTION , $Chef_FIl , $nom))//checker si la filliere existe ou non
          {
              $responsabilite = profToChef(CONNECTION,$Chef_FIl);// passer le prof comme un chef de filliere
              if($responsabilite)
              {
                $id_respo = idProfToIdRespo(CONNECTION,$Chef_FIl);// recever son id
          
                $query = "INSERT INTO filliere (ID_RESPONSABLE,LBL_FILLIERE,NBR_NIVEAU)
                            VALUES ('$id_respo','$nom','$Niv')";
                mysqli_query(CONNECTION,$query);//inserer la nouvelle filliere au tableaux

                $id_fillier = id_fillier(CONNECTION,$id_respo,$nom);

                for($i=$Niv;$i>0;$i-=1)
                {
                  $lbl = $nom ." ". $i;
                  $requet= "INSERT INTO niveau (ID_FILLIERE,LBL_NIVEAUX) values ('$id_fillier','$lbl')";// inserer niveau basé sur les filliere
                  mysqli_query(CONNECTION, $requet);
                }
            
                //remplir tableau de filliere
                

                printf("<div class='success-message'>
                          <p> La Filliere << %s >> est ajoute par succes </p>
                      </div>"
                      ,htmlspecialchars($nom, ENT_QUOTES));
                header('refresh');
                
              }                
          }// bcp execption a gerer
        else
        {
          printf("<div class='error-message'>
                      <p> La Filliere << %s >>  existe déjà </p>
                    </div>"
                    ,htmlspecialchars($nom, ENT_QUOTES));
            header('refresh');
        } 
      }
      else
      { 
                 printf("<div class='error'>
                      <p> Erreur  </p>
                    </div>");
            header('refresh');

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
                  while($row = mysqli_fetch_assoc($data))//  affichage du tableau d'apres BD
                {
                  $prof_data = id_respo_to_NOM(CONNECTION,$row["ID_RESPONSABLE"]);
                  printf("<a href='affichageFil.php'>
                            <div class='tableRow'>
                              <p class='data'> %s </p>"
                              ,$row["LBL_FILLIERE"]);
                                while($prof = mysqli_fetch_assoc($prof_data))
                                {
                                  printf("<p class='data'> %s %s </p>"
                                          ,$prof["PRENOM"],$prof["NOM"]);
                                }

                    printf("</div>;
                            </a>");
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
