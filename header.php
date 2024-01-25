<?php

require_once "classes.php";
$database = new Database();
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
include "style.php";

if (isset($_SESSION['pseudo'])) {
    // Récupérez le pseudo de l'utilisateur
    $pseudo = $_SESSION['pseudo'];

    // Vérifiez si l'utilisateur est admin
    $redirectPage = ($pseudo == 'admin') ? 'admin.php' : 'index.php';
} else {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page d'accueil
    $redirectPage = 'index.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="container-fluid">
    <!-- NAVBAR -->
    <div class='navbar  bg-dark fixed-top rounded'>
    <h1 class='text-white mx-3'><a href="<?php echo $redirectPage; ?>">Ceci est notre blog</a></h1>
        <?php
        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION["pseudo"])) {
            echo "<p class='ppnav text-white'>Bienvenue, {$_SESSION['pseudo']}!</p>";
            echo "<button type='button' class='btn btn-danger rounded-pill mx-3 float-end'><a href='deco.php'
            class='text-white'>Deconnexion</a></button>
            </div>";
            
        } 

        if (!$userId) {

            echo"<div class='btn-group'>
                <button type='button' class='btn btn-success rounded-pill mx-1'><a href='inscription.php'
                    class='text-white'>S'inscrire</a></button>
                <button type='button' class='btn btn-success rounded-pill mx-3 float-end'><a href='connexion.php'
                    class='text-white'>Se connecter</a></button>
                </div>";    
        }
        ?>
    </div>
    <!-- FIN NAVBAR -->
    <br><br>   
</html>