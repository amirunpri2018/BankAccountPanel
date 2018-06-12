<?php

session_start();

if (isset($_POST['r_imie'])) {
    $wszystko_ok = true;

    $r_imie = $_POST['r_imie'];

    if (strlen($r_imie) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Pole imię jest wymagane!";
    }

    if (ctype_alnum($r_imie) == false) {
        $wszystko_ok = false;
        $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Pole imię jest wymagane!";
    }

    $r_nazwisko = $_POST['r_nazwisko'];

    if (strlen($r_nazwisko) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Pole nazwisko jest wymagane!";
    }

    if (ctype_alnum($r_nazwisko) == false) {
        $wszystko_ok = false;
        $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Pole nazwisko jest wymagane!";
    }

    $r_login = trim($_POST['r_login']);

    if (strlen($r_login) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i> Pole numer dostępu jest wymagane!";
    }

    if (strlen($r_login) > 11) {
        $wszystko_ok = false;
        $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 10 znaków!";
    }

    if (is_numeric($r_login) == false) {
        $wszystko_ok = false;
        $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i>Podaj tylko cyfry!";
    }

    $r_haslo = trim($_POST['r_haslo']);

    if (strlen($r_haslo) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_haslo'] = "<i class=\"fas fa-user-times\"></i> Pole kod dostępu jest wymagane!";
    }

    if (strlen($r_haslo) > 11) {
        $wszystko_ok = false;
        $_SESSION['e_haslo'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 10 znaków!";
    }


    if (is_numeric($r_haslo) == false) {
        $wszystko_ok = false;
        $_SESSION['e_haslo'] = "<i class=\"fas fa-user-times\"></i> Podaj tylko cyfry!";
    }

    if (!isset($_POST['regulamin'])) {
        $wszystko_ok = false;
        $_SESSION['e_regulamin'] = "<i class=\"fas fa-user-times\"></i> Zaakceptuj regulamin!";
    }

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if ($polaczenie->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            // czy numer dostępu istnieje?
            $rezultat = $polaczenie->query("SELECT login FROM kontabankowe WHERE login='$r_login'");

            if (!$rezultat)
                throw new Exception($polaczenie->error);

            $ile_takich_loginow = $rezultat->num_rows;
            if ($ile_takich_loginow > 0) {
                $wszystko_ok = false;
                $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i> Istnieje już taki numer dostępu!";
            } else {
                    //generuj numer konta
                    $r_nrkonta = rand(100000000000, 999999999999);

                    //czy nr konta istnieje?
                    $rezultat2 = $polaczenie->query("SELECT nrkonta FROM kontabankowe WHERE nrkonta='$r_nrkonta'");
                    if (!$rezultat2)
                        throw new Exception($polaczenie->error);

                    $ile_takich_nrkonta = $rezultat2->num_rows;
                    if ($ile_takich_nrkonta > 0) {
                        $r_nrkonta++;
                        $wszystko_ok = true;
                    }

                if ($wszystko_ok == true) {

                    if ($polaczenie->query("INSERT INTO kontabankowe VALUES (NULL, '$r_imie', '$r_nazwisko', '$r_login', '$r_haslo', '$r_nrkonta', 10)")) {
                        $_SESSION['udanarejestracja'] = "Rejestracja zakończona pomyślnie!";
                        header('Location: index.php');
                    } else {
                        throw new Exception($polaczenie->error);
                    }
                }

                $polaczenie->close();
            }
        }

    } catch (Exception $e) {
        echo "<span style='color: red;'>Błąd serwera! Prosimy o rejestrację w innym terminie! :)</span>";
    }
}

?>

<!doctype html>
<html lang="en">
<head>
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
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <title>C.E.O Bank | Rejestracja</title>
</head>
<body>

<div id="content">

    <div class="logo-text">C<span class="sql">.</span>E<span class="sql">.</span>O Bank</div>
    <form method="post">
        <div><input type="text" name="r_imie" placeholder="Podaj imię"></div>

        <?php

        if (isset($_SESSION['e_imie'])) {
            echo '<div class="f_error" style>' . $_SESSION['e_imie'] . '</div>';
            unset($_SESSION['e_imie']);
        }

        ?>

        <div><input type="text" name="r_nazwisko" placeholder="Podaj nazwisko"></div>

        <?php

        if (isset($_SESSION['e_nazwisko'])) {
            echo '<div class="f_error" style>' . $_SESSION['e_nazwisko'] . '</div>';
            unset($_SESSION['e_nazwisko']);
        }

        ?>

        <div><input type="text" name="r_login" placeholder="Podaj numer dostepu"></div>

        <?php

        if (isset($_SESSION['e_login'])) {
            echo '<div class="f_error" style>' . $_SESSION['e_login'] . '</div>';
            unset($_SESSION['e_login']);
        }

        ?>

        <div><input type="password" name="r_haslo" placeholder="Podaj kod dostępu"></div>

        <?php

        if (isset($_SESSION['e_haslo'])) {
            echo '<div class="f_error" style>' . $_SESSION['e_haslo'] . '</div>';
            unset($_SESSION['e_haslo']);
        }

        ?>
        <div style="text-align: center; margin-top: 5px;"><label>
                <input type="checkbox" name="regulamin" style="width: 10px;"> Akceptuję regulamin
            </label></div>

        <?php

        if (isset($_SESSION['e_regulamin'])) {
            echo '<div class="f_error" style>' . $_SESSION['e_regulamin'] . '</div>';
            unset($_SESSION['e_regulamin']);
        }

        ?>

        <br>
        <div><input type="submit" value="Rejestracja >"></div>

    </form>

    <div id="rejestracjacontent">Masz już konto? <a href="index.php">Zaloguj się</a>.</div>
</div>


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

