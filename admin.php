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
include "style.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Articles</title>
</head>

<body>
    <br><br>
    <div class='container bg-secondary border rounded text-white'>
        <h2>Liste des Articles</h2>
        <!-- Affich tous les articles -->
        <div class='container bg-dark p-3 my-5 border rounded'>
            <div class="row text-white">
                <!-- ALIGNEMENT DES CARTES AUTRES ARTICLES -->
                <?php foreach ($articles as $article): ?>
                    <div class='col-xl-4 col-lg-4'>
                        <a href="article_test.php?current_article_id=<?php echo $article['id_article']; ?>" target="_top">
                            <div class='hover_card'>
                                <div class='card'>
                                    <div class='card-header bg-primary text-white'>
                                        <p class='display-6'>
                                            <?php echo $article['Titre']; ?>
                                        </p>
                                    </div>
                                    <div class='card-body text-white'>
                                        <p>
                                            <?php echo substr($article['Texte'], 0, 100) . '...'; ?>
                                        <div class="btn-group pill text-white">
                                            <a href="article_test.php?current_article_id=<?php echo $article['id_article']; ?>" class="btn btn-success pill">Lire la suite</a>
                                            <a href="update.php?current_article_id=<?php echo $article['id_article']; ?>" class="btn btn-success pill">Modifier</a>
                                            <a href="delete.php?current_article_id=<?php echo $article['id_article']; ?>" class="btn btn-success pill">Supprimer</a>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
                <!-- FIN DES CARTES ARTICLES -->
            </div>
        <a href="add_article.php" class='btn btn-success pill text-white'>Ajouter un article</a>
        </div>
        
    </div>
</body>

</html>