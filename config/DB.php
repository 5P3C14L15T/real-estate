<?php
session_start();
class DB {


private $servername = "localhost";
private $username   = "root";
private $password   = "";
private $database   = "db_imoveis";
private $conn;

public function __construct()
{
    try {
//code...
$dsn = "mysql:host=" . $this->servername . ";dbname=" . $this->database;
$this->conn = new PDO($dsn, $this->username, $this->password);

} catch(PDOException $e) {
  echo "Conexão falhada: " . $e->getMessage();
}
}

public function getEmail($email, $senha) {
    $sql = "SELECT email, password FROM perfil WHERE email = :email AND password = :senha";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['email' => $email, 'senha' => $senha]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
    var_dump($data);
}

public function getEmailExist($email,) {
    $sql = "SELECT email FROM perfil WHERE email = :email";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['email' => $email]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
    var_dump($data);
}


public function insertData($name,$email,$password) {
    $sql = "INSERT INTO perfil (nome,email,password) VALUES (:name, :email, :password)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);
    echo "Inserido";
}



}

?>