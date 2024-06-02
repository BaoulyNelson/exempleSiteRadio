<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['utilisateur_id'])) {
    // Affichage d'un message de bienvenue
    echo "<h1>Bienvenue sur la page d'accueil, utilisateur !</h1>";

    // Vous pouvez également inclure d'autres fonctionnalités ou informations spécifiques à la page d'accueil

    // Lien pour se déconnecter
    echo "<p><a href='logout.php'>Se déconnecter</a></p>";
} else {
    // Rediriger l'utilisateur vers la page de connexion
    header("Location: login.html");
    exit;
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données soumises par le formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Préparer une requête SQL pour récupérer le mot de passe haché de l'utilisateur à partir de la base de données
    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Vérifier si l'utilisateur existe dans la base de données
    if ($stmt->num_rows == 1) {
        // Liaison des résultats
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Vérifier si le mot de passe saisi correspond au mot de passe haché dans la base de données
        if (password_verify($password, $hashed_password)) {
            // Démarrer une session PHP
            session_start();
            // Stocker l'ID de l'utilisateur dans la session
            $_SESSION['utilisateur_id'] = $user_id;
            // Rediriger l'utilisateur vers la page d'accueil
            header('Location: index.php');
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
