<?php

session_start();

if(!isset($_SESSION['zalogowany']))
{
    header('location: index.php');
    exit();
}
?>


<!doctype html>
<html lang="pl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>C.E.O Bank | Mój pulpit</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">C<span class="sql">.</span>E<span class="sql">.</span>O Bank</a>
    <span class="navbar-text">
      Dzień dobry <span class="sql"><?php echo $_SESSION['imie'] ?></span>!
    </span>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Konto osobiste</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item disabled" href="#">Historia płatności</a>
                    <a class="dropdown-item disabled" href="#">Kredyty i lokaty</a>
                    <a class="dropdown-item disabled" href="#">Ustawienia</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item disabled" href="#">Pomoc</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Wyloguj</a>
            </li>
        </ul>
    </div>
</nav>

<div class="nav flex-column nav-pills menuleftblock">
    <a class="nav-link active menuleft" href="account.php"><i class="fas fa-align-justify"></i> Mój pulpit</a>
    <a class="nav-link menuleft" href="pay.php"><i class="far fa-address-card"></i> Płatności</a>
    <a class="nav-link menuleft disabled" href="#"><i class="fas fa-money-check-alt"></i> Rachunki</a>
    <a class="nav-link menuleft disabled" href="#"><i class="far fa-bell"></i> Powiadomienia</a>
    <a class="nav-link menuleft disabled" href="#"><i class="far fa-envelope"></i> Wiadomości</a>
    <a class="nav-link menuleft disabled" href="#"><i class="fas fa-wrench"></i> Ustawienia</a>
</div>


<main id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 pieniadze">

                <div id="pieniadze">
                    Dostępne środki: <span class="sql"><?php echo $_SESSION['pieniadze'] ?></span> PLN
                </div>

            </div>
            <div class="col-md-8 rachunki">

                <div id="rachunki">
                    Numer konta: <span class="sql"><?php echo $_SESSION['nrkonta'] ?></span>

                    <span class="textmakeprzelew" style="float: right; font-size: 14px;"><a href="pay.php">Zrób przelew ></a></span>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-4 lokaty">

                <div id="lokaty">
                    Lokaty: <span class="sql">--</span>
                </div>

            </div>
            <div class="col-md-4 wiadomosci">

                <div id="wiadomosci">
                    Wiadomości: <span class="sql">0</span>
                </div>

            </div>
            <div class="col-md-4 informacje">

                <div style="font-size: 13px" id="informacje">
                <span>Zapoznaj się z bogatą ofertą C.E.O Bank w zakresie kart płatniczych i kredytowych.

                    <span class="sql"><a href="#">Sprawdź ofertę ></a></span></span>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-sm alertdiv">
                <div class="alert alert-success alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="alert-heading">Powiadomienie!</h4>
                    <p>Drogi kliencie! Prosimy o sprawdzenie, czy Twoje hasło jest na bieżąco aktualizowane. Pragniemy poinformować, że comiesięczna zmiana hasła zmniejsza włamania na konto o 90%!</p>
                    <hr>
                    <p class="mb-0">Aby przejść do zmiany hasła, przejdź do zakładki Ustawienia.</p>

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
<script src="js/script.js"></script>
</body>
</html>