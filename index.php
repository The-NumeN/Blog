<?php
session_start();
require_once "classes.php";
$database = new Database();
$articleManager = new Article($database);
$articles = $articleManager->getAllArticles();
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

?>
<?php 
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Liste des Articles</title>
</head>
    <!-- CONTAINER SITE -->
    <div class='container bg-secondary my-5 border rounded text-white'>

        <!-- ARTICLE A LA UNE -->
        <div class='container-fluid bg-dark rounded'>
            <div class='container justify-content-center p-3 my-5 rounded'>
                <div class='alaune'>
                    <h2 class='my-3'>Liste des Articles</h2>

                    <!-- Affich tous les articles -->
                    <?php foreach ($articles as $article): ?>
                        <div>
                            <h3>
                                <?php echo $article['Titre']; ?>
                            </h3>
                            <p>
                                <?php echo substr($article['Texte'], 0, 100) . '...'; ?>
                            </p>
                            <a href="article_test.php?current_article_id=<?php echo $article['id_article']; ?>">Lire la
                                suite</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!-- FIN ARTICLE A LA UNE -->

        <!-- DEBUT DES AUTRES ARTICLES -->
        <div class='container bg-dark p-3 my-5 border rounded'>
            <!-- ALIGNEMENT DES CARTES AUTRES ARTICLES -->
            <div class='row'>
                <div class='col'>
                    <a href="" target="_top">
                        <div class='hover_card'>
                            <div class='card'>
                                <div class='card-header bg-primary'>
                                    <p class='display-6'> titre articles</p>
                                </div>
                                <div class='card-body'>
                                    <p>début de texte article</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class='col'>
                    <a href="" target="_top">
                        <div class='hover_card'>
                            <div class='card'>
                                <div class='card-header bg-warning'>
                                    <p class='display-6'> titre articles</p>
                                </div>
                                <div class='card-body'>
                                    <p>début de texte article</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class='col'>
                    <a href="" target="_top">
                        <div class='hover_card'>
                            <div class='card'>
                                <div class='card-header bg-success'>
                                    <p class='display-6'> titre articles</p>
                                </div>
                                <div class='card-body'>
                                    <p>début de texte article</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class='col'>
                    <a href="" target="_top">
                        <div class='hover_card'>
                            <div class='card'>
                                <div class='card-header bg-danger'>
                                    <p class='display-6'> titre articles</p>
                                </div>
                                <div class='card-body'>
                                    <p>début de texte article</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
            <!-- FIN DES CARTES ARTICLES -->
        </div>
    </div>
    <!-- FIN CONTAINER SITE -->
</body>
<footer>
    <div class="container-fluid bg-secondary border rounded py-1 fixed-bottom">
        <div class="row justify-content-center">
            <div class="col-lg-3 item social">
                <p class="copyright text-white"> Babacar Stive & Paul</p>
            </div>
        </div>
    </div>
</footer>

</html>