<?php

session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true))
{
    header('location: pulpit/index.php');
    exit();
}

?>

<!doctype html>
<html lang="en">
<head>
    <title>C.E.O Bank | Panel logowania</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<main id="content">

    <div class="logo-text">C<span class="sql">.</span>E<span class="sql">.</span>O Bank</div>
    <form action="php/zaloguj.php" method="post">
        <div><input type="text" name="login" placeholder="Wprowadź numer"></div>
        <div><input type="password" name="haslo" placeholder="Wpisz kod dostępu"></div>
        <br>
        <div><input type="submit" value="Logowanie >"></div>

    </form>

    <?php

    if (isset($_SESSION['blad']))
    {
        echo $_SESSION['blad'];
        echo "<style>

input[type='text'], input[type='password'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
        unset($_SESSION['blad']);
    }

    ?>
    <div id="rejestracjacontent">Nie masz konta? <a href="rejestracja/index.php">Zarejestruj się</a>.</div>

    <?php

    if (isset($_SESSION['udanarejestracja']))
    {
        echo "<div style='color: green; text-align: center; font-weight: bold; font-size: 13px;'>".$_SESSION['udanarejestracja']."</div>";
        unset($_SESSION['udanarejestracja']);
    }

    ?>
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

