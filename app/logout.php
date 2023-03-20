<?php
session_start();

if(isset($_SESSION['login2'])) {
    echo "existe a sessão";

    unset($_SESSION['login2']);
session_destroy();
header("Location: ../login.php");
} else {

    header("Location: ../login.php");
}


// header("Location: ../login.php");