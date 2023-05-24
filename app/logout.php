<?php
session_start();

if(isset($_SESSION['login2'])) {
    echo "existe a sessão";

    unset($_SESSION['login2']);
    // $_SESSION['user'] = $_POST['email'];
    unset($_SESSION['user']);
session_destroy();
header("Location: ../login.php");
} else {

    header("Location: ../login.php");
}


// header("Location: ../login.php");