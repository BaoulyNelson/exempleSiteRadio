<?php
// Inclure le fichier de configuration de la base de données
include 'config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données soumises par le formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Préparer une requête SQL sécurisée pour vérifier les informations de connexion
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si des données correspondent aux informations de connexion
    if ($result->num_rows == 1) {
        // Récupérer les informations de l'utilisateur
        $user = $result->fetch_assoc();
        // Vérifier si le mot de passe est correct
        if (password_verify($password, $user['password'])) {
            // Démarrer une session PHP
            session_start();
            // Stocker l'ID de l'utilisateur dans la session
            $_SESSION['utilisateur_id'] = $user['id'];
            // Rediriger l'utilisateur vers une page de tableau de bord ou une autre page sécurisée
            header('Location: dashboard.php');
            exit;
        } else {
            // Mot de passe incorrect
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        // Nom d'utilisateur incorrect
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }

    // Fermer la déclaration préparée
    $stmt->close();
}
?>
