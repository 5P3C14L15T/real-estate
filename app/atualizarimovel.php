<?php
ob_start();
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
var_dump($data);

// $titulo         = $_REQUEST['titulo'];
if (isset($_REQUEST['titulo'])) {
    $titulo = $_REQUEST['titulo'];
} else {
    $titulo = "";
}

// $bairro         = $_REQUEST['bairro'];
if (isset($_REQUEST['bairro'])) {
    $bairro = $_REQUEST['bairro'];
} else {
    $bairro = "";
}

// $preco          = $_REQUEST['preco'];
if (isset($_REQUEST['preco'])) {
    $preco = $_REQUEST['preco'];
    $preco = preg_replace("/[^0-9]/", "", $preco);
    $preco = $preco / 100;
    echo $preco;
    // $preco         = number_format($_REQUEST['preco'],2,",",".");
} else {
    $preco = "";
}

// $condominio     = $_REQUEST['condominio'];
if (isset($_REQUEST['condominio'])) {
    $condominio = $_REQUEST['condominio'];
    $condominio = preg_replace("/[^0-9]/", "", $condominio);
    $condominio = $condominio / 100;
    echo $condominio;
} else {
    $condominio = "";
}

// $iptu           = $_REQUEST['iptu'];
if (isset($_REQUEST['iptu'])) {
    $iptu = $_REQUEST['iptu'];
    $iptu = preg_replace("/[^0-9]/", "", $iptu);
    $iptu = $iptu / 100;
    echo $iptu;
} else {
    $iptu = "";
}

// $area           = $_REQUEST['area'];
if (isset($_REQUEST['area'])) {
    $area = $_REQUEST['area'];
} else {
    $area = "";
}

// $qtdQuarto      = $_REQUEST['qtdQuarto'];
if (isset($_REQUEST['qtdQuarto'])) {
    $qtdQuarto = $_REQUEST['qtdQuarto'];
} else {
    $qtdQuarto = "";
}

// $qtdBanheiro    = $_REQUEST['qtdBanheiro'];
if (isset($_REQUEST['qtdBanheiro'])) {
    $qtdBanheiro = $_REQUEST['qtdBanheiro'];
} else {
    $qtdBanheiro = "";
}

// $qtdGaragem     = $_REQUEST['qtdGaragem'];
if (isset($_REQUEST['qtdGaragem'])) {
    $qtdGaragem = $_REQUEST['qtdGaragem'];
} else {
    $qtdGaragem = "";
}



// $msg            = $_REQUEST['msg'];
if (isset($_REQUEST['msg'])) {
    $msg = $_REQUEST['msg'];
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

$id = $_POST['id'];
echo "<hr>";
var_dump($id);



if (isset($_POST['atualizar'])) {

    $cozinha = isset($_POST['cozinha']) ? 1 : 0;
    $sala = isset($_POST['sala']) ? 1 : 0;
    $garden = isset($_POST['garden']) ? 1 : 0;
    $sacada = isset($_POST['sacada']) ? 1 : 0;
    $lavanderia = isset($_POST['lavanderia']) ? 1 : 0;
    $suite = isset($_POST['suite']) ? 1 : 0;
    $elevador = isset($_POST['elevador']) ? 1 : 0;
    $lazer = isset($_POST['lazer']) ? 1 : 0;


    $db->atualizarImovel(
        $id,
        $titulo,
        $bairro,
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
        $data_atualizacao
    );
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

    $pastaImagem = 'users/' . $pasta . '/' . $pastaImgPorDatatime . '/';


    // Count total files
    $countfiles = $_FILES;

    // **********************************************************
    // ********************* atualizando imóvel *******************
    // ********************************************************** 

    $db->uploadImagens($id, $pastaImagem, $_FILES["fileUpload"]);
    // $db->cropImages($ultimoImovelId, $_FILES["fileUpload"],  $pastaImagem, $size = 500 );

header("Location: editar.php?id=$id");


} else {

    // tamanho da imagem superior
    echo "tamanho excede!";

    $_SESSION['imagem'] = 'grande';
}


?>
<?php ob_end_flush(); ?>