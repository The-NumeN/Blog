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
    <h2 class='my-3'>Article à la une</h2>
        <div class='container-fluid bg-dark rounded'>
        
            <div class='container p-3 my-5'>

            
                <div class='alaune'>
                    <!-- Affich tous les articles -->
                    <?php if (!empty($articles)) {
                        $randomKey = array_rand($articles);
                        $randomArticle = $articles[$randomKey];
                    ?>

                        <h3>
                            <?php echo $randomArticle['Titre']; ?>
                        </h3>
                        <p>
                            <?php echo ($randomArticle['Texte']); ?>
                        </p>
                </div>
            </div>
                <?php
                    }
                ?>
        </div><br>
        <h2>Autres articles</h2>
        <!-- Affich tous les articles -->
        <div class='container p-3 my-5 '>
            <div class="row text-white">
                <!-- ALIGNEMENT DES CARTES AUTRES ARTICLES -->
                <?php foreach ($articles as $article): ?>
                    <div class='col-xl-4 col-lg-4'>
                        <a href="article_test.php?current_article_id=<?php echo $article['id_article']; ?>" target="_top">
                            <div class='hover_card'>
                                <div class='card'>
                                    <div class='card-header bg-success text-white'>
                                        <p class='display-6'>
                                            <?php echo $article['Titre']; ?>
                                        </p>
                                    </div>
                                    <div class='card-body text-white'>
                                        <p>
                                            <?php echo substr($article['Texte'], 0, 100) . '...'; ?>
                                        <div class="btn-group pill text-white">
                                            <a href="article_test.php?current_article_id=<?php echo $article['id_article']; ?>" class="btn btn-success pill">Lire la suite</a>
                                            <a href="update.php?current_article_id=<?php echo $article['id_article']; ?>" class="btn btn-warning pill">Modifier</a>
                                            <a href="delete.php?current_article_id=<?php echo $article['id_article']; ?>" class="btn btn-danger pill">Supprimer</a>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <br><br>
                    </div>
                <?php endforeach; ?>
                <!-- FIN DES CARTES ARTICLES -->
            </div>
            <br><br> 
        <a href="add_article.php" class='btn btn-success pill text-white'>Ajouter un article</a>
        </div>
        
    </div>
</body>

</html>