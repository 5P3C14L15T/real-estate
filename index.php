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
$registros_por_pagina = 10;

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
// $urlBase = "https://www.apartamentoavendacuiaba.com.br/";
$urlBase = "http://localhost/apartamentoavendacuiaba/real-estate/";

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
  <meta property="og:description"
    content="Encontre os diversos apartamentos em todos os bairros de Cuiabá que estãõ anunciados a venda." />
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
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-R6YEMTGPBZ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-R6YEMTGPBZ');
</script>

<!-- Meta Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '650163389954385');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=650163389954385&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

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
              <option value="" selected>Todos os bairros de Cuiabá</option>
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
            <input type="submit" name="enviar" value="Buscar Apartamento"
              class="btn btn-outline-success search text-center">
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
            echo "Total de Resultados: " . $data['registro'];
          }

          ?>

        </h2>

        <!-- ITEM MOBILE FIRST -->
        <div class="adsMain">
          <!-- ITEM -->
          <?php foreach ($data['resultados'] as $key => $value) {
            # codigo

            var_dump($value);
          

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




            <div class="adsMainArea my-4">
              <!-- dividido entre imagem, titulo e preço -->
              <a href="<?php echo $imovelUrl; ?>" target="_blank">


                <div class="adsImg">
                  <img class="img-fluid img-responsive img-imovel" src="<?php echo $urlBase . "app/" . $value['url']; ?>">
                </div>

                <div class="adsCenterPreco">

                  <div class="adsCenter">
                    <div class="adsTituloArea">
                      <div class="adsTitulo">
                        <h1>
                          <?php echo $value['titulo']; ?>
                        </h1>
                      </div>
                      <div class="adsComponentes">
                        <ul>
                          <li><img src="imagem/quarto.svg" /></li>
                          <li>
                            <?php echo $value['quartos']; ?>
                          </li>
                          <li><img src="imagem/area.svg" /></li>
                          <li>
                            <?php echo $value['area_construida'] . "m²"; ?>
                          </li>
                          <li><img src="imagem/carro.svg" /></li>
                          <li>
                            <?php echo $value['garagem']; ?>
                          </li>
                          <li><img src="imagem/banheiro.svg" /></li>
                          <li>
                            <?php echo $value['banheiros']; ?>
                          </li>
                        </ul>


                      </div>

                      <div class="adsLocalizacao">
                        <ul>
                          <li><img src="imagem/local.svg" /></li>
                          <li>
                            <?php $nomeBairro = $db->buscarBairroPorId($value['id_bairro']);
                            echo $nomeBairro['nome'];
                            ?>
                          </li>
                          <li> | Postado em:
                            <?php
                            $timestamp = strtotime($value['incluida_em']);
                            $data_formatada = date("d/m/Y", $timestamp);
                            echo $data_formatada;
                            ?>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="adsPreco">
                    <div class="AdsPrecoValor">R$
                      <?php

                      $valorImovel = $value['valor'];
                      $valorImovelMostrar = $valorImovel / 1;
                      $valorImovelFormatado = number_format($valorImovelMostrar, 2, ",", ".");
                      echo $valorImovelFormatado;

                      ?>
                    </div>

                  </div>

                </div>

              </a>
            </div>



          <?php } ?>

        </div>
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
        <ul>
          <li>
            <a href="index.php">Página Inicial</a>
          </li>
          <li>
            <a href="planos.php">Quero Anunciar meu Ap</a>
          </li>
        </ul>
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