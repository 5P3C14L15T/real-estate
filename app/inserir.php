<?php
date_default_timezone_set('America/Cuiaba');
require_once "../config/DB.php";
require_once "./logado.php";

$db = new DB;
echo "<br>";
$ultimoImovel = $db->ultimoImovel();
// var_dump($ultimoImovel);
echo "<br>";

// último imóvel
$ultimoImovelId = $db->ultimoImovelId();
// var_dump($ultimoImovelId);
echo "<br>";
// var_dump($_SESSION['user']);

// verificar dados user

$usuario = $db->getUser($_SESSION['user']);
// var_dump($usuario);

$id_proprietario = $usuario[0]['id'];


$data = $_REQUEST;

// $titulo         = $_REQUEST['titulo'];
if(isset($_REQUEST['titulo'])) {
    $titulo     = $_REQUEST['titulo'];
} else {
    $titulo = "";
}

// $bairro         = $_REQUEST['bairro'];
if(isset($_REQUEST['bairro'])) {
    $bairro         = $_REQUEST['bairro'];
} else {
    $bairro = "";
}

// $preco          = $_REQUEST['preco'];
if(isset($_REQUEST['preco'])) {
    $preco         = $_REQUEST['preco'];
    $preco = preg_replace("/[^0-9]/", "", $preco);
    $preco = $preco / 100;
    echo $preco;
    // $preco         = number_format($_REQUEST['preco'],2,",",".");
} else {
    $preco = "";
}

// $condominio     = $_REQUEST['condominio'];
if(isset($_REQUEST['condominio'])) {
    $condominio         = $_REQUEST['condominio'];
    $condominio = preg_replace("/[^0-9]/", "", $condominio);
    $condominio = $condominio / 100;
    echo $condominio;
} else {
    $condominio = "";
}

// $iptu           = $_REQUEST['iptu'];
if(!empty($_REQUEST['iptu'])) {
    $iptu         =  $_REQUEST['iptu'];
    $iptu = preg_replace("/[^0-9]/", "", $iptu);
    $iptu = $iptu / 100;
    echo $iptu;
} else {
    $iptu = "";
}

// $area           = $_REQUEST['area'];
if(isset($_REQUEST['area'])) {
    $area         = $_REQUEST['area'];
} else {
    $area = "";
}

// $qtdQuarto      = $_REQUEST['qtdQuarto'];
if(isset($_REQUEST['qtdQuarto'])) {
    $qtdQuarto         = $_REQUEST['qtdQuarto'];
} else {
    $qtdQuarto = "";
}

// $qtdBanheiro    = $_REQUEST['qtdBanheiro'];
if(isset($_REQUEST['qtdBanheiro'])) {
    $qtdBanheiro         = $_REQUEST['qtdBanheiro'];
} else {
    $qtdBanheiro = "";
}

// $qtdGaragem     = $_REQUEST['qtdGaragem'];
if(isset($_REQUEST['qtdGaragem'])) {
    $qtdGaragem         = $_REQUEST['qtdGaragem'];
} else {
    $qtdGaragem = "";
}

// $cozinha        = $_REQUEST['cozinha'];
if(isset($_REQUEST['cozinha'])) {
    $cozinha         = $_REQUEST['cozinha'];
} else {
    $cozinha = "";
}

// $sala           = $_REQUEST['sala'];
if(isset($_REQUEST['sala'])) {
    $sala         = $_REQUEST['sala'];
} else {
    $sala = "";
}

// $garden         = $_REQUEST['garden'];
if(isset($_REQUEST['garden'])) {
    $garden         = $_REQUEST['garden'];
} else {
    $garden = "";
}

// $sacada         = $_REQUEST['sacada'];
if(isset($_REQUEST['sacada'])) {
    $sacada         = $_REQUEST['sacada'];
} else {
    $sacada = "";
}

// $lavanderia     = $_REQUEST['lavanderia'];
if(isset($_REQUEST['lavanderia'])) {
    $lavanderia         = $_REQUEST['lavanderia'];
} else {
    $lavanderia = "";
}

// $suite          = $_REQUEST['suite'];
if(isset($_REQUEST['suite'])) {
    $suite      = $_REQUEST['suite'];
} else {
    $suite = "";
    // echo $suite;
}
// $suite          = isset$suite ? $suite : "não"; 

// $elevador       = $_REQUEST['elevador'];
if(isset($_REQUEST['elevador'])) {
    $elevador         = $_REQUEST['elevador'];
} else {
    $elevador = "";
}

// $lazer          = $_REQUEST['lazer'];
if(isset($_REQUEST['lazer'])) {
    $lazer         = $_REQUEST['lazer'];
} else {
    $lazer = "";
}

// $msg            = $_REQUEST['msg'];
if(isset($_REQUEST['msg'])) {
    $msg         = $_REQUEST['msg'];
} else {
    $msg = "";
}

$views = 0;
$status = 1;

$data_criacao = date("Y-m-d h:i:s");
$data_atualizacao = date("Y-m-d h:i:s");


echo "<pre>";
var_dump($data);
echo "<br>";
echo "<br>";
$tempo = date("Y-m-d h:i:s");
echo strtotime($tempo);
echo "<br>";
echo "<br>";

$file_size = $_FILES["fileUpload"]["size"][0];
var_dump($_FILES["fileUpload"]);



if (isset($_POST['enviar'])) {

    // criando pasta do imóvel

    $pasta = md5($_SESSION['user']);
        echo $pasta;

        if (!file_exists('users/' . $pasta)) {
            mkdir('users/' . $pasta, 0755, true);
            
        } else {
            echo "já existe";
        }

        $pastaImgPorDatatime = date("Y-m-d h:i:s");
        $pastaImgPorDatatime = strtotime($pastaImgPorDatatime);
        

        if (!file_exists('users/' . $pasta . '/' . $pastaImgPorDatatime)) {
            mkdir('users/' . $pasta . '/' . $pastaImgPorDatatime, 0755, true);
            
        } else {
            echo "já existe";
        }

        $pastaImagem = 'users/' . $pasta . '/' . $pastaImgPorDatatime . '/' ;


    // Count total files
    $countfiles = $_FILES;

    

   
    // **********************************************************
    // ********************* inserindo imóvel *******************
    // **********************************************************

    $db->insertImovel(
        $ultimoImovelId,
        $ultimoImovel,
        $titulo,
        $bairro,
        $id_proprietario,
        $preco,
        $condominio,
        $iptu,
        $area,
        $qtdQuarto,
        $qtdBanheiro,
        $qtdGaragem,
        $cozinha,
        $sala,
        $garden,
        $sacada,
        $lavanderia,
        $suite,
        $elevador,
        $lazer,
        $msg,
        $views,
        $status,
        $data_criacao,
        $data_atualizacao
                
        );

        $db->uploadImagens($ultimoImovelId,  $pastaImagem, $_FILES["fileUpload"]);
        // $db->cropImages($ultimoImovelId, $_FILES["fileUpload"],  $pastaImagem, $size = 500 );

        
    
} else {

    // tamanho da imagem superior
    echo "tamanho excede!";

    $_SESSION['imagem'] = 'grande';
}

header("Location: dashboard.php");


?>