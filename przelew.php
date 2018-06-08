<?php

session_start();

if ((!isset($_POST['przelew_nrkonta'])) || (!isset($_POST['przelew_pieniadze']))) {
    header('location: pay.php');
    exit();
}

require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

$przelew_nrkonta = $_POST['przelew_nrkonta'];
$przelew_pieniadze = $_POST['przelew_pieniadze'];

if ($polaczenie->connect_errno != 0) {
    echo "Error: " . $polaczenie->connect_errno;
} else {
    $sql1 = sprintf("UPDATE kontabankowe SET pieniadze = pieniadze + '%s' WHERE nrkonta= '%s'",
        mysqli_real_escape_string($polaczenie, $przelew_pieniadze),
        mysqli_real_escape_string($polaczenie, $przelew_nrkonta));
    $sql2 = sprintf("UPDATE kontabankowe SET pieniadze = pieniadze - '%s' WHERE nrkonta = '%s'",
        mysqli_real_escape_string($polaczenie, $przelew_pieniadze),
        mysqli_real_escape_string($polaczenie, $_SESSION['nrkonta']));

    if ($_SESSION['pieniadze'] < $przelew_pieniadze || $_SESSION['pieniadze'] <= 0) {
        echo "Nie masz tyle pieniedzy. niewykonane!";
    }

    else {
        if ($polaczenie->query($sql1) && ($polaczenie->query($sql2)) === TRUE) {
            echo "Przelew zrobione";
        } else {
            echo "Error updating record: " . $polaczenie->error;
        }
    }
}

$polaczenie->close();

?>