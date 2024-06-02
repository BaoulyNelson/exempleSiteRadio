<?php
// Inclure le fichier de configuration de la base de données
include 'config.php';

// Vérifier si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['utilisateur_id'])) {
    header("Location: login.html");
    exit;
}

// Récupérer les données soumises par le formulaire
$title = $_POST['title'];
$content = $_POST['content'];
$user_id = $_SESSION['utilisateur_id'];

// Insérer l'article dans la base de données
$sql = "INSERT INTO articles (user_id, title, content) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $user_id, $title, $content);
$stmt->execute();
$stmt->close();

// Rediriger l'utilisateur vers une page de confirmation ou une autre page appropriée
header('Location: dashboard.php');
exit;
?>


<?php
// Inclure le fichier de configuration de la base de données
include 'config.php';

// Sélectionner tous les articles de la base de données
$sql = "SELECT * FROM articles";
$result = $conn->query($sql);

// Afficher les articles
while ($row = $result->fetch_assoc()) {
    echo "<h2>" . $row['title'] . "</h2>";
    echo "<p>" . $row['content'] . "</p>";
}
?>
