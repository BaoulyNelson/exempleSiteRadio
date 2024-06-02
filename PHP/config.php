<?php
// Paramètres de connexion à la base de données
$servername = "localhost"; // Nom du serveur
$username = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données
$database = "login"; // Nom de la base de données

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $database);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Fonction pour exécuter une requête préparée avec des déclarations préparées
function executeQuery($sql, $params = []) {
    global $conn;
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        return false;
    }
    if (!empty($params)) {
        $types = str_repeat('s', count($params)); // Assume que tous les paramètres sont des chaînes de caractères
        $stmt->bind_param($types, ...$params);
    }
    $result = $stmt->execute();
    if ($result === false) {
        return false;
    }
    return $stmt->get_result();
}
?>
