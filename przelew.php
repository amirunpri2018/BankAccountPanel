<?php

session_start();

if ((!isset($_POST['login'])) || (!isset($_POST['haslo']))) {
    header('location: index.php');
    exit();
}

include "zaloguj.php";



?>