<?php

session_start();

if(!isset($_SESSION['zalogowany']))
{
    header('location: ../index.php');
    exit();
}

?>

<!doctype html>
<html lang="pl">
<head>
    <title>C.E.O Bank | Płatności</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="collapse" id="navbarToggleExternalContent">
    <div class="bg-light p-4" style="text-align: center;">
        <a class="dropdown-item" href="../pulpit/">Pulpit</a>
        <a class="dropdown-item" href="../platnosci/">Płatności</a>
        <a class="dropdown-item" href="../ustawienia/">Ustawienia</a>
        <a class="dropdown-item" href="../php/logout.php">Wyloguj</a>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-light nawigacja">
    <nav class="navbar navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <a class="navbar-brand" href="#">C<span class="sql">.</span>E<span class="sql">.</span>O Bank</a>
    <span class="navbar-text">
      Dzień dobry <span class="sql"><?php echo $_SESSION['imie'] ?></span>!
    </span>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="/platnosci/" role="button" aria-haspopup="true" aria-expanded="false">Konto osobiste</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item disabled" href="#">Historia płatności</a>
                    <a class="dropdown-item" href="/platnosci/">Przelewy</a>
                    <a class="dropdown-item" href="../ustawienia/">Ustawienia</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item disabled" href="#">Pomoc</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../php/logout.php"><i class="fas fa-sign-out-alt"></i> Wyloguj</a>
            </li>
        </ul>
    </div>
</nav>

<div class="nav flex-column nav-pills menuleftblock">
    <a class="nav-link menuleft" href="../pulpit/"><i class="fas fa-align-justify"></i> Mój pulpit</a>
    <a class="nav-link menuleft active" href="../platnosci/"><i class="far fa-address-card"></i> Płatności</a>
    <a class="nav-link menuleft disabled" href="#"><i class="fas fa-money-check-alt"></i> Rachunki</a>
    <a class="nav-link menuleft disabled" href="#"><i class="far fa-bell"></i> Powiadomienia</a>
    <a class="nav-link menuleft disabled" href="#"><i class="far fa-envelope"></i> Wiadomości</a>
    <a class="nav-link menuleft" href="../ustawienia/"><i class="fas fa-wrench"></i> Ustawienia</a>
</div>

<main id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 przelew">
                <div id="przelew" style="text-align: center">
                    <p>Przelew <b style="color: red">nie został</b> wykonany.<br>Błąd systemu.</p>
                    <br>
                    <a href="../pulpit/">< Powrót</a>
                </div>
            </div>
        </div>

    </div>
</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
</body>
</html>

