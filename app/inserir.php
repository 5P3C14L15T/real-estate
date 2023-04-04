<?php
  require_once "../config/DB.php";
  require_once "./logado.php";

  $db = new DB;


  $data = $_REQUEST;

  echo "<pre>";
  var_dump($data);

?>