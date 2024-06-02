<?php
// Génération d'un jeton de réinitialisation sécurisé
$reset_token = bin2hex(random_bytes(32)); // Génère un jeton aléatoire de 32 octets et le convertit en une chaîne hexadécimale

// Enregistrement du jeton dans la base de données avec un horodatage d'expiration

// Envoi d'un e-mail à l'utilisateur avec un lien de réinitialisation contenant le jeton
$reset_link = "https://example.com/reset-password?token=$reset_token";
$to = $email;
$subject = "Réinitialisation de mot de passe";
$message = "Bonjour,\n\nVous avez demandé une réinitialisation de votre mot de passe. Cliquez sur le lien suivant pour choisir un nouveau mot de passe :\n$reset_link";
$headers = "From: votre_email@example.com";
mail($to, $subject, $message, $headers);

// Message de confirmation pour l'utilisateur
echo "<script>alert('Un lien de réinitialisation de mot de passe a été envoyé à votre adresse e-mail.');</script>";
echo "<script>window.location.href='login.html';</script>"; // Rediriger l'utilisateur vers la page de connexion après avoir envoyé le lien de réinitialisation
?>
