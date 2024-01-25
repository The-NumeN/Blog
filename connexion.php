<?php
session_start();

require_once 'classes.php';

include "header.php";
include "style.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];  // Ne pas hacher le mot de passe lors de la connexion

    $database = new Database();
    $userManager = new Utilisateur($database);

    $user = $userManager->getUserByUsername($pseudo);

    if ($user && password_verify($password, $user['passwd'])) {
        // Connexion réussie, enregistrez l'ID utilisateur dans la session
        $_SESSION['user_id'] = $user['id_utilisateur'];
        $_SESSION['pseudo'] = $user['pseudo'];

        $articleId = isset($_GET['current_article_id']) ? $_GET['current_article_id'] : null;

        if ($articleId) {
            header("Location: article.php?current_article_id=$articleId");
        } else {
            // Rediriger vers la page d'administration si l'utilisateur est un administrateur
            if ($user['pseudo'] == "admin") {
                header("Location: admin.php");
                exit();
            } else {
                header("Location: index.php");
            }
        }
        exit();
    } else {
        $error = "Identifiants incorrects. Veuillez réessayer.";
        // var_dump($pseudo);
        // var_dump($password);
        // var_dump($user && password_verify($password, $user['passwd']));
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <br><br>
    <div class='container bg-secondary border rounded'>
        <h2 class='text-white'>Connexion</h2>
        <?php if (isset($error)): ?>
            <p style="color: red;">
                <?php echo $error; ?>
            </p>
        <?php endif; ?>
        <form class='size container' method="POST" action="">

            <label for="pseudo">Pseudo:</label>
            <input type="text" name="pseudo" required><br>
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" required><br>
            <input type="submit" class=" text-white btn btn-success rounded-pill" name="login" value="Se connecter">

        </form>
    </div>
</body>

</html>