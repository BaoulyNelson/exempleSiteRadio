<?php
// Inclure le fichier de configuration de la base de données
include 'config.php';

// Récupérer les données d'articles depuis la base de données
$sql = "SELECT * FROM articles ORDER BY date_creation DESC";
$result = $conn->query($sql);

// Vérifier s'il y a des résultats
if ($result->num_rows > 0) {
    // Afficher les articles un par un
    while ($row = $result->fetch_assoc()) {
        echo "<div class='article'>";
        echo "<div class='content'>";
        echo "<h2>" . $row['titre'] . "</h2>";
        echo "<p>" . $row['contenu'] . "</p>";
        echo "</div>";
        echo "<img src='" . $row['image'] . "' alt='Image de l'article'>";
        echo "</div>";
    }
} else {
    // Aucun article trouvé
    echo "Aucun article trouvé.";
}
?>

<?php
// Récupérer les données des vidéos depuis la base de données
$sql_videos = "SELECT * FROM videos ORDER BY date_creation DESC";
$result_videos = $conn->query($sql_videos);

// Vérifier s'il y a des vidéos
if ($result_videos->num_rows > 0) {
    // Afficher les vidéos un par un
    while ($row_video = $result_videos->fetch_assoc()) {
        echo "<div class='video'>";
        echo "<video controls>";
        echo "<source src='" . $row_video['url'] . "' type='video/mp4'>";
        echo "Votre navigateur ne supporte pas la lecture de vidéos.";
        echo "</video>";
        echo "</div>";
    }
} else {
    // Aucune vidéo trouvée
    echo "Aucune vidéo trouvée.";
}

// Récupérer les données des images depuis la base de données
$sql_images = "SELECT * FROM images ORDER BY date_creation DESC";
$result_images = $conn->query($sql_images);

// Vérifier s'il y a des images
if ($result_images->num_rows > 0) {
    // Afficher les images une par une
    while ($row_image = $result_images->fetch_assoc()) {
        echo "<div class='image'>";
        echo "<img src='" . $row_image['url'] . "' alt='" . $row_image['alt'] . "'>";
        echo "</div>";
    }
} else {
    // Aucune image trouvée
    echo "Aucune image trouvée.";
}
?>
