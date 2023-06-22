<?php
require_once "../config/DB.php";
require_once "./logado.php";

$db = new DB;

$imovel = $db->buscarImovelPorId($_GET['id']);

// echo "<pre>";
// print_r($imovel);
// echo "</pre>";
// var_dump($imovel);

// echo "<hr>";



$bairros = $db->getBairros();
// var_dump($bairros);

$bairroId = $db->buscarBairroPorId($imovel['id_bairro']);

// var_dump($bairroId);


// Verifica se há resultado da busca
if ($bairroId) {
  // ID e nome do bairro já existente no banco de dados
  $id_bairro_selecionado = $bairroId['id'];
  $nome_bairro_selecionado = $bairroId['nome'];

} else {
  // ID e nome do bairro a serem buscados da tabela "bairros"
  $id_bairro_selecionado = null;
  $nome_bairro_selecionado = null;
}

$imagensIdImovel = $db->getImageByIdImovel($imovel['id_imovel']);

// echo "<pre>";
// print_r($imagensIdImovel);
// echo "</pre>";




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
          <img src="imagem/logo.png" class="img-fluid logo-img" alt="" />
        </div>
      </div>
    </nav>
  </header>

  <nav class="componentes">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <a href="dashboard.php" class="alert alert-secondary d-block">< Voltar ao dashboard</a>
        </div>
        <!-- <div class="col-md-3">
          <a href="#!" class="btn btn-primary d-block">Editar Perfil</a>
        </div> -->
      </div>
    </div>
  </nav>

  <section class="main mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-9 mx-auto">
          <h1 class="text-center">Editar o imóvel</h1>

          <form action="atualizarimovel.php" class="add-imovel" method="post" enctype="multipart/form-data">
            <label for="titulo"> Insira o Título do Imóvel</label>
            <div class="input-group input-group-lg mb-3">
              <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-building"></i></span>

              <input type="text" class="form-control" name="titulo" value="<?php echo $imovel['titulo'] ?>"
                placeholder="Apartamento de 3 quartos próximo ao centro" aria-describedby="inputGroup-sizing-lg"
                required />
            </div>

            <div class="row">
              <div class="col-md-6">
                <label for="bairro"> Escolha o Bairro</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-location-arrow"></i></span>



                  <!-- Formulário -->
                  <select name="bairro" class="form-select">
                    <option>Escolha o Bairro</option>
                    <?php foreach ($bairros as $bairro) { ?>

                      <option value="<?php echo $bairro['id']; ?>" <?php if ($bairro['id'] == $id_bairro_selecionado) {
                           echo 'selected';
                         } ?>><?php echo $bairro['nome']; ?></option>
                    <?php } ?>
                  </select>




                </div>
              </div>
              <div class="col-md-6">
                <label for="preco"> Qual o valor do Imóvel? <small class="text-danger">(insira somente
                    números)</small></label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-dollar-sign"></i></span>



                  <input type="text" name="preco" class="form-control"
                    value="<?php echo number_format($imovel['valor'], 2, ',', '.'); ?>"
                    aria-describedby="inputGroup-sizing-lg" onKeyUp="mascaraMoeda(this, event);">


                </div>
              </div>

              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="condominio"> Valor do condomínio?</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-dollar-sign"></i></span>

                  <input size="12" onKeyUp="mascaraMoeda(this, event)" type="text" class="form-control"
                    name="condominio" value="<?php echo number_format($imovel['valor_condominio'], 2, ',', '.'); ?>"
                    placeholder="400,00" aria-describedby="inputGroup-sizing-lg" required />
                </div>
              </div>
              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="condominio"> Valor do IPTU?</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-dollar-sign"></i></span>

                  <input size="12" onKeyUp="mascaraMoeda(this, event)" type="text" class="form-control" name="iptu"
                    value="<?php echo number_format($imovel['iptu'], 2, ',', '.'); ?>" placeholder="1300,00"
                    aria-describedby="inputGroup-sizing-lg" />
                </div>
              </div>
              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="area"> Metros quadrados do Imóvel</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-ruler-vertical"></i></span>

                  <input type="text" class="form-control" name="area" placeholder="120"
                    value="<?php echo $imovel['area_construida']; ?>" aria-describedby="inputGroup-sizing-lg"
                    required />
                </div>
              </div>
              <!-- aqui vai os quartos -->

              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="quartos"> Quantos quartos possui?</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-bed"></i></span>

                  <input value="<?php echo $imovel['quartos']; ?>" class="text-center form-control" type="number"
                    name="qtdQuarto" min="0" id="" placeholder="0" required>
                  </select>
                </div>
              </div>



              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="banheiro">Quantos banheiros?</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-shower"></i></span>

                  <input value="<?php echo $imovel['banheiros']; ?>" class="text-center form-control" type="number"
                    name="qtdBanheiro" min="0" id="" placeholder="0" required>
                </div>
              </div>

              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="area"> Quantas garagem?</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-car"></i></span>

                  <input value="<?php echo $imovel['garagem']; ?>" class="text-center form-control" type="number"
                    min="0" name="qtdGaragem" id="" placeholder="0" required>
                </div>
              </div>
              <!--  -->

              <!-- outros ítens no imóvel -->

              <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

              <div class="wrapper">
                <div class="title">
                  Selecione mais ítens que seu Imóvel possui
                </div>

                <div class="container text-center">
                  <div class="row">
                    <div class="col-md-3 text-center">
                      <label class="option_item">
                      <?php
                        if ($imovel['cozinha'] == 1) {
                          $cozinha = "checked";
                        } else {
                          $cozinha = "";
                        }
                        ?>
                        <input type="checkbox" name="cozinha" value="1" class="checkbox" <?php echo $cozinha; ?>>
                        <div class="option_inner facebook">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fas fa-utensils"></i></div>
                          <div class="name">Cozinha</div>
                        </div>
                      </label>
                    </div>
                    <!-- sala -->
                    <div class="col-md-3">
                      <label class="option_item">

                        <?php
                        if ($imovel['sala']) {
                          $sala = "checked";
                        } else {
                          $sala = "";
                        }
                        ?>

                        <input type="checkbox" name="sala" value="1" class="checkbox" <?php echo $sala; ?>>
                        <div class="option_inner twitter">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fas fa-tv"></i></div>
                          <div class="name">Sala</div>
                        </div>
                      </label>
                    </div>

                    <div class="col-md-3">
                      <label class="option_item">

                        <?php
                        if ($imovel['garden']) {
                          $garden = "checked";
                        } else {
                          $garden = "";
                        }
                        ?>
                        <input type="checkbox" name="garden" value="1" class="checkbox" <?php echo $garden; ?>>
                        <div class="option_inner instagram">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fas fa-seedling"></i></div>
                          <div class="name">Garden</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">

                        <?php
                        if ($imovel['sacada']) {
                          $sacada = "checked";
                        } else {
                          $sacada = "";
                        }
                        ?>
                        <input type="checkbox" name="sacada" value="1" class="checkbox" <?php echo $sacada; ?>>
                        <div class="option_inner linkedin">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fas fa-person-booth"></i></div>
                          <div class="name">Sacada</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <?php
                        if ($imovel['lavanderia']) {
                          $lavanderia = "checked";
                        } else {
                          $lavanderia = "";
                        }
                        ?>
                        <input type="checkbox" name="lavanderia" value="1" class="checkbox" <?php echo $lavanderia; ?>>
                        <div class="option_inner whatsapp">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fas fa-faucet"></i></div>
                          <div class="name">Lavanderia</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <?php
                        if ($imovel['suite']) {
                          $suite = "checked";
                        } else {
                          $suite = "";
                        }
                        ?>
                        <input type="checkbox" name="suite" value="1" class="checkbox" <?php echo $lavanderia; ?>>
                        <div class="option_inner google">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fas fa-bed"></i></div>
                          <div class="name">Suíte</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <?php
                        if ($imovel['elevador']) {
                          $elevador = "checked";
                        } else {
                          $elevador = "";
                        }
                        ?>
                        <input type="checkbox" name="elevador" value="1" class="checkbox" <?php echo $elevador; ?>>
                        <div class="option_inner reddit">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fas fa-arrow-alt-circle-up"></i></div>
                          <div class="name">Elevador</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <?php
                        if ($imovel['area_lazer']) {
                          $lazer = "checked";
                        } else {
                          $lazer = "";
                        }
                        ?>
                        <input type="checkbox" name="lazer" value="1" class="checkbox" <?php echo $lazer; ?>>
                        <div class="option_inner quora">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fas fa-swimming-pool"></i></div>
                          <div class="name">Área Lazer</div>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>

              </div>

              <!-- mensagem -->

              <div class="col-md-12">
                <label for="area"> Descrição do Imóvel</label>
                <div class="mb-3">

                  <textarea class="form-control" rows="5" name="msg"
                    placeholder="Insira uma pequena descrição do Imovél"><?php echo $imovel['descricao']; ?></textarea>
                </div>
              </div>

              <?php

             

              foreach ($imagensIdImovel as $value) {
                // var_dump($value)              
                ?>

                <div class="col-md-3">
                  <div class="input-images">
                    <a href="deletarimagem.php?id=<?php echo $imovel['id_imovel'] ?>&delete=<?php echo $value['id']; ?>
                    &url=<?php echo $value['url'];?>">
                      <img src="<?php echo $value['url']; ?>" class="img-fluid img-edit" alt="" srcset="">
                      <h3 class="deletarImg btn btn-danger mt-2">Deletar</h3>
                    </a>
                  </div>
                </div>

                <?php
              }

               
              ?>

              <div class="mb-3 mt-4">
                <label for="area">Inserir novas imagens</label>

                <input class="form-control" type="file" name="fileUpload[]" id="chooseFile" multiple>
              </div>

              <div class="d-grid gap-2">
                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id">
                <input type="submit" class="alert alert-info" name="atualizar" value="ATUALIZAR IMÓVEL" />

              </div>
            </div>
          </form>
        </div>
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
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="http://example.com/jquery.min.js"></script>
  <script type="text/javascript" src="http://example.com/image-uploader.min.js"></script>

  <script>
    String.prototype.reverse = function () {
      return this.split('').reverse().join('');
    };

    function mascaraMoeda(campo, evento) {
      var tecla = (!evento) ? window.event.keyCode : evento.which;
      var valor = campo.value.replace(/[^\d]+/gi, '').reverse();
      var resultado = "";
      var mascara = "###.###.###,##".reverse();
      for (var x = 0, y = 0; x < mascara.length && y < valor.length;) {
        if (mascara.charAt(x) != '#') {
          resultado += mascara.charAt(x);
          x++;
        } else {
          resultado += valor.charAt(y);
          y++;
          x++;
        }
      }
      campo.value = resultado.reverse();
    }
  </script>

</body>

</html>