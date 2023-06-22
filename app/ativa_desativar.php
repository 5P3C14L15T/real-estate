
<?php
require_once "../config/DB.php";
require_once "./logado.php";

$db = new DB;

$idImovel = intval($_GET['idImovel']);
    $status = intval($_GET['valor']);

echo "<pre>";
    var_dump($_REQUEST);

echo "</pre>";


    $result = $db->atualizarStatusImovel($idImovel, $status);
   
    header("Location: dashboard.php");
