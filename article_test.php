<?php
session_start();
$articleId = isset($_GET['current_article_id']) ? $_GET['current_article_id'] : null;

if (isset($_SESSION['user_id'])) {
    // Utilisateur connecté, rediriger vers la page article
    header("Location: article.php?current_article_id=$articleId");
    exit();
} else {
    // Utilisateur non connecté, rediriger vers la page de connexion ou d'inscription
    header("Location: connexion.php?current_article_id=$articleId");
    exit();
}

