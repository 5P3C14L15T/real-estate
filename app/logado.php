<?php
if(isset($_SESSION['login2']) && $_SESSION['login2'] == "logado2") {
echo "está logado";
} else {
    header("Location: ../login.php");
}