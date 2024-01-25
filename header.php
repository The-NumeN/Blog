<?php

require_once "classes.php";
$database = new Database();
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body class="container-fluid bg-dark">
    <!-- NAVBAR -->
    <div class='navbar  bg-secondary fixed-top rounded mx-3'>
        <h1 class='text-white mx-3'> Ceci est notre Blog</h1>
        <?php
        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION["pseudo"])) {
            echo "<p class='text-white'>Bienvenue, {$_SESSION['pseudo']}!</p>";
            echo "<button type='button' class='btn btn-danger rounded-pill mx-3 float-end'><a href='deco.php'
            class='text-white'>Deconnexion</a></button>
            </div>";
            
        } else {
            echo "<p class='text-white'>Non connecté</p>";
        }

        if (!$userId) {
            // echo '<p><a href="inscription.php">Inscription</a></p>';
            // echo '<p><a href="connexion.php">Connexion</a></p>';
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