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
<!-- Affichage articles -->
<?php foreach ($articles as $article) : ?>
<div>
    <h3><?php echo $article['Titre']; ?></h3>
    <p><?php echo substr($article['Texte'], 0, 100) . '...'; ?></p>
    <a href="article_test.php?current_article_id=<?php echo $article['id_article']; ?>">Lire la suite</a>
</div>
<?php endforeach; ?>
