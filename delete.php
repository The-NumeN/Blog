<?php
session_start();
require_once "classes.php";

// Vérif si user co = admin
if (!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] !== "admin") {
    header("Location: index.php");
    exit();
}

$database = new Database();
$articleManager = new Article($database);

// Récup l'ID de l'article à supprimer
$articleId = isset($_GET['current_article_id']) ? $_GET['current_article_id'] : null;

// Vérif si l'ID de l'article est valide
if ($articleId) {
    // Supprimer les commentaires associés
    $commentaireManager = new Commentaire($database);
    $commentaireManager->deleteCommentsForArticle($articleId);

    // Supprimer l'article
    $articleManager->deleteArticle($articleId);
}

header("Location: admin.php");
exit();
?>
