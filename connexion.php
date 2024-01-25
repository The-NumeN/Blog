<?php
session_start();

require_once 'classes.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $pseudo = $_POST['pseudo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $database = new Database();
    $userManager = new Utilisateur($database);

    $user = $userManager->getUserByUsername($pseudo);

    if ($user && $password) {
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
        // var_dump($user); 
        // var_dump(password_verify($password, $user['passwd'])); 
    }
}    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <?php if (isset($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="pseudo">Pseudo:</label>
        <input type="text" name="pseudo" required><br>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" required><br>
        <input type="submit" name="login" value="Se connecter">
    </form>
</body>
</html>
