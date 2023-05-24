<?php
date_default_timezone_set('America/Cuiaba');
require_once "config/DB.php";

$db = new DB;

$conn = $db->getConnection();

$bairroId = $db->generateBairroOptions();
// $faixaValor = $db->faixaValor();
$lista = $db->generateSelectOptions();

// quartos

$quartos = $db->generateQuartoOptions();

// echo "<pre>";
// print_r($lista);
// echo "<pre>";



// define a página atual (se não definiu, assume o valor 1)
$page = isset($_GET['apartamentos']) ? (int) $_GET['apartamentos'] : 1;
if (isset($_GET['bairro']) and $_GET['bairro'] !== '') {
  $bairro = $_GET['bairro'];
  # code...
} else {

  $bairro = null;
}
if (isset($_GET['valor']) and $_GET['valor'] !== '') {
  $valor = $_GET['valor'];
  # code...
} else {

  $valor = null;
}
if (isset($_GET['quarto']) and $_GET['quarto'] !== '') {
  $quarto = $_GET['quarto'];
  # code...
} else {

  $quarto = null;
}
// $valor = isset($_GET['valor']) ? $_GET['valor'] : null;
// $quarto = isset($_GET['quarto']) ?  $_GET['quarto'] : null;

// var_dump($bairro);

// define a quantidade de resultados por página
$registros_por_pagina = 1;

// chama a função de paginação
// $data = $db->paginarImoveisComImagens($page, $registros_por_pagina);

$data = $db->pagImoImg($page, $registros_por_pagina, $bairro, $valor, $quarto);



// echo "<pre>";
// print_r($dataFilter);
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
      <form action="./" method="get" enctype="multipart/form-data">
        <div class="row">
          <div class="col-xl-3 col-md-3 col-sm-12 search-nivel">
            <select class="form-select" name="bairro">
              <option value="" selected>Qual o melhor bairro para você?</option>
              <?php 
              echo $bairroId;
               ?>
              
            </select>
          </div>
          <div class="col-xl-3 col-md-3 col-sm-12 search-nivel">
            <select class="form-select" name="valor">

           
              <option value="" selected>Faixa de valor do Imóvel?</option>
              <?php 
              echo $lista;
               ?>
            </select>
          </div>
          <div class="col-xl-3 col-md-3 col-sm-12 search-nivel">
            <select class="form-select" name="quarto">
              <option value="" selected>Você prefere com quantos quartos?</option>
              <?php 
              echo $quartos;
               ?>
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

      <h2 class="resultados">
        
      <?php if (isset($_GET['enviar']) and $_GET['enviar'] == "Buscar Apartamento") {
        
      } else {
# code...
echo "Total de Resultados: " . $data['registro'] ;

      }
      
      ?>
      
    </h2>

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
                          d="M26.978 13.293V5.717c0-.104.032-.2.086-.28a.498.498 0 01-.094-.29c0-.715-.629-1.314-1.405-1.314H6.427c-.777 0-1.405.598-1.405 1.313a.498.498 0 01-.09.286c.057.08.09.179.09.285v7.655c.475-.067.968-.13 1.473-.187a.505.505 0 01-.003-.057V11.96c0-1.38 1.177-2.502 2.602-2.502h4.767c.95 0 1.79.499 2.245 1.24a2.633 2.633 0 012.244-1.24h4.766c1.426 0 2.602 1.12 2.602 2.502v1.151c.446.056.867.117 1.26.183zm.998.192a.5.5 0 01.35.344l2.433 8.436c.04.141.017.281-.05.394a.5.5 0 01.027.165v5.986a.5.5 0 01-.5.5h-4.192a.5.5 0 01-.5-.5v-2.533H6.668v2.533a.5.5 0 01-.5.5H1.975a.5.5 0 01-.5-.5v-5.986a.5.5 0 01.028-.165.496.496 0 01-.05-.396l2.487-8.437a.5.5 0 01.118-.205.499.499 0 01-.036-.188V5.717c0-.106.033-.204.09-.285a.498.498 0 01-.09-.286c0-1.235 1.015-2.243 2.273-2.31a.505.505 0 01.059-.003h19.504c.082 0 .16.02.228.055 1.072.23 1.884 1.154 1.884 2.258 0 .104-.031.2-.085.28a.498.498 0 01.093.291v7.716c0 .017 0 .035-.002.052zm-11.229-.835c2.896-.002 5.683.115 7.971.347V11.96c0-.818-.717-1.501-1.602-1.501H18.35c-.883 0-1.603.685-1.603 1.501v.69zm-9.255.43a95.338 95.338 0 017.971-.421v-.7c0-.818-.719-1.502-1.602-1.502H9.094c-.883 0-1.602.685-1.602 1.502v1.12zm22.244 9.824H2.476v5.406h3.192v-2.533a.5.5 0 01.5-.5h19.876a.5.5 0 01.5.5v2.533h3.192v-5.406zm-27.134-1h27.012l-2.166-7.509c-4.9-.98-15.709-1.013-22.64.019l-2.206 7.49z">
                        </path>
                      </svg> <?php echo $value['quartos']; ?> |
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="16" height="16" size="16"
                        color="currentColor">
                        <path fill="currentColor" fill-rule="evenodd"
                          d="M12.281 17.168v3.754a.5.5 0 01-.5.5H2.434v7.229h12.924V27.3a.5.5 0 011 0v1.35h5.31V27.3a.5.5 0 111 0v1.35h7.403V1.538h-7.403v7.9a.5.5 0 11-1 0v-7.9h-9.387v14.63H22.6a.5.5 0 110 1H12.281zm-9.847 3.254h8.847V1.538H2.434v5.246h.435a.5.5 0 110 1H1a.5.5 0 110-1h.434V1.038a.5.5 0 01.5-.5h28.637a.5.5 0 01.5.5v28.113a.5.5 0 01-.5.5h-7.903V31a.5.5 0 01-1 0v-1.35h-5.31V31a.5.5 0 11-1 0v-1.35H1.934a.5.5 0 01-.5-.5V15.61H1a.5.5 0 110-1h.813a.501.501 0 01.243 0h.813a.5.5 0 110 1h-.435v4.812z">
                        </path>
                      </svg> <?php echo $value['area_construida']; ?> |
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="16" height="16" size="16"
                        color="currentColor">
                        <path fill="currentColor" fill-rule="evenodd"
                          d="M16.002 25.389c-3.058 0-5.706-.103-7.944-.31v1.79c0 1.012-.82 1.833-1.833 1.833H3.418c-1 0-1.815-.8-1.833-1.8l-.129-7.133c-.03-.818-.02-1.404.036-1.767.097-.622.494-1.649 1.194-3.114-1.55-.575-2.183-1.58-1.695-2.917.498-1.364 1.692-1.73 3.363-1.16 1.067-2.33 1.766-3.768 2.11-4.339.491-.816 3.428-1.267 9.566-1.638 6.078.371 9.015.822 9.506 1.638.344.571 1.043 2.01 2.11 4.339 1.671-.57 2.865-.204 3.363 1.16.488 1.338-.145 2.342-1.695 2.917.7 1.465 1.097 2.492 1.194 3.114.056.363.066.948.03 1.767l-.123 7.133c-.018 1-.834 1.8-1.833 1.8H25.75a1.833 1.833 0 01-1.834-1.833V25.08c-2.231.205-4.87.308-7.915.308zm8.915 1.48c0 .46.373.833.834.833h2.83a.833.833 0 00.834-.818l.056-3.097c-.741.504-1.946.85-3.595 1.074-.31.042-.63.081-.959.118v1.89zM6.124 24.86c-1.65-.225-2.854-.57-3.595-1.077l.056 3.1a.833.833 0 00.833.818h2.807c.46 0 .833-.373.833-.833v-1.893c-.32-.036-.632-.074-.934-.115zm19.618-.991c2.354-.32 3.524-.878 3.599-1.472.21-2.238.268-3.671.179-4.242-.088-.56-.542-1.693-1.357-3.348l-.268-.545.587-.158c1.46-.395 1.895-.947 1.588-1.79-.31-.85-1.047-1.014-2.491-.41l-.447.188-.201-.441c-1.159-2.54-1.915-4.105-2.251-4.664-.21-.347-3.344-.828-8.65-1.155-5.366.327-8.5.808-8.71 1.155-.336.559-1.092 2.123-2.25 4.664l-.202.44-.447-.186c-1.444-.605-2.18-.441-2.49.408-.308.844.127 1.396 1.587 1.79l.587.16-.268.544c-.815 1.655-1.27 2.788-1.357 3.348-.089.57-.031 2.004.178 4.226.076.61 1.246 1.168 3.6 1.488 2.545.345 5.794.519 9.744.519 3.949 0 7.196-.174 9.74-.52zM6.257 21.024a2.246 2.246 0 110-4.492 2.246 2.246 0 010 4.492zm0-1a1.246 1.246 0 100-2.492 1.246 1.246 0 000 2.492zm19.556 1a2.246 2.246 0 110-4.492 2.246 2.246 0 010 4.492zm0-1a1.246 1.246 0 100-2.492 1.246 1.246 0 000 2.492zm-14.277-1.437v-1h8.928v1h-8.928zm0 2.55v-1h8.928v1h-8.928z">
                        </path>
                      </svg> <?php echo $value['garagem']; ?>
                    </li>
                    <li class="bairro"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"
                        size="16" color="currentColor">
                        <path fill="currentColor" fill-rule="evenodd"
                          d="M17.044 19.64a30.885 30.885 0 01-4.218 3.697c-.193.138-.332.235-.41.287a.75.75 0 01-.832 0 14.543 14.543 0 01-.41-.287 30.885 30.885 0 01-4.219-3.696C4.025 16.546 2.25 13.294 2.25 10 2.25 4.615 6.615.25 12 .25s9.75 4.365 9.75 9.75c0 3.294-1.774 6.546-4.706 9.64zm-4.105 1.726a29.402 29.402 0 003.017-2.757c2.693-2.843 4.294-5.778 4.294-8.609a8.25 8.25 0 00-16.5 0c0 2.83 1.601 5.766 4.294 8.61A29.402 29.402 0 0012 22.082c.285-.207.6-.447.94-.717zM12 13.75a3.75 3.75 0 110-7.5 3.75 3.75 0 010 7.5zm0-1.5a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z">
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