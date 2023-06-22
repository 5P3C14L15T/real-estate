<?php
require_once "../config/DB.php";
require_once "./logado.php";

$db = new DB;

$idImovel = $_GET['id'];
$db->deleteImovel($idImovel);

header("Location: dashboard.php");