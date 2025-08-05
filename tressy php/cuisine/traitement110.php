<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sécurisation et récupération des données
    $nom = htmlspecialchars(trim($_POST["nom"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"]));

    // Validation simple
    if (!empty($nom) && !empty($email) && !empty($message)) {

        // ➕ Enregistrer le message dans un fichier (ou dans une base de données plus tard)
        $ligne = date("Y-m-d H:i:s") . " | Nom: $nom | Email: $email | Message: $message\n";
        file_put_contents("messages.txt", $ligne, FILE_APPEND);

        // ➕ Option : Envoyer un email (désactivé ici)
        // mail("tonemail@exemple.com", "Message de $nom", $message, "From: $email");

        echo "<h2>Merci pour votre message, $nom !</h2>";
        echo "<p><a href='contact.html'>Retour</a></p>";
    } else {
        echo "<h2>Veuillez remplir tous les champs.</h2>";
        echo "<p><a href='contact.html'>Retour</a></p>";
    }
} else {
    // Redirection si on accède à la page sans formulaire
    header("Location: contact.html");
    exit;
}
?>