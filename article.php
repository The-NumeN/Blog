<?php
session_start();
require_once "classes.php";
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Recup l'ID de l'article et pseudo
$articleId = isset($_GET['current_article_id']) ? $_GET['current_article_id'] : null;
$isAdmin = isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == 'admin';

$database = new Database();
$articleManager = new Article($database);
$commentaireManager = new Commentaire($database);

// Recup info article
$articleDetails = $articleManager->getArticleDetails($articleId);

// Vérif formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $texteCommentaire = $_POST["commentaire"];

    if (!empty($texteCommentaire) && !empty($userId)) {
        // Ajouter le commentaire à la base de données
        $commentaireManager->addComment($articleId, $userId, $texteCommentaire);
    } else {
        echo "<p>Tous les champs du formulaire doivent être remplis.</p>";
    }
}

// Vérif formulaire de suppression
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comment_id"])) {
    $commentIdToDelete = $_POST["comment_id"];
    
    // Vérif si user peut supp le comment
    $commentToDelete = $commentaireManager->getCommentDetails($commentIdToDelete);
    if ($userId == $commentToDelete['id_utilisateur'] || $isAdmin) {
        // Supp comment
        $commentaireManager->deleteComment($commentIdToDelete);
        // Recharge la page
        header("Location: " . $_SERVER["PHP_SELF"] . "?current_article_id=" . $articleId);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
</head>
<body>
    <h2><?php echo isset($articleDetails['Titre']) ? $articleDetails['Titre'] : 'Titre non disponible'; ?></h2>
    <?php
    // Affiche l'image si le chemin de l'image est disponible
    if (isset($articleDetails['img_path']) && !empty($articleDetails['img_path'])) {
        echo '<img src="' .$articleDetails['img_path'] .'" alt="Image de l\'article" width="100px">';
    }
    ?>
    <p><?php echo isset($articleDetails['Texte']) ? $articleDetails['Texte'] : 'Texte non disponible'; ?></p>

    <h3>Commentaires</h3>

    <?php
    // Récup tous les commentaires de l'article
    $commentsForArticle = $commentaireManager->getAllCommentsWithUser($articleId);

    // Affiche comments
    foreach ($commentsForArticle as $comment) : ?>
        <div>
            <p><strong><?php echo $comment['user_pseudo']; ?>:</strong> <?php echo $comment['text_comm']; ?></p>
            <small><?php echo $comment['date_heure']; ?></small>

            <?php
            // Ajout un form de suppr pour chaque commentaire
            if ($userId == $comment['id_utilisateur'] || $isAdmin) {
                echo '<form method="post" action="' .$_SERVER["PHP_SELF"]. '?current_article_id=' .$articleId. '">';
                echo '<input type="hidden" name="comment_id" value="' .$comment['id_commentaire']. '">';
                echo '<input type="submit" value="Supprimer">';
                echo '</form>';
            }
            ?>
        </div>
        <hr>
    <?php endforeach; ?>

    <h2>Ajouter un commentaire</h2>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ."?current_article_id=$articleId"; ?>">
        <label for="commentaire">Commentaire :</label><br>
        <textarea name="commentaire" rows="4" cols="50" required></textarea><br>
        <input type="submit" value="Ajouter le commentaire">
    </form>
</body>
</html>

