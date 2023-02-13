<?php
if(isset($_SESSION['login']) && $_SESSION['login'] == "logado") {
echo "está logado";
} else {
    header("Location: ../login.php");
}