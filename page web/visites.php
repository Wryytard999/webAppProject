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
      <div id="sidebarContainer"></div>
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
            <a href="affichageVis.php">
              <div class="tableRow">
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique 1</p>
                <p class="data">Taroudant</p>
                <p class="data">04/09/2024</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique 1</p>
                <p class="data">Taroudant</p>
                <p class="data">04/09/2024</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique 1</p>
                <p class="data">Taroudant</p>
                <p class="data">04/09/2024</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique 1</p>
                <p class="data">Taroudant</p>
                <p class="data">04/09/2024</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique 1</p>
                <p class="data">Taroudant</p>
                <p class="data">04/09/2024</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique 1</p>
                <p class="data">Taroudant</p>
                <p class="data">04/09/2024</p>
              </div>
            </a>
            <a href="">
              <div class="tableRow">
                <p class="data">Wadia El bahri</p>
                <p class="data">Genie Informatique 1</p>
                <p class="data">Taroudant</p>
                <p class="data">04/09/2024</p>
              </div>
            </a>
          </div>
        </div>
        <div><h1 class="bigTitle">Ajouter une visite:</h1></div>
        <div class="formContainer">
          <form action="" method="post">
            <div class="inputContainer">
                <label for="Destination">Destination</label>
                <input type="text" id="Destination" placeholder="Destination">
            </div>
            <div class="inputContainer">
                <label for="Fil">Filiere:</label>
                <select id="Fil" class="dropDown">
                  <option value="Genie Informatique">Genie Informatique</option>
                  <option value="Genie Industriel">Genie Industriel</option>
                  <option value="Finance et Ingenieurie decisionnelle">Finance et Ingenieurie decisionnelle</option>
                </select>
            </div>
            <div class="inputContainer">
                <label for="Niveau">Niveau:</label>
                <select id="Niveau" class="dropDown">
                  <option value="Genie Informatique 1">Genie Informatique 1</option>
                  <option value="Genie Informatique 2">Genie Informatique 2</option>
                  <option value="Genie Informatique 3">Genie Informatique 3</option>
                </select>
            </div>
            <div class="inputContainer">
                <label for="respo">Responsable:</label>
                <select id="respo" class="dropDown">
                  <option value="Hamid akessas">Hamid akessas</option>
                  <option value="Toumnari">Toumnari</option>
                  <option value="Wadia">Wadia</option>
                </select>
            </div>
            <div class="inputContainer">
                <label for="participant">Participants:</label>
                <select id="participant" class="dropDown" multiple>
                  <option value="Hamid akessas">Hamid akessas</option>
                  <option value="Toumnari">Toumnari</option>
                  <option value="Wadia">Wadia</option>
                </select>
            </div>
            <div class="inputContainer">
                <label for="dateStart">Date depart:</label>
                <input type="datetime" class="date" id="dateStart">
            </div>
            <div class="inputContainer">
                <label for="dateFin">Date retour:</label>
                <input type="datetime" class="date" id="dateFin">
            </div>
            <div class="filler"></div>
            <div class="buttonContainer">
              <input type="submit" value="Ajouter" class="brownButton">
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>