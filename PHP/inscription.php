<?php
// Inclure le fichier de configuration de la base de données
include 'config.php';

// Vérifier si le formulaire d'inscription a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données soumises par le formulaire
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hacher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Préparer une requête SQL sécurisée pour insérer un nouvel utilisateur dans la base de données avec le mot de passe haché
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    // Exécuter la requête préparée
    if ($stmt->execute()) {
        // L'utilisateur a été inscrit avec succès
        // Rediriger l'utilisateur vers une page de connexion ou une autre page appropriée
        header('Location: index.php');
        exit;
    } else {
        // Une erreur s'est produite lors de l'inscription de l'utilisateur
        echo "Erreur : " . $stmt->error;
    }

    // Fermer la déclaration préparée
    $stmt->close();
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données soumises par le formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Préparer une requête SQL pour récupérer le mot de passe haché de l'utilisateur à partir de la base de données
    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Vérifier si l'utilisateur existe dans la base de données
    if ($stmt->num_rows == 1) {
        // Liaison des résultats
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Vérifier si le mot de passe saisi correspond au mot de passe haché dans la base de données
        if (password_verify($password, $hashed_password)) {
            // Démarrer une session PHP
            session_start();
            // Stocker l'ID de l'utilisateur dans la session
            $_SESSION['utilisateur_id'] = $stmt->insert_id;
            // Rediriger l'utilisateur vers une page de tableau de bord ou une autre page appropriée
            header('Location: dashboard.php');
            exit;
        } else {
            // Mot de passe incorrect
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        // Utilisateur non trouvé
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }

    // Fermer la déclaration préparée
    $stmt->close();
}
?>
