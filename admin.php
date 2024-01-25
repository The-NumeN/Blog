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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Articles</title>
</head>
<body>
    <div>
        <?php
        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION["pseudo"])) {
            echo "<p>Bienvenue, {$_SESSION['pseudo']}!</p>";
            echo "<a href='deco.php'>Déconnexion</a>";
        } else {
            echo "<p>Non connecté</p>";
        }
        
        if (!$userId) {
            echo '<p><a href="inscription.php">Inscription</a></p>';
            echo '<p><a href="connexion.php">Connexion</a></p>';
        }
    ?>
    </div>
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
</body>
</html>
