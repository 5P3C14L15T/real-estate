<?php
date_default_timezone_set('America/Cuiaba');
require_once "config/DB.php";

$db = new DB;

$url = $_SERVER["REQUEST_URI"];

$urlCompleta = __DIR__ . $url;

// echo $urlCompleta;
// echo "<br>";



$string = $url;
$last_hyphen_pos = strrpos($string, "-");
$code = substr($string, $last_hyphen_pos + 1);
// echo $code;

if (isset($code)) {
  $data = $db->buscarImovel($code);
  // echo "<pre>";
  // print_r($data);
  // echo "</pre>";

}



foreach ($data as $key => $value) {
  # code...
  // echo "<pre>";
  // print_r($value);
  // echo "</pre>";
}

// atualizando imóvel

$db->incrementarVisita($value['id_imovel']);

// pegando as imagens

// echo $value['id'];

$dataImagem = $db->getImageByIdImovel($value['id_imovel']);

// echo "<pre>";
//   print_r($dataImagem[0]['url']);
//   echo "</pre>";



foreach ($dataImagem as $keyImagem => $valueImagem) {
  # code...
  // echo "<pre>";
  // print_r($valueImagem);
  // echo "</pre>";
}

// último quatro imóveis

$dataMenorViews = $db->getImoveisMenorViews();

// echo "<pre>";
// print_r($dataMenorViews);
// echo "</pre>";




?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/x-icon" href="imagem/icon.png">
  <!-- CSS only -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/single.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
  <script src="https://kit.fontawesome.com/6c66823518.js" crossorigin="anonymous"></script>

  <title>
    <?php echo $value['titulo'] ?>
  </title>

  <meta property="og:title" content="<?php echo $value['titulo']; ?>" />
  <meta property="og:description" content="<?php echo $value['descricao']; ?>" />
  <meta property="og:url" content="<?php echo $urlCompleta; ?>" />
  <meta property="og:image" content="./app/<?php echo $dataImagem[0]['url']; ?>" />

  <meta property="og:image:secure_url" content="./app/<?php echo $dataImagem[0]['url']; ?>" />
  <meta property="og:image:type" content="image/jpeg" />
  <meta property="og:image:width" content="500" />
  <meta property="og:image:height" content="500" />
  <meta property="og:image:alt" content="<?php echo $value['titulo']; ?>" />
</head>

<body>
  <header class="main">
    <nav class="menu">
      <div class="container">
        <div class="logo">
          <a href="./">
            <img src="imagem/logo.png" class="img-fluid logo-img" alt="" srcset="" />
          </a>
        </div>
      </div>
    </nav>
  </header>
  <!-- <div class="filter-main">
    <div class="container filter-main-search">
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-xl-3 col-md-3 col-sm-12 search-nivel">
            <select class="form-select">
              <option selected>Qual o melhor bairro para você?</option>
              <option value="1">Aráes</option>
              <option value="2">Tijucal</option>
              <option value="3">Pedra</option>
            </select>
          </div>
          <div class="col-xl-3 col-md-3 col-sm-12 search-nivel">
            <select class="form-select">
              <option selected>Faixa de valor do Imóvel?</option>
              <option value="1">100mil - 200mil</option>
              <option value="2">200mil - 300mil</option>
              <option value="3">300mil - 400mil</option>
              <option value="3">400mil - 500mil</option>
              <option value="3">Acima de 500mil</option>
            </select>
          </div>
          <div class="col-xl-3 col-md-3 col-sm-12 search-nivel">
            <select class="form-select">
              <option selected>Você prefere com quantos quartos?</option>
              <option value="1">1 Quarto</option>
              <option value="2">2 Quartos</option>
              <option value="3">3 Quartos</option>
              <option value="3">4 Quartos</option>
              <option value="3">5 Quartos</option>
            </select>
          </div>

          <div class="col-xl-3 col-md-3 col-sm-12 search-nivel">
            <button type="button" class="btn btn-outline-success search">
              🔎 Buscar o Imóvel Ideal
            </button>
          </div>
        </div>
      </form>
    </div>
  </div> -->
  <div class="container py-5">
    <div class="row col-md-10 mx-auto">
      <a href="index.php" target="_blank" class="voltar"><i class="fas fa-home"></i> Voltar > Inicial</a>
      <div class="titulo-preco">

        <div class="tituloLeft">
          <h1 class="imovel-title" title="<?php echo $value['titulo'] ?>"><?php echo $value['titulo'] ?></h1>
          <p class="bairro-title">
            <?php echo "Bairro: " . $value['nome'] ?><i class="fas fa-search-location"></i>
          </p>
        </div>

        <div class="precoRight">
          <h2 class="imovel-valor" title="<?php echo $value['valor'] ?>">R$
            <?php

            $valorImovel = $value['valor'];
            $valorImovelMostrar = $valorImovel;
            $valorImovelFormatado = number_format($valorImovelMostrar, 2, ",", ".");
            echo " " . $valorImovelFormatado;
            ?></h2>
          <small>Condomínio:
            <?php

            $valorCond = $value['valor_condominio'];
            $valorCondMostrar = $valorCond;
            $valorCondFormatado = number_format($valorCondMostrar, 2, ",", ".");
            echo "" . $valorCondFormatado;

            ?>
          </small><br>
          <small>IPTU:
            <?php

            $valorIptu = $value['iptu'];
            $valorIptuMostrar = $valorIptu;
            $valorIptuFormatado = number_format($valorIptuMostrar, 2, ",", ".");
            echo "" . $valorIptuFormatado;
            ?>
          </small>
        </div>

      </div>
      <div class="col-sm-12 col-md-7 info-desc">

        <div class="info-desc-detais">

          <div class="car-main">
            <div class="gallery col-md-12 col-sm-12 mx-auto">
              <div class="row">
                <!-- slider -->
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

                  <div class="carousel-inner">


                    <?php $i = 0;
                    foreach ($dataImagem as $row): ?>
                      <?php if ($i == 0) {
                        $set_ = 'active';
                      } else {
                        $set_ = '';
                      } ?>
                      <div class='carousel-item <?php echo $set_; ?>'>
                        <img src='<?php echo "./app/" . $row['url']; ?>' class='d-block w-100'>
                      </div>
                      <?php $i++;
                    endforeach ?>

                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próxima</span>
                  </button>
                </div>
                <!-- /slider -->
              </div>
            </div>
          </div>
          <p class="descricao">
            <strong>Descrição do Imóvel: </strong> <br>
            <?php echo $value['descricao']; ?>
          </p>
          <!-- aqui vai os ítens da casa -->
          <div class="container">
            <div class="row itens">


              <div class="col-md-4 text-center item">
                <i class="fas fa-bed"></i>
                <p>
                  <?php echo $value['quartos'] ?> Quartos
                </p>
              </div>

              <?php if ($value['suite'] == "") {
                ?>

                <div class="col-md-4 text-center item">
                  <i class="fas fa-bath"></i>
                  <p>Suíte</p>
                </div>

              <?php } ?>

              <!-- sala -->
              <?php if ($value['sala'] == 1) {
                ?>
                <div class="col-md-4 text-center item">
                  <i class="fas fa-tv"></i>
                  <p>
                    <?php echo "Sala"; ?>
                  </p>
                </div>
              <?php } ?>



              <!-- cozinha -->

              <?php if ($value['cozinha'] == 1) {
                ?>
                <div class="col-md-4 text-center item">
                  <i class="fas fa-utensil-spoon"></i>
                  <p>
                    <?php echo "Cozinha"; ?>
                  </p>
                </div>

              <?php } ?>

              <!-- lavanderia -->

              <?php if ($value['lavanderia'] == 1) {
                ?>
                <div class="col-md-4 text-center item">
                  <i class="fas fa-tshirt"></i>
                  <p>
                    <?php echo "Lavanderia"; ?>
                  </p>
                </div>

              <?php } ?>

              <!-- sacada -->

              <?php if ($value['sacada'] == 1) {
                ?>
                <div class="col-md-4 text-center item">
                  <i class="fas fa-building"></i>
                  <p>
                    <?php echo "Sacada"; ?>
                  </p>
                </div>
              <?php } ?>




              <!-- banheiro social -->

              <?php if ($value['banheiros'] !== "") {
                ?>
                <div class="col-md-4 text-center item">
                  <i class="fas fa-shower"></i>
                  <p>
                    <?php echo $value['banheiros'] ?> Banheiro(s)
                  </p>
                </div>
              <?php } ?>

              <!-- elevador -->

              <?php if ($value['elevador'] == 1) {
                ?>
                <div class="col-md-4 text-center item">
                  <i class="fas fa-chevron-circle-up"></i>
                  <p>
                    <?php echo "Elevador"; ?>
                  </p>
                </div>
              <?php } ?>


              <!-- garagem -->

              <?php if ($value['garagem'] !== "") {
                ?>
                <div class="col-md-4 text-center item">
                  <i class="fas fa-car"></i>
                  <p>
                    <?php echo $value['garagem']; ?> Garagem
                  </p>
                </div>
              <?php } ?>



              <!-- area de lazer -->

              <?php if ($value['area_lazer'] == 1) {
                ?>
                <div class="col-md-4 text-center item">
                  <i class="fas fa-swimming-pool"></i>
                  <p>
                    <?php echo "Área de Lazer"; ?>
                  </p>
                </div>
              <?php } ?>

              <!-- area construída -->

              <?php if ($value['area_construida'] !== "") {
                ?>
                <div class="col-md-4 text-center item">
                  <i class="fas fa-ruler-combined"></i>
                  <p>Área:
                    <?php echo $value['area_construida'] . "m²"; ?>
                  </p>
                </div>
              <?php } ?>
              <!-- area construída -->

            </div>
          </div>


        </div>
      </div>
      <div class="col-sm-12 col-md-5 info-corretor-main">

        <!-- mensagem -->
        <div class="mensagem-corretor">


          <form action="whatsapp.php" method="POST">
            <div class="form-header">
              <h3>Chamar anunciante no WhatsApp</h3>
            </div>
            <div class="form-body">
              <p class="aviso-form">Preencha corretamente para poder falar direto com o anunciante deste imóvel pelo
                whatsapp</p>

              <legend>Seu Nome <small class="text-secondary">(insira seu nome)</small></legend>
              <input class="form-control form-control-lg" id="nome" name="nomeLead" type="text"
                placeholder="Qual o seu nome?" required>
              <legend>Seu WhatsApp <small class="text-secondary">(preencha somente os números)</small></legend>
              <input class="form-control form-control-lg" maxlength="15" id="telefone" name="whatsappLead" type="text"
                placeholder="(65) 99999-9999" required>
              <!-- inputs data -->

              <input type="hidden" name="titulo" value="<?php echo $value['titulo']; ?> ">
              <input type="hidden" name="valor" value="<?php echo $value['valor']; ?> ">
              <input type="hidden" name="bairroNome" value="<?php echo $value['nome']; ?> ">
              <input type="hidden" name="whatsapp" value="<?php echo $value['whatsapp']; ?> ">
              <input type="hidden" name="url" value="<?php echo $urlCompleta ?> ">
              <input type="hidden" name="quarto" value="<?php echo $value['quartos']; ?> ">
              <input type="hidden" name="area" value="<?php echo $value['area_construida']; ?> ">




              <div class="d-grid mt-4">
                <input class="botao-zap" onclick="saveData()" type="submit" name="enviar" value="Chamar no WhatsApp">
              </div>
            </div>
          </form>
        </div>
        <!-- /mensagem -->

        <div class="info-corretor">
          <header>
            <img src="<?php echo "app/" . $value['img']; ?>" alt="Quincy Larson's profile picture"
              class="profile-thumbnail" />
            <div class="profile-name">
              <h3>
                <?php echo $value['nome_user'] ?>
              </h3>
              <h4>Anunciante</h4>
              <h5>WhatsApp:
                <?php echo $value['whatsapp']; ?>
              </h5>
            </div>
          </header>
          <div id="inner">
            <p>
              <?php echo $value['descricao_user'] ?>
            </p>
            <!-- <span class="creci">CRECI-MT 12130 F</span> -->
            <hr />
          </div>
          <footer>
            <div class="stats">

              <?php if ($value['ig'] !== "") {
                ?>
                <div class="Retweets">
                  <a href="<?php echo $value['ig']; ?>" target="_new"> <i class="fa fa-instagram"></i></a>
                </div>
              <?php } ?>

              <?php if ($value['fb'] !== "") {
                ?>
                <div class="Retweets">
                  <a href="<?php echo $value['fb']; ?>" target="_new"> <i class="fa fa-facebook-square"></i></a>
                </div>
              <?php } ?>

              <?php if ($value['linkedin'] !== "") {
                ?>
                <div class="Retweets">
                  <a href="<?php echo $value['linkedin']; ?>" target="_new"> <i class="fab fa-linkedin"></i></a>
                </div>
              <?php } ?>

              <?php if ($value['site'] !== "") {
                ?>
                <div class="Retweets">
                  <a href="<?php echo $value['site']; ?>" target="_new"> <i class="fas fa-sitemap"></i></a>
                </div>
              <?php } ?>
            </div>
          </footer>
        </div>

      </div>
    </div>
  </div>



  <div class="container">


    <div class="row col-md-10 mx-auto outrosImoveis">
      <div class="tituloOutrosImoveis">
        <h1>Outros imóveis</h1>
      </div>

      <?php

      foreach ($dataMenorViews as $value) {
        // var_dump($value);
        // criando URL
        $urlBase = "http://localhost/apartamentoavendacuiaba/real-estate/";
$urlAntiga = $urlBase;
$tituloDeImovel = $value['titulo'];
$codigoImovel = $value['cod_imovel'];


$imovelUrl = $db->criar_url_amigavel($urlAntiga, $tituloDeImovel, $codigoImovel);

// var_dump($imovelUrl);
        ?>

        <div class="col-md-3 outrosImoveisCard my-2">
          <div class="card">
            <img src="<?php echo "app/" . $value['primeira_imagem_url']; ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">
                <?php echo $value['titulo']; ?>
              </h5>
              <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <?php echo  "Quartos " . $value['quartos']; ?>
              </li>
              <li class="list-group-item">
                <?php echo "Bairro " . $value['nome_bairro']; ?>
              </li>
              <li class="list-group-item">
                <?php echo "Valor R$" . number_format($value['valor'], 2, ",", "."); ?>
              </li>
            </ul>
            <div class="card-body">
              <a href="<?php echo $imovelUrl  ;?>" target="_new" class=" btn btn-success w-100">Ver Imóvel</a>
            </div>
          </div>
        </div>

        <?php

      }

      ?>

    </div>
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

  <script>

    // Função para salvar os dados no LocalStorage e aplicar a máscara
    function saveData() {
      var nome = document.getElementById('nome').value;
      var telefone = document.getElementById('telefone').value;

      localStorage.setItem('nome', nome);
      localStorage.setItem('telefone', telefone);

      mascara(document.getElementById('telefone'), mtel);
    }

    // Restaurar os dados do LocalStorage ao carregar a página e aplicar a máscara
    window.onload = function () {
      var nome = localStorage.getItem('nome');
      var telefone = localStorage.getItem('telefone');

      if (nome) {
        document.getElementById('nome').value = nome;
      }

      if (telefone) {
        document.getElementById('telefone').value = telefone;
        mascara(document.getElementById('telefone'), mtel);
      }
    };

    /* Máscaras ER */
    function mascara(o, f) {
      v_obj = o
      v_fun = f
      setTimeout("execmascara()", 1)
    }

    function execmascara() {
      v_obj.value = v_fun(v_obj.value)
    }

    function mtel(v) {
      v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
      v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
      v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
      return v;
    }

    function id(el) {
      return document.getElementById(el);
    }

    // Aplicar a máscara ao digitar no campo de telefone
    id('telefone').onkeyup = function () {
      mascara(this, mtel);
    }

  </script>

</body>

</html>