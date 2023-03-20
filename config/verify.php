<?php
require_once "./DB.php";

$db = new DB;


if(isset($_POST['login']))
{

    if(isset($_POST['email']) and isset($_POST['senha'])) {

        $logado = $db->getEmail($_POST['email'], $_POST['senha']);
        if($logado) {
            $_SESSION['login'] = 'logado';
            $_SESSION['login2'] = 'logado2';
            header("Location: ../app/dashboard.php");
        } else {
            $_SESSION['login'] = "error";
            header("Location: ../login.php");
        }
        
        
    } else {

        header("Location: ../login.php");
    }


}

if(isset($_POST['cadastrar']))
{
    $emailExiste = $db->getEmailExist($_POST['email']);

    if ($emailExiste) {
        echo "esse email já existe";
    } else {
        
        $inserir = $db->insertData($_POST['name'], $_POST['email'], $_POST['password']);
        echo "cadastro";
    
        $data = $_REQUEST;
        var_dump($data);
    }

    

    // if(isset($_POST['email']) and isset($_POST['senha'])) {

    //     $logado = $db->getEmail($_POST['email'], $_POST['senha']);
    //     if($logado) {
    //         $_SESSION['login'] = 'logado';
    //         header("Location: ../app/dashboard.php");
    //     } else {
    //         $_SESSION['login'] = "error";
    //         header("Location: ../login.php");
    //     }
        
        
    // } else {

    //     header("Location: ../login.php");
    // }


}

