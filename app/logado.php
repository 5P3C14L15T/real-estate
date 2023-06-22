<?php
require_once "../config/DB.php";
$db = new DB;
// if (isset($db->getEmailExist($_SESSION['user']))) {
//     # code...

// }

$email = $_SESSION['user'];

// var_dump($email);

$emailExiste = $db->getEmailExist($email);

if (empty($emailExiste)) {

    echo "entrou";
    unset($_SESSION['logado']);
    unset($_SESSION['logado2']);
    unset($_SESSION['user']);
    session_destroy();
    header("Location: ../login.php");
} else {
    if (isset($_SESSION['login2']) && $_SESSION['login2'] == "logado2") {
        // echo "está logado";
        // var_dump($_SESSION['user']);
    } else {
        header("Location: ../login.php");
    }
}




// echo "<pre>";
// print_r($emailExiste);
// echo "</pre>";
