<?php

session_start();

if (isset($_POST['r_imie'])) {
    $wszystko_ok = true;

    $r_imie = $_POST['r_imie'];


    if (strlen($r_imie) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Pole imię jest wymagane!";


        echo "<style>

input[name='r_imie'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";

    }

    if (strlen($r_imie) > 16) {
        $wszystko_ok = false;
        $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 15 liter!";

        echo "<style>

input[name='r_imie'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";

    }

    if (ctype_alnum($r_imie) == false) {
        $wszystko_ok = false;
        $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Pole imię jest wymagane!";

        echo "<style>

input[name='r_imie'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";

    }

    if (preg_match("/[^A-z_-]/", $r_imie) == 1) {
        $wszystko_ok = false;
        $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Wprowadź tylko litery!";

        echo "<style>

input[name='r_imie'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";

    }

    $r_nazwisko = $_POST['r_nazwisko'];

    if (strlen($r_nazwisko) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Pole nazwisko jest wymagane!";

        echo "<style>

input[name='r_nazwisko'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if (strlen($r_nazwisko) > 16) {
        $wszystko_ok = false;
        $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 15 liter!";

        echo "<style>

input[name='r_nazwisko'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if (ctype_alnum($r_nazwisko) == false) {
        $wszystko_ok = false;
        $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Pole nazwisko jest wymagane!";

        echo "<style>

input[name='r_nazwisko'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if (preg_match("/[^A-z_-]/", $r_nazwisko) == 1) {
        $wszystko_ok = false;
        $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Wprowadź tylko litery!";

        echo "<style>

input[name='r_nazwisko'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    $r_login = trim($_POST['r_login']);

    if (strlen($r_login) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i> Pole numer dostępu jest wymagane!";

        echo "<style>

input[name='r_login'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if (strlen($r_login) > 11) {
        $wszystko_ok = false;
        $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 10 znaków!";

        echo "<style>

input[name='r_login'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if (is_numeric($r_login) == false) {
        $wszystko_ok = false;
        $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i>Podaj tylko cyfry!";

        echo "<style>

input[name='r_login'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if (is_numeric($r_login) == false || ((int)$r_login != $r_login))
    {
        $wszystko_ok = false;
        $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i> Wprowadź tylko cyfry całkowite!";

        echo "<style>

input[name='r_login'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if(strpos($r_login, '.') == true)
    {
        $wszystko_ok = false;
        $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i> Wprowadź tylko cyfry całkowite!";

        echo "<style>

input[name='r_login'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    $r_haslo = trim($_POST['r_haslo']);

    if (strlen($r_haslo) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_haslo'] = "<i class=\"fas fa-user-times\"></i> Pole kod dostępu jest wymagane!";

        echo "<style>

input[name='r_haslo'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if (strlen($r_haslo) > 11) {
        $wszystko_ok = false;
        $_SESSION['e_haslo'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 10 znaków!";

        echo "<style>

input[name='r_haslo'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if (is_numeric($r_haslo) == false || ((int)$r_haslo != $r_haslo))
    {
        $wszystko_ok = false;
        $_SESSION['e_haslo'] = "<i class=\"fas fa-user-times\"></i> Wprowadź tylko cyfry całkowite!";

        echo "<style>

input[name='r_haslo'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if(strpos($r_haslo, '.') == true)
    {
        $wszystko_ok = false;
        $_SESSION['e_haslo'] = "<i class=\"fas fa-user-times\"></i> Wprowadź tylko cyfry całkowite!";

        echo "<style>

input[name='r_haslo'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    require_once "../php/connect.php";
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

                echo "<style>

input[name='r_login'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";

            } else {
                //generuj numer konta
                $r_nrkonta = rand(100000000000000, 999999999999999);

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

                    $r_imie = htmlentities($r_imie, ENT_QUOTES, "UTF-8");
                    $r_nazwisko = htmlentities($r_nazwisko, ENT_QUOTES, "UTF-8");
                    $r_login = htmlentities($r_login, ENT_QUOTES, "UTF-8");
                    $r_haslo = htmlentities($r_haslo, ENT_QUOTES, "UTF-8");


                    if ($polaczenie->query("INSERT INTO kontabankowe VALUES (NULL, '$r_imie', '$r_nazwisko', '$r_login', '$r_haslo', '$r_nrkonta', 10)")


                    ) {
                        $_SESSION['udanarejestracja'] = "Rejestracja zakończona pomyślnie!";
                        header('Location: ../index.php');
                    } else {
                        throw new Exception($polaczenie->error);
                    }


                    $polaczenie->close();
                }
            }
        }
    } catch (Exception $e) {
        echo "<span style='color: red;'>Błąd serwera! Prosimy o rejestrację w innym terminie! :)</span>";
        echo $e;
    }
}

?>

<!doctype html>
<html lang="pl">
<head>
    <title>C.E.O Bank | Rejestracja</title>
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

<div id="content">
    <div class="logo-text">C<span class="sql">.</span>E<span class="sql">.</span>O Bank</div>
    <form method="post">
        <div><input type="text" name="r_imie" placeholder="Podaj imię" value="<?php

            if (isset($_POST['r_imie'])) {

                if (strlen($r_imie) < 1) {
                    echo "";
                }

                if (strlen($r_imie) > 16) {
                    echo "";
                }

                if (ctype_alnum($r_imie) == false) {
                    echo "";
                }

                if (preg_match("/[^A-z_-]/", $r_imie) == 1) {
                    echo "";
                }

                else {
                    echo $r_imie;
                }
            }


            ?>"></div>

        <?php

        if (isset($_SESSION['e_imie'])) {
            echo '<div class="f_error" style>' . $_SESSION['e_imie'] . '</div>';
            unset($_SESSION['e_imie']);
        }

        ?>

        <div><input type="text" name="r_nazwisko" placeholder="Podaj nazwisko" value="<?php

            if (isset($_POST['r_nazwisko'])) {

                if (strlen($r_nazwisko) < 1) {
                    echo "";}

                if (strlen($r_nazwisko) > 16) {
                    echo "";}

                if (ctype_alnum($r_nazwisko) == false) {
                    echo "";}

                if (preg_match("/[^A-z_-]/", $r_nazwisko) == 1) {
                    echo "";}
                else {
                    echo "$r_nazwisko";
                }

            }

            ?>"></div>

        <?php

        if (isset($_SESSION['e_nazwisko'])) {
            echo '<div class="f_error" style>' . $_SESSION['e_nazwisko'] . '</div>';
            unset($_SESSION['e_nazwisko']);
        }

        ?>

        <div><input type="text" name="r_login" placeholder="Podaj numer dostępu" value="<?php

            if (isset($_POST['r_login'])) {

                if (strlen($r_login) < 1) {
                    echo ""; }

                if (strlen($r_login) > 11) {
                    echo ""; }

                if (is_numeric($r_login) == false) {
                    echo "";}

                    else {
                        echo "$r_login";
                    }
            }

            ?>"></div>

        <?php

        if (isset($_SESSION['e_login'])) {
            echo '<div class="f_error" style>' . $_SESSION['e_login'] . '</div>';
            unset($_SESSION['e_login']);
        }

        ?>

        <div><input type="password" name="r_haslo" placeholder="Podaj kod dostępu" value="<?php

            if (isset($_POST['r_haslo'])) {

                if (strlen($r_haslo) < 1) {
                    echo "";
                }

                if (strlen($r_haslo) > 11) {
                    echo "";
                }

                if (is_numeric($r_haslo) == false) {
                    echo "";
                } else {
                    echo $r_haslo;
                }
            }

            ?>"></div>


        <?php

        if (isset($_SESSION['e_haslo'])) {
            echo '<div class="f_error">' . $_SESSION['e_haslo'] . '</div>';
            unset($_SESSION['e_haslo']);
        }

        ?>

        <br>
        <div><input type="submit" value="Rejestracja >"></div>

    </form>

    <div id="rejestracjacontent">Masz już konto? <a href="../">Zaloguj się</a>.</div>
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
</body>
</html>

