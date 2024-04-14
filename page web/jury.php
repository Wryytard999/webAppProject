<?php
include("../php web/connection.php");
include("../php web/functions.php");


if($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    if(isset($_POST['submit']))
    {/*
        if(!empty($_POST('Fil'))    &&    !empty($_POST['type']) 
        && !empty($_POST['Niveau']) &&    !empty($_POST['respo'])
        &&  !empty($_POST) )
        {
          
          if(!cheker_jury(CONNECTION))
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
          
      

    }*/
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style web/jury.css" />
    <title>Document</title>
    <script src="../LoadSidebar.js"></script>
  </head>
  <body>
    <div class="containAll">
      <div id="sidebarContainer"></div>
      <div class="mainPage">
        <div><h1 class="bigTitle">Jurys:</h1></div>
        <div class="table">
          <div class="tableHead">
            <p class="data">Responsable</p>
            <p class="data">Filiere</p>
            <p class="data">Type</p>
            <p class="data">Niveau</p>
          </div>
          <div class="tableContainer">
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique</p>
                <p class="data">Concours transfert</p>
                <p class="data">Genie Informatique 2</p>
              </div>
            </a>


            <?php 
            $data = apepel_jury(CONNECTION);


            ?>
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique</p>
                <p class="data">Concours transfert</p>
                <p class="data">Genie Informatique 2</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique</p>
                <p class="data">Concours transfert</p>
                <p class="data">Genie Informatique 2</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique</p>
                <p class="data">Concours transfert</p>
                <p class="data">Genie Informatique 2</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique</p>
                <p class="data">Concours transfert</p>
                <p class="data">Genie Informatique 2</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique</p>
                <p class="data">Concours transfert</p>
                <p class="data">Genie Informatique 2</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique</p>
                <p class="data">Concours transfert</p>
                <p class="data">Genie Informatique 2</p>
              </div>
            </a>
          </div>
        </div>
        <div><h1 class="bigTitle">Ajouter une jury:</h1></div>
        <div class="formContainer">
          <form action="" method="post">
            <div class="inputContainer">
                <label for="Fil">Filiere:</label>
                <select id="Fil" name="Fil" class="dropDown">
                  <option value="Genie Informatique">Genie Informatique</option>
                  <option value="Genie Industriel">Genie Industriel</option>
                  <option value="Finance et Ingenieurie decisionnelle">Finance et Ingenieurie decisionnelle</option>
                </select>
            </div>
            <div class="inputContainer">
              <label for="type">Type:</label>
              <select id="type" name="type" class="dropDown">
                <option value="recrutement">recrutement</option>
                <option value="soutenance">soutenance</option>
                <option value="concours passerelles">concours passerelles</option>
                <option value="concours transfert">concours transfert</option>
              </select>
            </div>
            <div class="inputContainer">
                <label for="Niveau">Niveau:</label>
                <select id="Niveau" name="Niveau" class="dropDown">
                  <option value="Genie Informatique 1">Genie Informatique 1</option>
                  <option value="Genie Informatique 2">Genie Informatique 2</option>
                  <option value="Genie Informatique 3">Genie Informatique 3</option>
                </select>
            </div>
            <div class="inputContainer">
                <label for="respo">Responsable:</label>
                <select id="respo" name="respo" class="dropDown">
                  <option value="Hamid akessas">Hamid akessas</option>
                  <option value="Toumnari">Toumnari</option>
                  <option value="Wadia">Wadia</option>
                </select>
            </div>
            <div class="inputContainer">
                <label for="participant">Participants:</label>
                <select id="participant" name="participant[]" class="dropDown" multiple>
                  <option value="Hamid akessas">Hamid akessas</option>
                  <option value="Toumnari">Toumnari</option>
                  <option value="Wadia">Wadia</option>
                </select>
            </div>
            <div class="inputContainer">
                <label for="dateStart">Date debut:</label>
                <input type="datetime" name="dateStart" class="date" id="dateStart">
            </div>
            <div class="inputContainer">
                <label for="dateFin">Date fin:</label>
                <input type="datetime" name="dateFin" class="date" id="dateFin">
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
