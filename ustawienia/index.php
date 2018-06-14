<?php

session_start();

if (!isset($_SESSION['zalogowany'])) {
    header('location: ../index.php');
    exit();
}

require_once "../php/connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno != 0) {
    echo "Error: " . $polaczenie->connect_errno;
} else {

    if ($rezultat = @$polaczenie->query(

        sprintf("SELECT * FROM kontabankowe WHERE id = '%s'",
            mysqli_real_escape_string($polaczenie, $_SESSION['id'])))) {
        $ilu_userow = $rezultat->num_rows;

        if ($ilu_userow > 0) {
            $_SESSION['zalogowany'] = true;

            $wiersz = $rezultat->fetch_assoc();

            $_SESSION['id'] = $wiersz['id'];
            $_SESSION['imie'] = $wiersz['imie'];
            $_SESSION['nazwisko'] = $wiersz['nazwisko'];
            $_SESSION['login'] = $wiersz['login'];
            $_SESSION['haslo'] = $wiersz['haslo'];
            $_SESSION['nrkonta'] = $wiersz['nrkonta'];
            $_SESSION['pieniadze'] = $wiersz['pieniadze'];

            $rezultat->free_result();
        }
    }
}

if (isset($_POST['o_imie'])) {

    $o_imie = $_POST['o_imie'];
    $wszystko_ok_imie = true;

    if (strlen($o_imie) < 1) {
        $wszystko_ok_imie = false;
        $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Imię musi mieć maksymalnie 1 znak!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>"; }

  if (preg_match("/[^A-z_-]/", $o_imie) == 1)
  {
      $wszystko_ok_imie = false;
      $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Imię musi składać się tylko z liter!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>";
  }

    if (ctype_alnum($o_imie) == false) {
        $wszystko_ok_imie = false;
        $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Imię nie może zawierać znaków specjalnych!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>"; }
    if (strlen($o_imie) > 16) {
        $wszystko_ok_imie = false;
        $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Imię musi mieć maksymalnie 15 znaków!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>"; }

    if ($wszystko_ok_imie == true) {

        $o_imie = htmlentities($o_imie, ENT_QUOTES, "UTF-8");

        $polaczenie->query(

            sprintf("UPDATE kontabankowe SET imie= '%s' WHERE id = '%d'",
                mysqli_real_escape_string($polaczenie, $o_imie),
                mysqli_real_escape_string($polaczenie, $_SESSION['id'])));

        $_SESSION['udanazmianaopcji'] = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień została zapisana.
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>";
    }
}


if (isset($_POST['o_nazwisko'])) {

    $o_nazwisko = $_POST['o_nazwisko'];
    $wszystko_ok_nazwisko = true;

if (preg_match("/[^A-z_-]/", $o_nazwisko) == 1)
{
    $wszystko_ok_nazwisko = false;
    $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Nazwisko musi składać się tylko z liter!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>";}

    if (strlen($o_nazwisko) < 1) {
        $wszystko_ok_nazwisko = false;
        $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Nazwisko musi mieć minimalnie 1 znak!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>"; }
    if (strlen($o_nazwisko) > 16) {
        $wszystko_ok_nazwisko = false;
        $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Nazwisko musi mieć maksymalnie 15 znaków!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>";  }
    if (ctype_alnum($o_nazwisko) == false) {
        $wszystko_ok_nazwisko = false;
        $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Nazwisko nie może zawierać znaków specjalnych!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>"; }

    if ($wszystko_ok_nazwisko == true) {

        $o_nazwisko = htmlentities($o_nazwisko, ENT_QUOTES, "UTF-8");

        $polaczenie->query(

            sprintf("UPDATE kontabankowe SET nazwisko= '%s' WHERE id = '%d'",
                mysqli_real_escape_string($polaczenie, $o_nazwisko),
                mysqli_real_escape_string($polaczenie, $_SESSION['id'])));

        $_SESSION['udanazmianaopcji'] = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień została zapisana.
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>";
    }
}


if (isset($_POST['o_login'])) {

    $o_login = trim($_POST['o_login']);
    $wszystko_ok_login = true;

    $rezultat = $polaczenie->query("SELECT login FROM kontabankowe WHERE login='$o_login'");

    if (!$rezultat)
        throw new Exception($polaczenie->error);

    $ile_takich_loginow = $rezultat->num_rows;
    if ($ile_takich_loginow > 0) {
        $_SESSION['eo_login'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Istnieje już taki numer dostępu!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>";  } else {

        if (strlen($o_login) < 1) {
            $wszystko_ok_login = false;
            $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Numer dostępu musi mieć przynajmniej 1 znak!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>";   }

        if(strpos($o_login, '.') == true)
        {
            $wszystko_ok_login = false;
            $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Numer dostępu musi składać się tylko z liczb całkowitych!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>";  }

        if (is_numeric($o_login) == false || ((int)$o_login != $o_login))
        {
            $wszystko_ok_login = false;
            $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Numer dostępu musi składać się tylko z liczb całkowitych!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>";  }

        if (strlen($o_login) > 11) {
            $wszystko_ok_login = false;
            $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Numer dostępu musi mieć maksymalnie 10 znaków!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>";  }

        if (is_numeric($o_login) == false) {
            $wszystko_ok_login = false;
            $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Numer dostępu powinnien składać się tylko z cyfr.
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>"; }

        if ($wszystko_ok_login == true) {

            $o_login = htmlentities($o_login, ENT_QUOTES, "UTF-8");

            $polaczenie->query(

                sprintf("UPDATE kontabankowe SET login= '%d' WHERE id = '%d'",
                    mysqli_real_escape_string($polaczenie, $o_login),
                    mysqli_real_escape_string($polaczenie, $_SESSION['id'])));

            $_SESSION['udanazmianaopcji'] = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień została zapisana.
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>";
        }
    }
}

if (isset($_POST['o_haslo'])) {

    $o_haslo = trim($_POST['o_haslo']);
    $wszystko_ok_haslo = true;

    if (strlen($o_haslo) < 1) {
        $wszystko_ok_haslo = false;
        $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Kod dostępu musi mieć przynajmniej 1 znak!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>"; }

    if (strlen($o_haslo) > 11) {
        $wszystko_ok_haslo = false;
        $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Kod dostępu musi mieć maksymalnie 10 znaków!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>";}

    if(strpos($o_haslo, '.') == true) {
        $wszystko_ok_haslo = false;
        $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Kod dostępu musi składać się tylko z liczb całkowitych!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>";}

if (is_numeric($o_haslo) == false || ((int)$o_haslo != $o_haslo)) {
    $wszystko_ok_login = false;
    $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Kod dostępu musi składać się tylko z liczb całkowitych!
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>";
}

    if (is_numeric($o_haslo) == false) {
        $wszystko_ok_haslo = false;
        $_SESSION['nieudanazmianaopcji'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień nie powiodła się. Kod dostępu powinnien składać się tylko z cyfr.
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>";}

    if ($wszystko_ok_haslo == true) {

        $o_haslo = htmlentities($o_haslo, ENT_QUOTES, "UTF-8");

        $polaczenie->query(

            sprintf("UPDATE kontabankowe SET haslo= '%d' WHERE id = '%d'",
                mysqli_real_escape_string($polaczenie, $o_haslo),
                mysqli_real_escape_string($polaczenie, $_SESSION['id'])));

        $_SESSION['udanazmianaopcji'] = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\" style='width: 100%; margin: 30px;'>
    <strong>Powiadomienie <i class=\"far fa-bell\"></i></strong> Zmiana ustawień została zapisana.
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>

  </div>";

    }
}
$polaczenie->close();
?>

<!doctype html>
<html lang="pl">
<head>
    <title>C.E.O Bank | Ustawienia</title>
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
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="collapse" id="navbarToggleExternalContent">
    <div class="bg-light p-4" style="text-align: center;">
        <a class="dropdown-item" href="../pulpit/">Pulpit</a>
        <a class="dropdown-item" href="../platnosci/">Płatności</a>
        <a class="dropdown-item" href="index.php">Ustawienia</a>
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
                <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="true" aria-expanded="false">Konto osobiste</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item disabled" href="#">Historia płatności</a>
                    <a class="dropdown-item" href="../platnosci/">Przelewy</a>
                    <a class="dropdown-item" href="../ustawienia">Ustawienia</a>
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
    <a class="nav-link menuleft" href="../platnosci/"><i class="far fa-address-card"></i> Płatności</a>
    <a class="nav-link menuleft disabled" href="#"><i class="fas fa-money-check-alt"></i> Rachunki</a>
    <a class="nav-link menuleft disabled" href="#"><i class="far fa-bell"></i> Powiadomienia</a>
    <a class="nav-link menuleft disabled" href="#"><i class="far fa-envelope"></i> Wiadomości</a>
    <a class="nav-link menuleft active" href="../ustawienia/"><i class="fas fa-wrench"></i> Ustawienia</a>
</div>

<main id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 przelew">
                <div id="przelew" style="height: 107%;">

                    <form method="post">

                        <div class="ustawieniadiv"><input class="ustawieniainput" type="text"
                                                          placeholder="Wprowadź nowe imię" name="o_imie">
                            <input type="submit" class="przelewinput submit_przelew" value="Zmień imię >"/></div>

                    </form>

                    <form method="post">

                        <div class="ustawieniadiv"><input class="ustawieniainput" type="text"
                                                          placeholder="Wprowadź nowe nazwisko" name="o_nazwisko">
                            <input type="submit" class="przelewinput submit_przelew" value="Zmień nazwisko >"/></div>

                    </form>

                    <form method="post">

                        <div class="ustawieniadiv"><input class="ustawieniainput" type="text"
                                                          placeholder="Wprowadź nowy numer dostępu" name="o_login">
                            <input type="submit" class="przelewinput submit_przelew" value="Zmień numer dostępu >"/>
                        </div>


                    </form>

                    <form method="post">

                        <div class="ustawieniadiv"><input class="ustawieniainput" type="password"
                                                          placeholder="Wprowadź nowy kod dostępu" name="o_haslo">
                            <input type="submit" class="przelewinput submit_przelew" value="Zmień kod dostępu >"/></div>

                    </form>
                </div>
            </div>

            <?php

            if (isset($_SESSION['udanazmianaopcji'])) {
                echo $_SESSION['udanazmianaopcji'];
                unset($_SESSION['udanazmianaopcji']);
            }

            if (isset($_SESSION['nieudanazmianaopcji'])) {
                echo $_SESSION['nieudanazmianaopcji'];
                unset($_SESSION['nieudanazmianaopcji']);
            }

            if (isset($_SESSION['eo_login'])) {
                echo $_SESSION['eo_login'];
                unset($_SESSION['eo_login']);
            }

            ?>
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