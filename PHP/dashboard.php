<?php
// Vérifier si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['utilisateur_id'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header('Location: login.html');
    exit;
}

// Inclure le fichier de configuration de la base de données
include 'config.php';

// Récupérer les informations de l'utilisateur à partir de la base de données
$user_id = $_SESSION['utilisateur_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 24px;
    color: #333;
}

p {
    font-size: 16px;
    color: #666;
}

a {
    display: inline-block;
    margin-right: 10px;
    text-decoration: none;
    color: #fff;
    background-color: #007bff;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

a:hover {
    background-color: #0056b3;
}

a.logout {
    background-color: #dc3545;
}

a.logout:hover {
    background-color: #c82333;
}

    </style>
</head>
<body>
    <h1>Bienvenue sur votre tableau de bord, <?php echo $user['username']; ?> !</h1>
    <p>Votre adresse e-mail : <?php echo $user['email']; ?></p>
    <p>Vous pouvez gérer votre profil et publier du contenu depuis ici.</p>
    <a href="profil.php">Gérer mon profil</a>
    <a href="publier.php">Publier du contenu</a>
    <br>
    <a href="logout.php">Déconnexion</a>
</body>
</html>
