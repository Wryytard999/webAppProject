<?php

// Définition des constantes pour la connexion à la base de données
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'projet web 2.0');

// Connexion à la base de données en utilisant les constantes
define('CONNECTION', mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME));

// Vérification de la connexion
if (!CONNECTION) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Utilisez la constante CONNECTION pour exécuter des requêtes SQL ou d'autres opérations sur la base de données


