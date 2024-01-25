<?php
session_start();
require_once "classes.php";
$database = new Database();
$articleManager = new Article($database);
$articles = $articleManager->getAllArticles();
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>
<!-- Barre de navigation -->

<body class='container-fluid bg-dark'>
    <div class='navbar  bg-secondary fixed-top rounded mx-3'>
        <h1 class='text-white mx-3'> Ceci est notre Blog</h1>
        <button type="button" class="btn btn-success rounded-pill mx-3 float-end" onclick=> se connecter</button>
    </div>
    <br> <br>
    <!-- le reste du site -->

    <!-- container du site -->
    <div class='container bg-secondary my-5 border rounded'>
        <!-- Article à la une -->
        <a href=""target="_top">
            <div class='container-fluid bg-dark rounded'>
                <p class='text-white my-5 display-4'> Article à la Une</p>
                <div class='container p-3 my-5 rounded'>
                    <div class='alaune'>
                        <div class='text-white'>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem unde, quaerat,
                                recusandae minus quo deleniti a accusantium blanditiis ipsa itaque accusamus veniam
                                perspiciatis quae, repellendus nostrum vero animi aspernatur? Sint?</p><br>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem unde, quaerat,
                                recusandae minus quo deleniti a accusantium blanditiis ipsa itaque accusamus veniam
                                perspiciatis quae, repellendus nostrum vero animi aspernatur? Sint?</p><br>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem unde, quaerat,
                                recusandae minus quo deleniti a accusantium blanditiis ipsa itaque accusamus veniam
                                perspiciatis quae, repellendus nostrum vero animi aspernatur? Sint?</p><br>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem unde, quaerat,
                                recusandae minus quo deleniti a accusantium blanditiis ipsa itaque accusamus veniam
                                perspiciatis quae, repellendus nostrum vero animi aspernatur? Sint?</p><br>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem unde, quaerat,
                                recusandae minus quo deleniti a accusantium blanditiis ipsa itaque accusamus veniam
                                perspiciatis quae, repellendus nostrum vero animi aspernatur? Sint?</p><br>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem unde, quaerat,
                                recusandae minus quo deleniti a accusantium blanditiis ipsa itaque accusamus veniam
                                perspiciatis quae, repellendus nostrum vero animi aspernatur? Sint?</p><br>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem unde, quaerat,
                                recusandae minus quo deleniti a accusantium blanditiis ipsa itaque accusamus veniam
                                perspiciatis quae, repellendus nostrum vero animi aspernatur? Sint?</p><br>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem unde, quaerat,
                                recusandae minus quo deleniti a accusantium blanditiis ipsa itaque accusamus veniam
                                perspiciatis quae, repellendus nostrum vero animi aspernatur? Sint?</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <!-- fin article à la une -->
        <p class='text-white my-5 display-6'> Autres articles</p>

        <!-- début autres articles -->
        <div class='container bg-dark p-3 my-5 border rounded'>
            <!-- alignements des cartes articles -->
            <div class='row'>
                <div class='col'>
                    <a href="" target="_top">
                        <div class='hover_card'>
                            <div class='card'>
                                <div class='card-header bg-primary'>
                                    <p class='display-6'> titre articles</p>
                                </div>
                                <div class='card-body'>
                                    <p>début de texte article</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class='col'>
                    <a href=""target="_top">
                        <div class='hover_card'>
                            <div class='card'>
                                <div class='card-header bg-warning'>
                                    <p class='display-6'> titre articles</p>
                                </div>
                                <div class='card-body'>
                                    <p>début de texte article</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class='col'>
                    <a href=""target="_top">
                        <div class='hover_card'>
                            <div class='card'>
                                <div class='card-header bg-success'>
                                    <p class='display-6'> titre articles</p>
                                </div>
                                <div class='card-body'>
                                    <p>début de texte article</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class='col'>
                    <a href=""target="_top">
                        <div class='hover_card'>
                            <div class='card'>
                                <div class='card-header bg-danger'>
                                    <p class='display-6'> titre articles</p>
                                </div>
                                <div class='card-body'>
                                    <p>début de texte article</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
            <!-- fin des cartes articles -->
        </div>
    </div>
    <!-- fin container site -->
    <br><br>
</body>

<footer>
    <div class="container-fluid bg-secondary border rounded py-1">
        <div class="row justify-content-center">
            <div class="col-lg-3 item social">
                <p class="copyright text-white"> Babacar Stive & Paul</p>
            </div>
        </div>
    </div>
</footer>

</html>