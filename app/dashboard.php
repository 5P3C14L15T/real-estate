<?php
require_once "../config/DB.php";
require_once "./logado.php";

$db = new DB;
$usuario = $db->getUser($_SESSION['user']);



$pdo = $db->getConnection();

// var_dump($pdo);


$userId = $usuario[0]['id'];

echo $userId;

// $perPage = 10;
// $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// $stmtCount = $pdo->prepare('SELECT COUNT(*) FROM imovel WHERE id_proprietario = :id_prop');
// $stmtCount->bindValue(':id_prop', $userId, PDO::PARAM_INT);
// $stmtCount->execute();
// $total = $stmtCount->fetchColumn();

// // echo $total;

// $stmt = $pdo->prepare('SELECT * FROM imovel WHERE id_proprietario = :id_prop LIMIT :offset, :limit');
// $stmt->bindValue(':id_prop', $userId, PDO::PARAM_INT);
// $stmt->bindValue(':offset', ($page - 1) * $perPage, PDO::PARAM_INT);
// $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
// $stmt->execute();
// $row = $stmt->fetch(PDO::FETCH_ASSOC);

// var_dump($row);


// echo '<table>';
// while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//   echo '<tr>';
//   echo '<td>' . $row['id_proprietario'] . '</td>';
//   echo '<td>' . $row['titulo'] . '</td>';
//   // echo '<td>'.$row['cidade'].'</td>';
//   // ... exibe outras colunas da tabela ...
//   echo '</tr>';
// }
// echo '</table>';

// var_dump($row);

// echo $db->paginationLinks($total, $page, $perPage, $_SERVER['PHP_SELF'] . '?id_prop=' . $userId);


// definir o número de resultados por página
$perPage = 10;

// obter o id do proprietário da URL
$id_prop = isset($_GET['id_prop']) ? $_GET['id_prop'] : '';

// validar o id do proprietário
// if (!is_numeric($id_prop) || $id_prop <= 0) {
//   echo "ID do proprietário inválido.";
//   exit;
// }

// obter o número total de resultados
$stmtCount = $pdo->prepare("SELECT COUNT(*) AS total FROM imovel WHERE id_proprietario = ?");
$stmtCount->execute([$userId]);
$total = $stmtCount->fetchColumn();

// obter o número da página atual
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$page = max(min($page, ceil($total / $perPage)), 1);

// calcular o offset dos resultados na consulta
$offset = ($page - 1) * $perPage;

// obter os resultados da página atual
$stmt = $pdo->prepare("SELECT * FROM imovel WHERE id_proprietario = ? ORDER BY id_proprietario ASC LIMIT ?, ?");
$stmt->bindValue(1, $userId, PDO::PARAM_INT);
$stmt->bindValue(2, $offset, PDO::PARAM_INT);
$stmt->bindValue(3, $perPage, PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// select image by id imovel

// var_dump($db->getImageByIdImovel(9));



// // exibir os resultados em uma tabela
// echo '<table>';
// echo '<tr><th>ID do imóvel</th><th>Endereço</th><th>Cidade</th><th>Estado</th></tr>';
// foreach ($results as $row) {
//   echo '<tr>';
//   echo '<td>' . $row['cod_imovel'] . '</td>';
//   // echo '<td>'.$row['endereco'].'</td>';
//   // echo '<td>'.$row['cidade'].'</td>';
//   // echo '<td>'.$row['estado'].'</td>';
//   echo '</tr>';
// }
// echo '</table>';

// // exibir os links de paginação
// echo '<div class="pagination">';
// echo '<a href="' . $_SERVER['PHP_SELF'] . '?id_prop=' . $id_prop . '&page=' . ($page - 1) . '">&laquo; Anterior</a>';
// for ($i = max(1, $page - 3); $i <= min($page + 3, ceil($total / $perPage)); $i++) {
//   if ($i == $page) {
//     echo '<span class="current">' . $i . '</span>';
//   } else {
//     echo '<a href="' . $_SERVER['PHP_SELF'] . '?id_prop=' . $id_prop . '&page=' . $i . '">' . $i . '</a>';
//   }
// }
// echo '<a href="' . $_SERVER['PHP_SELF'] . '?id_prop=' . $id_prop . '&page=' . ($page + 1) . '">Próxima &raquo;</a>';
// echo '</div>';



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- CSS only -->
  <link rel="stylesheet" href="css/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
  <script src="https://kit.fontawesome.com/6c66823518.js" crossorigin="anonymous"></script>
  <title>Apartamento a Venda Cuiabá</title>
</head>

<body>
  <header class="main">
    <nav class="menu">
      <div class="container">
        <div class="logo">
          <a href="../index.php">
          <img src="imagem/logo.png" class="img-fluid logo-img" alt="" />
          </a>
        </div>
      </div>
    </nav>
  </header>

  <nav class="componentes">
    <div class="container">
      <div class="row">

        <!-- mensagem caso não tenha atualizado whatsapp -->

        <?php
        $db->verificarWhatsAppPerfil($_SESSION['user']);

        $db->verificarRegistroImovel($userId);



        ?>

        <!-- <div class="col-md-12 my-2">
          <div class="alert alert-warning" role="alert">
            Seja PREMIUM para inserir imóveis ILIMITADOS.
          </div>
        </div> -->

        <div class="col-md-3 my-3">
          <a href="add.php" id="btnAddNovoImovel" class="alert alert-success d-block">Add Novo Imóvel</a>
        </div>

        <script>
          document.getElementById("btnAddNovoImovel").disabled = true;

        </script>
        <div class="col-md-3 my-3">
          <a href="perfil.php" class="alert alert-primary d-block">Editar Perfil</a>
        </div>
        <div class="col-md-3 my-3">
          <a href="./logout.php" class="alert alert-secondary d-block">Sair do Dashboard</a>
        </div>
        <div class="col-md-3 my-3">
          <a href="../planos.php" class="alert alert-warning d-block"><img class="img-fluid" width="25"
              src="imagem/medal.svg"> PREMIUM</a>
        </div>
      </div>
    </div>
  </nav>

  <section class="main mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped tabela-post">
            <thead>
              <tr>
                <th class="text-center">#ID Imóvel</th>
                <!-- <th class="text-center">Imagem</th> -->
                <th class="text-center">Título do Imóvel</th>
                <th colspan="2" class="text-center">Ações</th>
              </tr>
            </thead>
            <tbody>


              <?php

              // exibir os resultados em uma tabela
              
              // echo '<tr><th scope="row" class="text-center">ID do imóvel</th><th>Imagem</th><th>Titulo do Imóvel</th><th>Ação</th></tr>';
              foreach ($results as $row) {



                $urlBase = "http://localhost/apartamentoavendacuiaba/real-estate/";
                $urlAntiga = $urlBase;
                $tituloDeImovel = $row['titulo'];
                $codigoImovel = $row['cod_imovel'];


                $imovelUrl = $db->criar_url_amigavel($urlAntiga, $tituloDeImovel, $codigoImovel);

                if ($row['status'] == 1) {
                  $checked = "checked";
                  $check = "Ativo";
                } else {
                  $checked = "";
                  $check = "Desativado";
                }



                echo '<tr>';
                echo '<td>' . $row['cod_imovel'] . '</td>';
                // echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['titulo'] . '</td>';
                echo '<td>';

                // Imprime o checkbox com o valor correspondente e o ID do imóvel
                echo '<div class="form-check form-switch">';
                echo '<input class="form-check-input" name="status" ' . $checked . ' type="checkbox" value="' . $row['status'] . '" onclick="redirecionar(this, ' . $row['id_imovel'] . ')">';
                echo '<label class="form-check-label">' . $check . '</label>';
                echo '</div>';

                '</td>';
                echo '<td class="text-center icons-action">
    <a href="editar.php?id=' . $row['id_imovel'] . '" title="Editar"> <i class="fas fa-edit"></i></a>
    <a href="deletar.php?id=' . $row['id_imovel'] . '" title="Deletar"><i class="fas fa-trash-alt"></i></a>
    <a href="' . $imovelUrl . '" target="_blank" title="Ver Imóvel"><i class="fas fa-home"></i></a>

  </td>';
                echo '</tr>';


              }


              ?>




              <!-- <td class="text-center"><img class="rounded img-fluid" width="40" src="imagem/casa.jpg" alt=""></td>
                <td class="text-center">
                  <?php echo $row['titulo'] ?>
                </td>
                <td class="text-center icons-action">
                  <a href="#!" title="Editar"> <i class="fas fa-edit"></i></a>
                  <a href="#!" title="Deletar"><i class="fas fa-trash-alt"></i></a>
                  <a href="#!" title="Ver Imóvel"><i class="fas fa-home"></i></a>

                </td> -->
              <!-- </tr> -->
            </tbody>
          </table>

          <?php

          // exibir os links de paginação
          echo '<nav><ul class="pagination justify-content-center">';
          echo '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?id_prop=' . $id_prop . '&page=' . ($page - 1) . '">&laquo; Anterior</a></li>';
          for ($i = max(1, $page - 3); $i <= min($page + 3, ceil($total / $perPage)); $i++) {
            if ($i == $page) {
              echo '<li class="page-item"><a class="current page-link">' . $i . '</a></li>';
            } else {
              echo '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?id_prop=' . $id_prop . '&page=' . $i . '">' . $i . '</a></li>';
            }
          }
          echo '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?id_prop=' . $id_prop . '&page=' . ($page + 1) . '">Próxima &raquo;</a></li>';
          echo '</ul></nav>';

          ?>

          <!-- <nav>
            <ul class="pagination justify-content-center">
              <li class="page-item disabled">
                <a class="page-link" href="#">Anterior</a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">2</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">Próxima</a>
              </li>
            </ul>
          </nav> -->
        </div>

        <!-- <div class="col-md-3">
           <div class="row">
            <div class="post-views">
                <h2>Visualizações</h2>
                <i class="fas fa-eye"></i>
                
                <h3>234 Totais</h3>
            </div>
            <div class="mais-visu">
                <h3>Casas mais visualizadas</h3>
                <ul>
                    <li><a href="#!"><i class="fas fa-eye"></i> 343 Views - Apartamemnto 3 quartos goiabeiras</a></li>
                    <li><a href="#!"><i class="fas fa-eye"></i> 343 Views - Apartamemnto 3 quartos goiabeiras</a></li>
                    <li><a href="#!"><i class="fas fa-eye"></i> 343 Views - Apartamemnto 3 quartos goiabeiras</a></li>
                    <li><a href="#!"><i class="fas fa-eye"></i> 343 Views - Apartamemnto 3 quartos goiabeiras</a></li>
                    <li><a href="#!"><i class="fas fa-eye"></i> 343 Views - Apartamemnto 3 quartos goiabeiras</a></li>
                    <li><a href="#!"><i class="fas fa-eye"></i> 343 Views - Apartamemnto 3 quartos goiabeiras</a></li>
                    <li><a href="#!"><i class="fas fa-eye"></i> 343 Views - Apartamemnto 3 quartos goiabeiras</a></li>
                    <li><a href="#!"><i class="fas fa-eye"></i> 343 Views - Apartamemnto 3 quartos goiabeiras</a></li>
                    <li><a href="#!"><i class="fas fa-eye"></i> 343 Views - Apartamemnto 3 quartos goiabeiras</a></li>
                    <li><a href="#!"><i class="fas fa-eye"></i> 343 Views - Apartamemnto 3 quartos goiabeiras</a></li>
                    <li><a href="#!"><i class="fas fa-eye"></i> 343 Views - Apartamemnto 3 quartos goiabeiras</a></li>
                    
                </ul>
            </div>
           </div>
        </div> -->
      </div>
    </div>
  </section>

  <footer class="footer">
    <div class="container">
      <div class="row">
        <h1>APARTAMENTOAVENDACUIABA.COM.BR</h1>
        <p>&copy; Todos os Direitos Reservados</p>
      </div>
    </div>
  </footer>

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">

    </script>
  <script>
    function redirecionar(checkbox, idImovel) {
      // Verifica o estado do checkbox (marcado/desmarcado)
      var valor;
      if (checkbox.checked) {
        valor = 1; // Valor quando o checkbox está marcado (ativado)
      } else {
        valor = 2; // Valor quando o checkbox está desmarcado (desativado)
      }

      // Monta a URL com os parâmetros
      var url = 'ativa_desativar.php?idImovel=' + encodeURIComponent(idImovel) + '&valor=' + encodeURIComponent(valor);

      // Redireciona para a outra página
      window.location.href = url;
    }
  </script>
</body>

</html>