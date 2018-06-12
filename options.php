<?php

session_start();

if (!isset($_SESSION['zalogowany'])) {
    header('location: index.php');
    exit();
}

if (isset($_POST['o_imie'])) {

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if ($polaczenie->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {

            //start

            $o_imie = $_POST['o_imie'];
            $o_nazwisko = $_POST['o_nazwisko'];
            $o_login = trim($_POST['o_login']);
            $o_haslo = trim($_POST['o_haslo']);

            if (strlen($o_imie) < 1) {
                $_SESSION['nieudanazmianaopcji'] = "<div style='color: red; text-align: center; font-weight: bold;'>Błąd. Zmiany nie zostały zawierdzone.</div>";
            } else if (ctype_alnum($o_imie) == false) {
                $_SESSION['nieudanazmianaopcji'] = "<div style='color: red; text-align: center; font-weight: bold;'>Błąd. Zmiany nie zostały zawierdzone.</div>";
            } else {
                $polaczenie->query(

                    sprintf("UPDATE kontabankowe SET imie= '%s' WHERE id = '%d'",
                        mysqli_real_escape_string($polaczenie, $o_imie),
                        mysqli_real_escape_string($polaczenie, $_SESSION['id'])));

                $_SESSION['udanazmianaopcji'] = "<div style='color: green; text-align: center; font-weight: bold;'>Zmiana imienia została zatwierdzona!</div>";
            }

            //koniec

            // start nazwisko

            if (strlen($o_nazwisko) < 1) {
                $_SESSION['nieudanazmianaopcji'] = "<div style='color: red; text-align: center; font-weight: bold;'>Błąd. Zmiany nie zostały zawierdzone.</div>";
            } else if (ctype_alnum($o_nazwisko) == false) {
                $_SESSION['nieudanazmianaopcji'] = "<div style='color: red; text-align: center; font-weight: bold;'>Błąd. Zmiany nie zostały zawierdzone.</div>";
            } else {
                $polaczenie->query(

                    sprintf("UPDATE kontabankowe SET nazwisko= '%s' WHERE id = '%d'",
                        mysqli_real_escape_string($polaczenie, $o_nazwisko),
                        mysqli_real_escape_string($polaczenie, $_SESSION['id'])));

                $_SESSION['udanazmianaopcji'] = "<div style='color: green; text-align: center; font-weight: bold;'>Zmiana nazwiska została zatwierdzona!</div>";
            }

            // koniec nazwisko

            //poczatek login

            $rezultat = $polaczenie->query("SELECT login FROM kontabankowe WHERE login='$o_login'");

            if (!$rezultat)
                throw new Exception($polaczenie->error);

            $ile_takich_loginow = $rezultat->num_rows;
            if ($ile_takich_loginow > 0) {
                $_SESSION['eo_login'] = "<i class=\"fas fa-user-times\"></i> Istnieje już taki numer dostępu!";
            }

            else {
                if (strlen($o_login) < 1) {
                    $_SESSION['nieudanazmianaopcji'] = "<div style='color: red; text-align: center; font-weight: bold;'>Błąd. Zmiany nie zostały zawierdzone.</div>";
                } else if (is_numeric($o_login) == false) {
                    $_SESSION['nieudanazmianaopcji'] = "<div style='color: red; text-align: center; font-weight: bold;'>Błąd. Zmiany nie zostały zawierdzone.</div>";
                }

                else {
                    $polaczenie->query(

                        sprintf("UPDATE kontabankowe SET login= '%d' WHERE id = '%d'",
                            mysqli_real_escape_string($polaczenie, $o_login),
                            mysqli_real_escape_string($polaczenie, $_SESSION['id'])));

                    $_SESSION['udanazmianaopcji'] = "<div style='color: green; text-align: center; font-weight: bold;'>Zmiana ustawień została zatwierdzona!</div>";
                }
            }

            //koniec login

            //poczatek haslo

            if (strlen($o_haslo) < 1) {
                $_SESSION['nieudanazmianaopcji'] = "<div style='color: red; text-align: center; font-weight: bold;'>Błąd. Zmiany nie zostały zawierdzone.</div>";
            }

            else if (is_numeric($o_haslo) == false) {
                $_SESSION['nieudanazmianaopcji'] = "<div style='color: red; text-align: center; font-weight: bold;'>Błąd. Zmiany nie zostały zawierdzone.</div>";
            }

            else {
                $polaczenie->query(

                    sprintf("UPDATE kontabankowe SET haslo= '%d' WHERE id = '%d'",
                        mysqli_real_escape_string($polaczenie, $o_haslo),
                        mysqli_real_escape_string($polaczenie, $_SESSION['id'])));

                $_SESSION['udanazmianaopcji'] = "<div style='color: green; text-align: center; font-weight: bold;'>Zmiana ustawień została zatwierdzona!</div>";

            }

            // koniec haslo

            $polaczenie->close();
        }

    } catch (Exception $e) {
        echo "<span style='color: red;'>Błąd serwera! Prosimy o rejestrację w innym terminie! :)</span>";
    }
}

?>

<!doctype html>
<html lang="pl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>C.E.O Bank | Ustawienia</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">C<span class="sql">.</span>E<span class="sql">.</span>O Bank</a>
    <span class="navbar-text">
      Dzień dobry <span class="sql"><?php echo $_SESSION['imie'] ?></span>!
    </span>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="true" aria-expanded="false">Konto osobiste</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item disabled" href="#">Historia płatności</a>
                    <a class="dropdown-item" href="pay.php">Przelewy</a>
                    <a class="dropdown-item" href="options.php">Ustawienia</a>
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
    <a class="nav-link menuleft" href="account.php"><i class="fas fa-align-justify"></i> Mój pulpit</a>
    <a class="nav-link menuleft" href="pay.php"><i class="far fa-address-card"></i> Płatności</a>
    <a class="nav-link menuleft disabled" href="#"><i class="fas fa-money-check-alt"></i> Rachunki</a>
    <a class="nav-link menuleft disabled" href="#"><i class="far fa-bell"></i> Powiadomienia</a>
    <a class="nav-link menuleft disabled" href="#"><i class="far fa-envelope"></i> Wiadomości</a>
    <a class="nav-link menuleft active" href="#"><i class="fas fa-wrench"></i> Ustawienia</a>
</div>

<main id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 przelew">

                <div id="przelew">

                    <form method="post">

                        <div class="ustawieniadiv"><input class="ustawieniainput" type="text"
                                                          placeholder="Wprowadź nowe imię" name="o_imie"></div>
                        <div class="ustawieniadiv"><input class="ustawieniainput" type="text"
                                                          placeholder="Wprowadź nowe nazwisko" name="o_nazwisko"></div>
                        <div class="ustawieniadiv"><input class="ustawieniainput" type="text"
                                                          placeholder="Wprowadź nowy numer dostępu" name="o_login">
                        </div>
                        <div class="ustawieniadiv"><input class="ustawieniainput" type="password"
                                                          placeholder="Wprowadź nowy kod dostępu" name="o_haslo"></div>

                        <div>
                            <input type="submit" class="przelewinput submit_przelew" value="Zmień ustawienia >"/>
                        </div>
                    </form>

                    <?php

                    if (isset($_SESSION['nieudanazmianaopcji'])) {
                        echo $_SESSION['nieudanazmianaopcji'];
                        unset($_SESSION['nieudanazmianaopcji']);
                    }

                    else if (isset($_SESSION['udanazmianaopcji']))
                    {
                        echo $_SESSION['udanazmianaopcji'];
                        unset($_SESSION['udanazmianaopcji']);
                    }

                    ?>

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