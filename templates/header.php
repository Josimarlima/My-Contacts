<?php
include_once("config/url.php");
include_once("config/process.php");

// Limpa a mensagem de erro
if (isset($_SESSION['msg'])) {
    $printMsg = $_SESSION['msg'];
    $_SESSION['msg'] = "";
}

?>
<!DOctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewpot" content="width=device-width, initial-scale=1.0">
    <title>My Contacts</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <!-- CSS -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/styles.css">
</head>

<body>
    <body>
        <header>
            <div class="navbar navbar-expand-lg navbar-dark d-flex justify-content-between align-items-center" id="home-link">
                <a class="navbar-brand" href="<?= $BASE_URL ?>">
                    <img src="<?= $BASE_URL ?>img/logo.svg" alt="Agenda">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto d-flex">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $BASE_URL ?>index.php">Agenda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $BASE_URL ?>create.php">Adicionar Contato</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>