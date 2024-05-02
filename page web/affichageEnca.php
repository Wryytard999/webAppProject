<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style web/modifierProf.css" />
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
            <a href="visites.php"><h3>Visites</h3></a>
          </div>
          <div class="title">
            <a href="encadrement.php" class="selected"><h3>Encadrement</h3></a>
          </div>
        </div>
        <a href="Main.html"><button class="whiteButton">END</button></a>
      </div>
    </div>
      <div class="mainPage">
        <div class="header">
            <div><h1 class="bigTitle">Encadrement Akessas-El bahri:</h1></div>
        </div>
          <div class="dataContainersContainer">
                <div class="formContainer">
                  <form action="" method="post">
                    <div class="inputContainer">
                      <label for="nom">Etudiant:</label>
                      <input type="text" name="Etudiant" id="Etudiant" placeholder="Etudiant">
                    </div>
                    <div class="inputContainer">
                        <label for="Fil">Niveau:</label>
                        <select id="Fil" name="Fil" class="dropDown">
                        </select>
                    </div>
                    <div class="inputContainer">
                        <label for="respo">Encadrant:</label>
                        <select id="respo" name="respo" class="dropDown">
                        </select>
                    </div>
                    <div class="inputContainer">
                        <label for="dateStart">Date:</label>
                        <input type="date" name="date" class="date" id="dateStart">
                    </div>
                    <div class="NotesContainer">
                        <label for="notes">Notes:</label>
                        <textarea id="Notes" name="notes" placeholder="notes" rows="4" cols="50"></textarea>
                    </div>
                    <div class="filler"></div>
                    <div class="buttonContainer">
                        <input type="submit" name="submit" value="Sauvegarder" class="brownButton">
                        <div><button class="whiteButton">Supprimer</button></div>
                        <div><button class="brownButton">Creer rapport</button></div>
                    </div>
                  </form>
                </div>
          </div>
      </div>
    <script>
          // Function to populate dropdown with options
          function populateDropdown(selectId, options) {
              var selectElement = document.getElementById(selectId);
              
              // Clear existing options
              selectElement.innerHTML = '';

              // Add new options
              options.forEach(function(option) {
                  var optionElement = document.createElement('option');
                  optionElement.value = option.value;
                  optionElement.textContent = option.label;
                  selectElement.appendChild(optionElement);
              });
          }

          function loadData() {
            // Example data (you can replace this with data loaded from a source like an API)
            var loadedData = {
                Etudiant: "wadia el bahri",
                Notes: "Officia qui fugiat elit labore cillum. Labore pariatur aute eiusmod do ut eiusmod exercitation. Mollit fugiat duis tempor in culpa ad irure mollit aliqua sit pariatur nulla laboris pariatur. Duis excepteur mollit pariatur consequat adipisicing quis occaecat eiusmod. Non dolore pariatur minim eiusmod do. In quis consectetur magna eu sit laborum do ut nulla ea nisi reprehenderit. Anim fugiat qui adipisicing cupidatat cupidatat ut et laboris culpa qui commodo fugiat."
            };
    
            // Set the input field values with the loaded data
            document.getElementById("Etudiant").value = loadedData.Etudiant;
            document.getElementById("Notes").value = loadedData.Notes;
        }

        function setInitialDate() {
        var currentDate = new Date();
        var formattedDate = currentDate.toISOString().slice(0, 10); // Format: YYYY-MM-DD
        document.getElementById('dateStart').value = formattedDate;
        }

          // Function to load data into dropdowns when the page is loaded
          window.onload = function() {
              // Data for 'Niveau' dropdown
              var niveaux = [
                  { value: 'Genie informaique 1', label: 'Genie informaique 1' },
                  { value: 'Genie mecanique 2', label: 'Genie mecanique 2' },
                  { value: 'Genie industriel 1', label: 'Genie industriel 1' }
              ];

              // Data for 'Encadrant' dropdown
              var encadrants = [
                  { value: 'wadia el bahri', label: 'Wadia El Bahri' },
                  { value: 'another encadrant', label: 'Another Encadrant' },
                  { value: 'yet another encadrant', label: 'Yet Another Encadrant' }
              ];

              // Populate 'Niveau' dropdown
              populateDropdown('Fil', niveaux);

              // Populate 'Encadrant' dropdown
              populateDropdown('respo', encadrants);

              setInitialDate();

              loadData();
          };
    </script>
  </body>
</html>
