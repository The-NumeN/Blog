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
    <title>PSB_Blog</title>
</head>

<body>
    <!-- CONTAINER SITE -->
    <div class='container bg-secondary my-5 border rounded text-white'>
        <!-- ARTICLE A LA UNE -->
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
        </div>
        <!-- FIN ARTICLE A LA UNE -->

        <!-- DEBUT DES AUTRES ARTICLES -->
        <h2 class='my-3'>Autres articles</h2>
        <div class='container bg-dark p-3 my-5 border rounded'>
        
            <div class="row">
                <!-- ALIGNEMENT DES CARTES AUTRES ARTICLES -->
                <?php foreach ($articles as $article): ?>
                    <div class='col-xl-4 col-lg-4'>
                        <a href="article_test.php?current_article_id=<?php echo $article['id_article']; ?>" target="_top">
                            <div class='hover_card'>
                                <div class='card'>
                                    <div class='card-header bg-primary'>
                                        <p class='display-6'>
                                            <?php echo $article['Titre']; ?>
                                        </p>
                                    </div>
                                    <div class='card-body'>
                                        <p>
                                            <?php echo substr($article['Texte'], 0, 100) . '...'; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <br>
                    </div>

                <?php endforeach; ?>
                <!-- FIN DES CARTES ARTICLES -->
            </div>
        </div>
    </div>
    <!-- FIN CONTAINER SITE -->
</body>
<footer class='fixed-bottom'>
    <div class="container-fluid bg-dark border rounded py-1">
        <div class="row justify-content-center">
            <div class="col-lg-3 item social">
                <p class="copyright text-white"> Babacar Stive & Paul</p>
            </div>
        </div>
    </div>
</footer>

</html>