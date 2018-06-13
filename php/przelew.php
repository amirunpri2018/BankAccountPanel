<?php

session_start();

if ((!isset($_POST['przelew_nrkonta'])) || (!isset($_POST['przelew_pieniadze']))) {
    header('location: ../platnosci/index.php');
    exit();
}

require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

$przelew_nrkonta = $_POST['przelew_nrkonta'];
$przelew_pieniadze = $_POST['przelew_pieniadze'];

$przelew_nrkonta = htmlentities($przelew_nrkonta, ENT_QUOTES, "UTF-8");
$przelew_pieniadze = htmlentities($przelew_pieniadze, ENT_QUOTES, "UTF-8");

$sql1 = sprintf("UPDATE kontabankowe SET pieniadze = pieniadze + '%f' WHERE nrkonta= '%s'",
    mysqli_real_escape_string($polaczenie, $przelew_pieniadze),
    mysqli_real_escape_string($polaczenie, $przelew_nrkonta));

$sql2 = sprintf("UPDATE kontabankowe SET pieniadze = pieniadze - '%f' WHERE nrkonta = '%s'",
    mysqli_real_escape_string($polaczenie, $przelew_pieniadze),
    mysqli_real_escape_string($polaczenie, $_SESSION['nrkonta']));

$sql3 = sprintf("SELECT nrkonta FROM kontabankowe WHERE nrkonta = '%s'",
    mysqli_real_escape_string($polaczenie, $przelew_nrkonta));

$rekordy = mysqli_query($polaczenie, $sql3);

if ($polaczenie->connect_errno != 0) {
    echo "Error: " . $polaczenie->connect_errno;
} else {
    if (mysqli_num_rows($rekordy) == 0) {
        header('Location: ../errors/error2.php');
    } else {
        if ($_SESSION['pieniadze'] < $przelew_pieniadze || $_SESSION['pieniadze'] <= 0 || $przelew_pieniadze < 0) {
            header('Location: ../errors/error1.php');
        } else {
            if ($polaczenie->query($sql1) && ($polaczenie->query($sql2)) === TRUE) {
                header('Location: ../errors/favorably.php');
            } else {
                header('Location: ../errors/error3.php');
            }
        }
    }
}

$polaczenie->close();

?>