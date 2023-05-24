<?php
date_default_timezone_set('America/Cuiaba');
require_once "config/DB.php";

$db = new DB;

$conn = $db->getConnection();

$bairroId = $db->getBairros();

// echo "<pre>";
// print_r($bairroId);
// echo "<pre>";



// define a página atual (se não definiu, assume o valor 1)
$page = isset($_GET['apartamentos']) ? (int) $_GET['apartamentos'] : 1;

// define a quantidade de resultados por página
$registros_por_pagina = 1;

// chama a função de paginação
$data = $db->paginarImoveisComImagens($page, $registros_por_pagina);

// echo "<pre>";
// var_dump($data);
// echo "</pre>";
// pegando filtros


// echo "<pre>";
// print_r($data);
// echo "</pre>";

$urlImg = __DIR__ . "/app";

// $urlBase = __DIR__ . "/";
// talvez tenha que trocar a url
$urlBase = "http://localhost/casaavendacuiaba/";

// var_dump($urlImg);


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="imagem/icon.png">
  <!-- metas -->
  <meta property="og:title" content="Apartamento a Venda Cuiaba" />
  <meta property="og:description" content="Encontre os diversos apartamentos em todos os bairros de Cuiabá que estãõ anunciados a venda." />
  <meta property="og:url" content="https://www.apartamentoavendacuiaba.com.br" />
  <meta property="og:image" content="" />

  <meta property="og:image:secure_url" content="" />
  <meta property="og:image:type" content="image/jpeg" />
  <meta property="og:image:width" content="500" />
  <meta property="og:image:height" content="500" />
  <meta property="og:image:alt" content="" />
  <!-- CSS only -->
  <link rel="stylesheet" href="css/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
  <title>Apartamento a Venda Cuiabá</title>
</head>

<body>
  <header class="main">
    <nav class="menu">
      <div class="container">
        <div class="logo">
          <img src="imagem/logo.png" class="img-fluid logo-img" alt="" srcset="" />
        </div>
      </div>
    </nav>
  </header>
  <div class="filter-main">
    <div class="container filter-main-search">
      <form action="apartamentos.php" method="" enctype="multipart/form-data">
        <div class="row">
          <div class="col-xl-3 col-md-3 col-sm-12 search-nivel">
            <select class="form-select" name="bairro">
              <option value="" selected>Qual o melhor bairro para você?</option>
              <?php foreach ($bairroId as $bairro) {?>
              <option value="<?php echo $bairro['id']?>"><?php echo $bairro['nome']?></option>
              <?php } ?>
              
            </select>
          </div>
          <div class="col-xl-3 col-md-3 col-sm-12 search-nivel">
            <select class="form-select" name="valor">
              <option value="" selected>Faixa de valor do Imóvel?</option>
              <option value="100000-200000">100mil - 200mil</option>
              <option value="200001-300000">201mil - 300mil</option>
              <option value="300001-400000">301mil - 400mil</option>
              <option value="400001-500000">401mil - 500mil</option>
              <option value="500001-600000">501mil - 600mil</option>
              <option value="600001-700000">601mil - 700mil</option>
              <option value="700001-800000">701mil - 800mil</option>
              <option value="800001-900000">801mil - 900mil</option>
              <option value="900001-1000000">901mil - 1 Milhão</option>
              <option value="1000001-999999999">Acima de 1 Milhão</option>
            </select>
          </div>
          <div class="col-xl-3 col-md-3 col-sm-12 search-nivel">
            <select class="form-select" name="quarto">
              <option value="" selected>Você prefere com quantos quartos?</option>
              <option value="1">1 Quarto</option>
              <option value="2">2 Quartos</option>
              <option value="3">3 Quartos</option>
              <option value="4">4 Quartos</option>
              <option value="5">5 Quartos</option>
            </select>
          </div>

          <div class="col-xl-3 col-md-3 col-sm-12 search-nivel">
            <input type="submit" name="enviar" value="Buscar Apartamento" class="btn btn-outline-success search text-center">
              <!-- 🔎 Buscar Apartamento
            </button> -->
          </div>
        </div>
      </form>
    </div>
  </div>
  <section id="imovel-main" class="imovel-main">
    <div class="container">
      <div class="row">

      <h2 class="resultados">Total de Resultados: <?php echo $data['registros'] ;?></h2>

        <!-- ITEM MOBILE FIRST -->

        <!-- ITEM -->
        <?php foreach ($data['resultados'] as $key => $value) {
          # codigo
        

          // $urlAntiga = $urlBase . "single.php?codimovel=" . $value['cod_imovel'];
          $urlAntiga = $urlBase;
          $tituloDeImovel = $value['titulo'];
          $codigoImovel = $value['cod_imovel'];
          // // echo $urlAntiga;
          // // exemplo de URL original
          // // $url = "http://localhost/casaavendacuiaba/single.php?codimovel=20230001";
        
          // http://localhost/casaavendacuiaba/single.php
        


          // // obter o título do imóvel e o código do imóvel do banco de dados
          // $titulo_imovel = $value['titulo'];
          // $codigo_imovel = $value['cod_imovel'];
        
          // // transformar o título em uma string URL amigável
          // $titulo_amigavel = strtolower($titulo_imovel);
          // $titulo_amigavel = preg_replace('/[^a-zA-Z0-9]/', '-', $titulo_amigavel);
          // $titulo_amigavel = trim($titulo_amigavel, '-');
        
          // // criar a nova URL amigável
          // $nova_url = $url . $titulo_amigavel . "-" . $codigo_imovel;
        
          // // exibir a nova URL
          // echo $nova_url;
        
          $imovelUrl = $db->criar_url_amigavel($urlAntiga, $tituloDeImovel, $codigoImovel);
       
          ?>
          <div class="col-md-8 offset-md-2 imovel">
            <!-- <a href="single.php?codimovel=aqui vai o php" target="_blank"> -->
            <a href="<?php echo $imovelUrl; ?>" target="_blank">
              <div class="col-sm-4 imovel-img-l">
                <img src="<?php echo "app/" . $value['url']; ?>" class="img-fluid img-imovel" alt="" />
              </div>
              <div class="col-sm-8 imovel-img-r">
                <div class="tituloepreco">
                  <div class="col-8 col-sm-12 tituloimovel">
                    <h1>
                      <?php echo $value['titulo']; ?>
                    </h1>
                  </div>
                  <div class="col-4 col-sm-12 precoimovel">
                    <h2>
                      <?php
                      
                      $valorImovel = $value['valor'];
                      $valorImovelMostrar = $valorImovel / 100;
                      $valorImovelFormatado = number_format($valorImovelMostrar,2,",",".");
                      echo $valorImovelFormatado;
                      
                      ?>
                    </h2>
                  </div>
                </div>

                <div class="imovel-itens">
                  <ul>
                    <li class="iconscondominio">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="16" height="16" size="16"
                        color="currentColor">
                        <path fill="currentColor" fill-rule="evenodd"
                          d="M26.978 13.293V5.717c0-.104.032-.2.086-.28a.498.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM901-.09.286c.057.08.09.179.09.285v7.655c.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9.95 0 1.79.499 2.245 1.24a2.633 2.633 0 012.244-1.24h4.766c1.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9.436c.04.141.017.281-.05.394a.5.5 0 01.027.165v5.986a.5.5 0 01-.5.5h-4.192a.5.5 0 01-.5-.5v-2.533H6.668v2.533a.5.5 0 01-.5.5H1.975a.5.5 0 01-.5-.5v-5.986a.5.5 0 01.028-.165.496.496 0 01-.05-.396l2.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9-.09-.286c0-1.235 1.015-2.243 2.273-2.31a.505.505 0 01.059-.003h19.504c.082 0 .16.02.228.055 1.072.23 1.884 1.154 1.884 2.258 0 .104-.031.2-.085.28a.498.498 0 01.093.291v7.716c0 .017 0 .035-.002.052zm-11.229-.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM91.603 1.501v.69zm-9.255.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9 1.502v1.12zm22.244 9.824H2.476v5.406h3.192v-2.533a.5.5 0 01.5-.5h19.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9.019l-2.206 7.49z">
                        </path>
                      </svg> <?php echo $value['quartos']; ?> |
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="16" height="16" size="16"
                        color="currentColor">
                        <path fill="currentColor" fill-rule="evenodd"
                          d="M12.281 17.168v3.754a.5.5 0 01-.5.5H2.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9 0 11-1 0v-7.9h-9.387v14.63H22.6a.5.5 0 110 1H12.281zm-9.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9.637a.5.5 0 01.5.5v28.113a.5.5 0 01-.5.5h-7.903V31a.5.5 0 01-1 0v-1.35h-5.31V31a.5.5 0 11-1 0v-1.35H1.934a.5.5 0 01-.5-.5V15.61H1a.5.5 0 110-1h.813a.501.501 0 01.243 0h.813a.5.5 0 110 1h-.435v4.812z">
                        </path>
                      </svg> <?php echo $value['area_construida']; ?> |
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="16" height="16" size="16"
                        color="currentColor">
                        <path fill="currentColor" fill-rule="evenodd"
                          d="M16.002 25.389c-3.058 0-5.706-.103-7.944-.31v1.79c0 1.012-.82 1.833-1.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM91.649 1.194-3.114-1.55-.575-2.183-1.58-1.695-2.917.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9638 6.078.371 9.015.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9342-1.695 2.917.7 1.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM975a1.833 1.833 0 01-1.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9 00.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM91.65-.225-2.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9036-.632-.074-.934-.115zm19.618-.991c2.354-.32 3.524-.878 3.599-1.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM91.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9.251-4.664-.21-.347-3.344-.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9-1.444-.605-2.18-.441-2.49.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9031 2.004.178 4.226.076.61 1.246 1.168 3.6 1.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9.492 2.246 2.246 0 010 4.492zm0-1a1.246 1.246 0 100-2.492 1.246 1.246 0 000 2.492zm19.556 1a2.246 2.246 0 110-4.492 2.246 2.246 0 010 4.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM955v-1h8.928v1h-8.928z">
                        </path>
                      </svg> <?php echo $value['garagem']; ?>
                    </li>
                    <li class="bairro"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"
                        size="16" color="currentColor">
                        <path fill="currentColor" fill-rule="evenodd"
                          d="M17.044 19.64a30.885 30.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM930.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9365 9.75 9.75c0 3.294-1.774 6.546-4.706 9.64zm-4.105 1.726a29.402 29.402 0 003.017-2.757c2.693-2.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9 0012 22.082c.285-.207.6-.4B8r3B4p7yhRXuBWLqsQ546WR43cqQwrbXMDFnBi6vSJBeif8tPW85a7r7DM961Jvk4hdryZoByEp8GC8HzsqJpRN4FxGM9.25 0 000 4.5z">
                        </path>
                      </svg> Bairro: <?php echo $value['id_bairro']; ?></li>

                  </ul>

                </div>

                <!-- <div class="precoImovelBtn btn btn-outline-success">Ver imóvel</div> -->
              </div>
            </a>
          </div>

        <?php } ?>


      </div>

    </div>

    <!-- /item -->

    </div>
    </div>
  </section>

  <!-- <div class="paginacao">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>

  </div> -->

  <div class="pagination">
    <?php

    // Links da paginação
// echo $data['links_paginacao'];
    $links_paginacao = $data['links_paginacao'];
    echo $links_paginacao;

    ?>

  </div>

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
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>


</body>

</html>