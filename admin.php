<!-- Voir commentaire de la page sur la page article(ces sont quasiment les same pages) -->


<?php
session_start();
require_once "classes.php";
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$isAdmin = isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == 'admin';
$articleId = isset($_GET['current_article_id']) ? $_GET['current_article_id'] : null;

if (!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$database = new Database();
$articleManager = new Article($database);
$commentaireManager = new Commentaire($database);
$articleDetails = $articleManager->getArticleDetails($articleId);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $texteCommentaire = $_POST["commentaire"];

    if (!empty($texteCommentaire) && !empty($userId)) {
        $commentaireManager->addComment($articleId, $userId, $texteCommentaire);
    } else {
        echo "<p>Tous les champs du formulaire doivent être remplis.</p>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comment_id"])) {
    $commentIdToDelete = $_POST["comment_id"];
    $commentToDelete = $commentaireManager->getCommentDetails($commentIdToDelete);
    if ($userId == $commentToDelete['id_utilisateur'] || $isAdmin) {
        $commentaireManager->deleteComment($commentIdToDelete);
        header("Location: " .$_SERVER["PHP_SELF"] ."?current_article_id=" .$articleId);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Article</title>
</head>
<body>
    <h2><?php echo isset($articleDetails['Titre']) ? $articleDetails['Titre'] : 'Titre non disponible'; ?></h2>
    <p><?php echo isset($articleDetails['Texte']) ? $articleDetails['Texte'] : 'Texte non disponible'; ?></p>

    <h3>Commentaires</h3>
    <?php
    $commentsForArticle = $commentaireManager->getAllCommentsWithUser($articleId);
    foreach ($commentsForArticle as $comment) : ?>
        <div>
            <p><strong><?php echo $comment['user_pseudo']; ?>:</strong> <?php echo $comment['text_comm']; ?></p>
            <small><?php echo $comment['date_heure']; ?></small>
            <?php
            if ($userId == $comment['id_utilisateur'] || $isAdmin) {
                echo '<form method="post" action="' . $_SERVER["PHP_SELF"] . '?current_article_id=' . $articleId . '">';
                echo '<input type="hidden" name="comment_id" value="' . $comment['id_commentaire'] . '">';
                echo '<input type="submit" value="Supprimer">';
                echo '</form>';
            }
            ?>
        </div>
        <hr>
    <?php endforeach; ?>

    <h2>Ajouter un commentaire</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?current_article_id=$articleId"; ?>">
        <label for="commentaire">Commentaire :</label><br>
        <textarea name="commentaire" rows="4" cols="50" required></textarea><br>
        <input type="submit" value="Ajouter le commentaire">
    </form>
    <p><a href="add_article.php">Ajouter un article</a></p>

</body>
</html>
