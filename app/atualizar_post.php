<?php
// Inclua o arquivo de configuração do banco de dados, se necessário
require_once "../config/DB.php";
require_once "./logado.php";

$db = new DB;

$conn = $db->getConnection();

// // Verifica se o usuário está logado


// $fotoPerfil = $_FILES['fotoPerfil'];
// echo "<pre>";
// print_r($fotoPerfil);
// echo "</pre>";

// if (!isset($_SESSION['user'])) {
//     echo json_encode(['error' => 'Usuário não logado']);
//     exit;
// }

if (isset($_POST['enviar'])) {

    $dados = $_REQUEST;

    // echo "<pre>";
    // print_r($dados);
    // echo "</pre>";


    
    // $img = $_FILES['fotoPerfil'];

    // echo "<pre>";
    // print_r($img);
    // echo "</pre>";

    

    # code...
    // Recebe os dados do formulário
    $nome_user = $_POST['nome'];
    $imob_autonomo = $_POST['regime'];
    $whatsapp = $_POST['whatsapp'];
    $email = $_SESSION['user'];
    // $img = $filePath;
    $descricao_user = $_POST['descricao_user'];
    $fb = $_POST['fb'];
    $ig = $_POST['ig'];
    $linkedin = $_POST['linkedin'];
    $site = $_POST['site'];
    $creci = $_POST['creci'];
    $access_type = 'user';
    $payment = "free";



    $db->saveUserData(
        $nome_user,
        $imob_autonomo,
        $whatsapp,
        $email,
        // $img,
        $descricao_user,
        $fb,
        $ig,
        $linkedin,
        $site,
        $creci,
        $access_type,
        $payment
    );




    header("Location: perfil.php");

}

if (isset($_POST['editar'])) {

    echo "entrou";
    # code...

    $img = $_FILES['img'];

    var_dump($img);

    // Verifique se um arquivo foi enviado
if (!empty($img['tmp_name'])) {
    // Diretório onde as imagens serão armazenadas
    $pasta = md5($_SESSION['user']);
    $uploadDir = 'users/' . $pasta . '/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Gere um nome de arquivo único para evitar conflitos
    $filename = 'perfil';

    // Determinar a extensão do arquivo
    $extension = '';

    // Verificar o tipo MIME do arquivo
    $fileType = $img['type'];

    if ($fileType === 'image/jpeg' || $fileType === 'image/jpg') {
        $extension = 'jpg';
    } elseif ($fileType === 'image/png') {
        $extension = 'png';
    } else {
        // Tipo de arquivo não suportado
        // Retornar um erro ou fazer qualquer tratamento necessário
    }

    // Se a extensão for vazia, o tipo de arquivo não é suportado
    if (!empty($extension)) {
        // Adicionar a extensão ao nome do arquivo
        $filename .= '.' . $extension;

        // Caminho completo para salvar a imagem
        $filePath = $uploadDir . $filename;

        // Redimensionar a imagem para no máximo 300 pixels de altura e largura
        $maxSize = 300;
        $source = imagecreatefromstring(file_get_contents($img['tmp_name']));
        $width = imagesx($source);
        $height = imagesy($source);
        $aspectRatio = $width / $height;

        if ($width > $maxSize || $height > $maxSize) {
            if ($aspectRatio > 1) {
                $newWidth = $maxSize;
                $newHeight = $maxSize / $aspectRatio;
            } else {
                $newHeight = $maxSize;
                $newWidth = $maxSize * $aspectRatio;
            }

            $thumb = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // Salvar a imagem redimensionada na pasta do usuário
            if ($extension === 'jpg') {
                imagejpeg($thumb, $filePath);
            } elseif ($extension === 'png') {
                imagepng($thumb, $filePath);
            }

            // Liberar a memória da imagem redimensionada
            imagedestroy($thumb);
        } else {
            // Salvar a imagem original na pasta do usuário
            move_uploaded_file($img['tmp_name'], $filePath);
        }

    
    }
}

$db->atualizarImagemPerfil($_SESSION['user'],$filePath);


}


header("Location: perfil.php");


// try {
//     // Conexão com o banco de dados


//     // Verifica se o registro do usuário já existe no banco de dados
//     $query = "SELECT * FROM perfil WHERE email = :email";
//     $stmt = $conn->prepare($query);
//     $stmt->bindValue(':email', $email, PDO::PARAM_STR);
//     $stmt->execute();
//     $row = $stmt->fetch(PDO::FETCH_ASSOC);

//     if ($row) {
//         // Atualiza os dados do usuário existente no banco de dados
//         $query = "UPDATE perfil SET nome = :nome, imob_autonomo = :imob_autonomo, whatsapp = :whatsapp, img = :img, descricao_user = :descricao_user, fb = :fb, ig = :ig, linkedin = :linkedin, site = :site, creci = :creci WHERE email = :email";
//     } else {
//         // Insere um novo registro para o usuário no banco de dados
//         $query = "INSERT INTO sua_tabela (nome, imob_autonomo, whatsapp, email, img, descricao_user, fb, ig, linkedin, site, creci, access_type, payment) VALUES (:nome, :imob_autonomo, :whatsapp, :email, :img, :descricao_user, :fb, :ig, :linkedin, :site, :creci, :access_type, :payment)";
//     }

//     // Prepara e executa a consulta
//     $stmt = $conn->prepare($query);
//     $stmt->bindValue(':nome', $nome_user, PDO::PARAM_STR);
//     $stmt->bindValue(':imob_autonomo', $imob_autonomo, PDO::PARAM_STR);
//     $stmt->bindValue(':whatsapp', $whatsapp, PDO::PARAM_STR);
//     $stmt->bindValue(':email', $email, PDO::PARAM_STR);
//     $stmt->bindValue(':img', $img, PDO::PARAM_STR);
//     $stmt->bindValue(':descricao_user', $descricao_user, PDO::PARAM_STR);
//     $stmt->bindValue(':fb', $fb, PDO::PARAM_STR);
//     $stmt->bindValue(':ig', $ig, PDO::PARAM_STR);
//     $stmt->bindValue(':linkedin', $linkedin, PDO::PARAM_STR);
//     $stmt->bindValue(':site', $site, PDO::PARAM_STR);
//     $stmt->bindValue(':creci', $creci, PDO::PARAM_STR);
//     $stmt->bindValue(':access_type', $access_type, PDO::PARAM_STR);
//     $stmt->bindValue(':payment', $payment, PDO::PARAM_NULL);

//     $stmt->execute();

//     // Verifica se a operação de atualização ou inserção foi bem-sucedida
//     if ($stmt->rowCount() > 0) {
//         // Atualiza o valor do $_SESSION['user'], se necessário
//         $_SESSION['user'] = $email;

//         // Retorna os dados atualizados como uma resposta JSON
//         $response = [
//             'nome' => $nome_user,
//             'imob_autonomo' => $imob_autonomo,
//             'whatsapp' => $whatsapp,
//             'img' => $img,
//             'descricao_user' => $descricao_user,
//             'fb' => $fb,
//             'ig' => $ig,
//             'linkedin' => $linkedin,
//             'site' => $site,
//             'creci' => $creci,
//             'access_type' => $access_type,
//             'payment' => $payment
//         ];

//         echo json_encode($response);
//     } else {
//         echo json_encode(['error' => 'Falha ao atualizar os dados']);
//     }
// } catch (PDOException $e) {
//     echo json_encode(['error' => 'Erro no banco de dados: ' . $e->getMessage()]);
// }
