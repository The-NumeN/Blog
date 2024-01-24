<?php
session_start();

require_once 'classes.php';
$articleId = isset($_GET['id_article']) ? $_GET['id_article'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    // Récup form
    $pseudo = $_POST['pseudo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $database = new Database();
    $userManager = new Utilisateur($database);

    // Vérifie si l'utilisateur existe déjà
    $existingUser = $userManager->getUserByUsername($pseudo);

    if ($existingUser) {
        $error = "Ce pseudo est déjà utilisé. Choisissez un autre.";
    } else {
        $userId = $userManager->addUser($pseudo, $password, $email);

        // Vérifie si l'add du user a réussi
        if ($userId) {
            // Enregistre les info du u dans la session
            $_SESSION['user_id'] = $userId;
            $_SESSION['pseudo'] = $pseudo;

            $articleId = isset($_GET['current_article_id']) ? $_GET['current_article_id'] : null;

            if ($articleId) {
                header("Location: article.php?current_article_id=$articleId");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Erreur lors de l'inscription. Veuillez réessayer.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <?php if (isset($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="pseudo">Pseudo:</label>
        <input type="text" name="pseudo" required><br>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <input type="submit" name="register" value="S'inscrire">
    </form>
</body>
</html>
