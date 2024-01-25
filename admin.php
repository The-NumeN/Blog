<!-- Voir commentaire de la page sur la page index(ces sont quasiment les same pages) -->


<?php
session_start();
require_once "classes.php";
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$database = new Database();
$articleManager = new Article($database);
$articles = $articleManager->getAllArticles();

include "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Articles</title>
</head>
<body>
    <h2>Liste des Articles</h2>
    <!-- Affich tous les articles -->
    <?php foreach ($articles as $article) : ?>
        <div>
            <h3><?php echo $article['Titre']; ?></h3>
            <p><?php echo substr($article['Texte'], 0, 100) . '...'; ?></p>
            <a href="article_test.php?current_article_id=<?php echo $article['id_article']; ?>">Lire la suite</a>
            <a href="update.php?current_article_id=<?php echo $article['id_article']; ?>">Modifier</a>
            <a href="delete.php?current_article_id=<?php echo $article['id_article']; ?>">Supprimer</a>
        </div>
    <?php endforeach; ?>
    <a href="add_article.php">Ajouter un article</a>
</body>
</html>
