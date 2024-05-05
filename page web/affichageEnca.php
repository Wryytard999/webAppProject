<?php
try {
    include("../php web/connection.php");
    include("../php web/functions.php");
    include("../php web/appels.php");
    include("../php web/cheker.php");
    include("../php web/listes.php");

    $id_encadrement = null;
    $old_id_prof = null;

    // Retrieving jury ID if present in the URL
    if (isset($_GET['ID_ENCADREMENT'])) {
        $id_encadrement = $_GET['ID_ENCADREMENT'];

        // Query to get the responsible ID for the jury
        $query = "SELECT ID_PROFESSEUR
                  FROM encadrement 
                  WHERE ID_ENCADREMENT = '$id_encadrement'";

        $result = mysqli_query(CONNECTION, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $old_id_prof = $row['ID_PROFESSEUR'];
        }
    }

    if (isset($_POST['submit'])) {
        if (isset($_POST['Etudiant']) && isset($_POST['respo']) && isset($_POST['Fil'])) {
            $id_encadrement = htmlspecialchars($_POST['ID_ENCADREMENT']);
            $Etd = htmlspecialchars($_POST['Etudiant']);
            $niv = htmlspecialchars($_POST['Fil']);
            $respo = htmlspecialchars($_POST['respo']);
            $date_start = htmlspecialchars($_POST['date']);
            $note = htmlspecialchars($_POST['notes']);

            if ($result) {
                $requet = "UPDATE encadrement
                           SET  ETUDIANT = ?,
                                ID_NIVEAU= ?,
                                ID_PROFESSEUR= ?,
                                `DATE` = ?,
                                NOTE = ?
                          WHERE ID_ENCADREMENT = ?";

                $stmt = mysqli_prepare(CONNECTION, $requet);
                mysqli_stmt_bind_param($stmt, "siissi", $Etd, $niv, $respo, $date_start, $note, $id_encadrement);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    // Display success message
                    printf("<div class='success-message'>
                                <p> L'encadrement est modifié avec succès </p>
                            </div>");

                    header('refresh');
                }
            }
        } else {
            // Display error message for missing fields
            printf("<div class='error'>
                        <p> Erreur </p>
                    </div>");
            header('refresh');
        }
    } elseif (isset($_POST['supprimer'])) {
        // Handling form submission for deleting an encadrement
        if (isset($_POST['delete_encadrement'])) {
            $id_jury = $_POST['delete_encadrement'];
            $query = "DELETE FROM encadrement WHERE ID_ENCADREMENT = '$id_encadrement'";
            $result = mysqli_query(CONNECTION, $query);
            if ($result) {
                // Display success message
                printf("<div class='success-message'>
                            <p> L'encadrement est supprimé avec succès </p>
                        </div>");

                // Redirect to encadrement.php after 3 seconds
                header('refresh: 3; url=encadrement.php');
            }
        }
    }
} catch (Exception $e) {
    echo "Error: ", $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../style web/modifierProf.css"/>
    <title>Document</title>
    <script src="../LoadSidebar.js"></script>
</head>
<body>
<div class="containAll">
    <div class="sideContainer">
        <div class="navBar">
            <div class="Logo">
                <a href="Main.html"><img src="../assets/logo.svg" alt="Logo"/></a>
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
            <div><h1 class="bigTitle">Encadrement:</h1></div>
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
                        <input type="hidden" name="ID_ENCADREMENT" value="<?php printf("%d", $id_encadrement) ?>">
                        <input type="submit" name="submit" value="Sauvegarder" class="brownButton">
                        <div>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="hidden" name="delete_encadrement"
                                       value="<?php printf("%d", $id_encadrement) ?>">
                                <input class='whiteButton' type="submit" name="supprimer" value="Supprimer"
                                       class="whiteButton">
                            </form>
                        </div>
                        <div><button class="brownButton">Creer rapport</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
try {
    printf("
        <script>
            // Function to populate dropdown with options
            function populateDropdown1(selectId, options) {
                var selectElement = document.getElementById(selectId);
                
                // Clear existing options
                selectElement.innerHTML = '';

                // Add new options
                options.forEach(function(option) {
                    var optionElement = document.createElement('option');
                    optionElement.value = option[0]; // Value
                    optionElement.textContent = option[1]; // Label
                    selectElement.appendChild(optionElement);
                });
            }

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
    ");

    $result = appel_encadrement(CONNECTION, $id_encadrement);
    while ($row = mysqli_fetch_assoc($result)) {
        printf("
            function loadData() {
                // Example data (you can replace this with data loaded from a source like an API)
                var loadedData = {
                    Etudiant: '%s',
                    Notes: '%s'
                };
        
                // Set the input field values with the loaded data
                document.getElementById('Etudiant').value = loadedData.Etudiant;
                document.getElementById('Notes').value = loadedData.Notes;
            }

            function setInitialDate() {
                var currentDate = '%s';
                var formattedDate = currentDate; // Format: YYYY-MM-DD
                document.getElementById('dateStart').value = formattedDate;
            }
        ", $row['ETUDIANT'], $row['NOTE'], $row['DATE']);
    }

    printf("
        // Function to load data into dropdowns when the page is loaded
        window.onload = function() {
            var niveaux = [];");

    // Retrieving levels associated with the jury
    $query = "SELECT e.ID_NIVEAU, n.LBL_NIVEAUX 
                FROM encadrement AS e, niveau AS n 
                WHERE e.ID_NIVEAU = n.ID_NIVEAU
                AND e.ID_ENCADREMENT = '$id_encadrement'";
    $result = mysqli_query(CONNECTION, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        printf("
            niveaux.push(['%d','%s']);
            ", $row['ID_NIVEAU'], $row['LBL_NIVEAUX']);
    }

    // Retrieving other levels not associated with the jury
    $query = "SELECT n.ID_NIVEAU, n.LBL_NIVEAUX
                FROM niveau AS n
                WHERE n.ID_NIVEAU NOT IN (SELECT ID_NIVEAU FROM encadrement WHERE ID_ENCADREMENT = '$id_encadrement')";

    $result = mysqli_query(CONNECTION, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        printf("
            niveaux.push(['%d','%s']);
            ", $row['ID_NIVEAU'], $row['LBL_NIVEAUX']);
    }

    printf("var responsables = [];");

    // Retrieving responsible associated with the jury
    $query = "SELECT p.ID_PROFESSEUR, p.NOM, p.PRENOM
            FROM PROFESSEUR As p,encadrement AS e
            WHERE p.ID_PROFESSEUR =e.ID_PROFESSEUR
            AND e.ID_ENCADREMENT = '$id_encadrement'";
    $result = mysqli_query(CONNECTION, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        printf("
            responsables.push(['%d','%s %s']);
            ", $row['ID_PROFESSEUR'], $row['PRENOM'], $row['NOM']);
    }

    // Retrieving other responsible not associated with the jury
    $query = "SELECT p.ID_PROFESSEUR, p.NOM, p.PRENOM
              FROM PROFESSEUR AS p
              WHERE p.ID_PROFESSEUR NOT IN (
              SELECT e.ID_PROFESSEUR
              FROM encadrement AS e
              WHERE e.ID_ENCADREMENT = '$id_encadrement'
        )";
    $result = mysqli_query(CONNECTION, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        printf("
            responsables.push(['%d', '%s %s']);
            ", $row['ID_PROFESSEUR'], $row['PRENOM'], $row['NOM']);
    }

    printf("
                // Populate 'Niveau' dropdown
                populateDropdown1('Fil', niveaux);

                // Populate 'Encadrant' dropdown
                populateDropdown1('respo', responsables);
                
                setInitialDate();

                loadData();
            };
        </script>");
} catch (Exception $e) {
    echo "Error: ", $e->getMessage();
}
?>
