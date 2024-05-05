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
      if(isset($_POST['Destination'])  &&  isset($_POST['respo']) 
            && isset($_POST['Fil']) && isset($_POST["Niveau"])
            &&  isset($_POST['dateStart']))
        {
          $id_respo = htmlspecialchars($_POST['respo']);
          $destination = htmlspecialchars($_POST['Destination']);
          $fil = htmlspecialchars($_POST['Fil']);
          $niv = htmlspecialchars($_POST['Niveau']);
          $id_part = $_POST['participant'];
          $date_start = htmlspecialchars($_POST['dateStart']);
          $date_end = htmlspecialchars($_POST['dateFin']);

          $responsabilite = profToRespo(CONNECTION,$id_respo,'visite');// passer le prof comme un respo d'un jury avant de le mettre comme chef de filliere
          $id_respo = idProfToIdRespo(CONNECTION,$id_respo,'visite');
            
          $requet="INSERT INTO visite (ID_NIVEAU,ID_RESPONSABLE,LIEU,DATE_DEBUT,DATE_FIN) 
                         values ('$niv','$id_respo','$destination','$date_start','$date_end')";
          $result = mysqli_query(CONNECTION, $requet);
              
          $id_visite = id_visite(CONNECTION,$id_respo,$date_start,$destination,$niv);

          if(is_array($id_part) && !empty($id_part))
          {
              foreach($id_part as $value)
            {
                $query = "INSERT INTO assister (ID_PROFESSEUR,ID_VISITE) value ('$value','$id_visite')";
                mysqli_query(CONNECTION, $query);
            }
          }
          

            if($result)
            {
              printf("<div class='success-message'>
                        <p> La visite  commancera de %s à %s </p>
                      </div>"
                      ,htmlspecialchars($date_start, ENT_QUOTES),htmlspecialchars($date_end, ENT_QUOTES));
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
    <link rel="stylesheet" href="../style web/visites.css" />
    <title>Document</title>
    <script src="../LoadSidebar.js"></script>
  </head>
  <body>
    <div class="containAll">
    <div class="sideContainer">
    <div class="navBar">
      <div class="Logo">
        <a href="Main.html"><img src="../assets/logo.svg" alt="Logo" /></a>
      </div>
      <div class="container">
        <div class="title">
          <a href="Professeurs.php"><h3>Professeurs</h3></a>
        </div>
        <div class="title">
          <a href="Filiere.php"><h3>Filieres</h3></a>
        </div>
        <div class="title">
          <a href="jury.php"><h3>Jury</h3></a>
        </div>
        <div class="title">
          <a href="visites.php" class="selected"><h3>Visites</h3></a>
        </div>
        <div class="title">
          <a href="encadrement.php"><h3>Encadrement</h3></a>
        </div>
      </div>
      <a href="Main.html"><button class="whiteButton">END</button></a>
    </div>
    </div>
      <div class="mainPage">
        <div><h1 class="bigTitle">Visites:</h1></div>
        <div class="table">
          <div class="tableHead">
            <p class="data">Responsable</p>
            <p class="data">Niveau</p>
            <p class="data">Destination</p>
            <p class="data">Date depart</p>
          </div>
          <div class="tableContainer">
            <?php 
            $data = appel_visite(CONNECTION,null);
            if($data)
            {
                  while($row = mysqli_fetch_assoc($data))
                {
                  printf("      <a href='affichageVis.php'>
                                  <div class='tableRow'>");
                  
                  $prof_data = id_respo_to_NOM(CONNECTION,$row["ID_RESPONSABLE"]);
                  while($prof = mysqli_fetch_assoc($prof_data))
                      {
                  printf("          <p class='data'> %s %s </p>"
                              ,$prof["PRENOM"],$prof["NOM"]);
                      }

                      $Niv_data = idNivToNiv(CONNECTION,$row['ID_NIVEAU']);
                      while($Niv = mysqli_fetch_assoc($Niv_data))
                      {
                      printf("         <p class='data'>%s</p>"  
                                ,$Niv['LBL_NIVEAUX']);
                      }  
                  printf("         <p class='data'>%s</p>"
                            ,$row['LIEU']);
                  printf("         <p class='data'>%s</p>
                                </div>
                                </a>"
                                  ,$row['DATE_DEBUT']);
                       //  affichage du tableau d'apres BD
                }
            }
            ?>
         
          </div>
        </div>
        <div><h1 class="bigTitle">Ajouter une visite:</h1></div>
        <div class="formContainer">
          <form action="" method="post">
            <div class="inputContainer">
                <label for="Destination">Destination</label>
                <input type="text" name="Destination" id="Destination" placeholder="Destination">
            </div>
            <div class="inputContainer">
                <label for="Fil">Filiere:</label>
                <select id="Fil" name="Fil" class="dropDown">
                <?php
                  $data = filliere_liste(CONNECTION);
                  while($row = mysqli_fetch_assoc($data))
                  {
                   
                    printf(
                      "<option value='%d'>%s</option>",
                      $row['ID_FILLIERE'],$row['LBL_FILLIERE']
                    );
                  }
                 ?>
                </select>
            </div>
            <div class="inputContainer">
                <label for="Niveau">Niveau:</label>
                <select id="Niveau" name="Niveau" class="dropDown">
                <?php
                  $data = niveau_liste(CONNECTION);
                  while($row = mysqli_fetch_assoc($data))
                  {
                    printf(
                      "<option value='%d'> %s </option>",
                      $row['ID_NIVEAU'],$row['LBL_NIVEAUX']
                    );
                  }
                  ?>
                </select>
            </div>
            <div class="inputContainer">
                <label for="respo">Responsable:</label>
                <select id="respo" name="respo" class="dropDown">
                <?php //liste des prof
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
                <label for="participant">Participants:</label>
                <select id="participant" name="participant[]" class="dropDown" multiple>
                <?php //liste des prof
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
                <label for="dateStart">Date depart:</label>
                <input type="date" name="dateStart" class="date" id="dateStart">
            </div>
            <div class="inputContainer">
                <label for="dateFin">Date retour:</label>
                <input type="date" name="dateFin" class="date" id="dateFin">
            </div>
            <div class="filler"></div>
            <div class="buttonContainer">
              <input type="submit" name="submit" value="Ajouter" class="brownButton">
            </div>
          </form>
        </div>
      </div>
    </div>
    <script>
    </script>
  </body>
</html>
