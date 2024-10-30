<?php
// Fichier de connexion à la base de données

// Paramètres de connexion
$host = "sql310.infinityfree.com"; // Hôte
$db_user = "if0_37599739"; // Nom d'utilisateur de la base de données
$db_pass = "hvkeB0d1z0pp"; // Mot de passe de la base de données
$db_name = "if0_37599739_siga"; // Nom de la base de données

// Création de la connexion
$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
?>
