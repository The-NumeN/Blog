<?php
session_start();
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$articleId = isset($_GET['current_article_id']) ? $_GET['current_article_id'] : null;

if (!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include_once 'classes.php';

include "header.php";
include "style.php";

$database = new Database();
$articleHandler = new Article($database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $texte = $_POST['texte'];
    $datePub = date("Y-m-d H:i:s");

    // Vérif type de fichier
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = $_FILES['fic']['type'];

    if (!in_array($fileType, $allowedTypes)) {
        echo "Type de fichier non pris en charge. Veuillez utiliser une image JPEG, PNG ou GIF.";
        exit();
    }
    $imageName = $_FILES['fic']['name'];
    // Répertoire où stocker les images dans le dossier 
    $uploadDir = 'images/';

    // Chemin complet du fichier
    $imgPath = $uploadDir . $imageName;

    // Déplacer le fichier téléchargé vers le répertoire d'images
    move_uploaded_file($_FILES['fic']['tmp_name'], $imgPath);

    // Convertir la date en format compatible avec MySQL (si nécessaire)
    $datePub = date("Y-m-d H:i:s");

    $stmt = $database->connection->prepare("INSERT INTO Articles (Titre, Texte, Date_pub, img_path) VALUES (?, ?, ?, ?)");

    // Liaison des paramètres
    $stmt->bind_param("ssss", $titre, $texte, $datePub, $imgPath);

    if ($stmt->execute()) {
        header("Location: admin.php");
    } else {
        echo "Erreur lors de l'insertion de l'article : " . $stmt->error;
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <br><br>


    <h2 class='text-white'>Ajout de l'article</h2>
    <form class='size container' enctype="multipart/form-data" action="" method="post">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" required><br>

        <label for="texte">Texte :</label>
        <textarea name="texte" required></textarea><br>

        <label for="fic">Image :</label>
        <input type="file" name="fic" required><br>

        <button class='btn btn-success pill text-white' type="submit" value="Envoyer"> Envoyer</button>
    </form>


</body>

</html>