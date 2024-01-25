<?php
session_start();
require_once "classes.php";
include "header.php";
include "style.php";
if (!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] !== "admin") {
    header("Location: index.php");
    exit();
}

$database = new Database();
$articleManager = new Article($database);

// Récup id article à modifier
$articleId = isset($_GET['current_article_id']) ? $_GET['current_article_id'] : null;

// Vérif si l'ID de l'article est valide
if (!$articleId) {
    header("Location: admin.php");
    exit();
}

// Récup détails de l'article
$articleDetails = $articleManager->getArticleDetails($articleId);

// Traitement du formulaire de modification d'article
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newTitle = $_POST["new_title"];
    $newText = $_POST["new_text"];

    // Màj article
    $articleManager->updateArticle($articleId, $newTitle, $newText);
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Article</title>
</head>
<body>
    <h2>Modifier l'Article</h2>

    <form method="post" action="">
        <label for="new_title">Nouveau Titre :</label>
        <input type="text" name="new_title" value="<?php echo $articleDetails['Titre']; ?>" required><br>

        <label for="new_text">Nouveau Texte :</label>
        <textarea name="new_text" rows="4" cols="50" required><?php echo $articleDetails['Texte']; ?></textarea><br>

        <input type="submit" value="Modifier l'Article">
    </form>
</body>
</html>
