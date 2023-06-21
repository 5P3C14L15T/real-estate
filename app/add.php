<?php
require_once "../config/DB.php";
require_once "./logado.php";

$db = new DB;

$bairros = $db->getBairros();
// var_dump($bairros);


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
          <a href="dashboard.php" class="alert alert-primary   d-block">< Voltar ao dashboard</a>
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
          <h1 class="text-center">Adicione um novo Apartamento</h1>

          <form action="inserir.php" class="add-imovel" method="post" enctype="multipart/form-data">
            <label for="titulo"> Insira o Título do Imóvel</label>
            <div class="input-group input-group-lg mb-3">
              <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-building"></i></span>

              <input type="text" class="form-control" name="titulo"
                placeholder="Apartamento de 3 quartos próximo ao centro" aria-describedby="inputGroup-sizing-lg"
                required />
            </div>

            <div class="row">
              <div class="col-md-6">
                <label for="bairro"> Escolha o Bairro</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-location-arrow"></i></span>

                  <select name="bairro" class="form-select">
                    <option selected>Escolha o Bairro</option>
                    <?php foreach ($bairros as $bairro) { ?>
                      <option value="<?php echo $bairro['id']; ?>"><?php echo $bairro['nome'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <label for="preco"> Qual o valor do Imóvel? <small class="text-danger">(insira somente números)</small></label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-dollar-sign"></i></span>

                  <input size="12" onKeyUp="mascaraMoeda(this, event)" type="text" class="form-control" name="preco" placeholder="200.000,00"
                    aria-describedby="inputGroup-sizing-lg" required />
                </div>
              </div>

              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="condominio"> Valor do condomínio?</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-dollar-sign"></i></span>

                  <input size="12" onKeyUp="mascaraMoeda(this, event)" type="text" class="form-control" name="condominio" placeholder="400,00"
                    aria-describedby="inputGroup-sizing-lg" required />
                </div>
              </div>
              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="condominio"> Valor do IPTU?</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-dollar-sign"></i></span>

                  <input size="12" onKeyUp="mascaraMoeda(this, event)" type="text" class="form-control" name="iptu" placeholder="1300,00"
                    aria-describedby="inputGroup-sizing-lg" />
                </div>
              </div>
              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="area"> Metros quadrados do Imóvel</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-ruler-vertical"></i></span>

                  <input type="text" class="form-control" name="area" placeholder="120"
                    aria-describedby="inputGroup-sizing-lg" required />
                </div>
              </div>
              <!-- aqui vai os quartos -->

              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="quartos"> Quantos quartos possui?</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-bed"></i></span>

                  <input class="text-center form-control" type="number" name="qtdQuarto" min="0" id="" placeholder="0"
                    required>
                  </select>
                </div>
              </div>



              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="banheiro">Quantos banheiros?</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-shower"></i></span>

                  <input class="text-center form-control" type="number" name="qtdBanheiro" min="0" id="" placeholder="0"
                    required>
                </div>
              </div>

              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="area"> Quantas garagem?</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-car"></i></span>

                  <input class="text-center form-control" type="number" min="0" name="qtdGaragem" id="" placeholder="0"
                    required>
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
                        <input type="checkbox" name="cozinha" value="1" class="checkbox" checked>
                        <div class="option_inner facebook">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fas fa-utensils"></i></div>
                          <div class="name">Cozinha</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <input type="checkbox" name="sala" value="1" class="checkbox" checked>
                        <div class="option_inner twitter">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fas fa-tv"></i></div>
                          <div class="name">Sala</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <input type="checkbox" name="garden" value="1" class="checkbox">
                        <div class="option_inner instagram">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fas fa-seedling"></i></div>
                          <div class="name">Garden</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <input type="checkbox" name="sacada" value="1" class="checkbox">
                        <div class="option_inner linkedin">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fas fa-person-booth"></i></div>
                          <div class="name">Sacada</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <input type="checkbox" name="lavanderia" value="1" class="checkbox">
                        <div class="option_inner whatsapp">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fas fa-faucet"></i></div>
                          <div class="name">Lavanderia</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <input type="checkbox" name="suite" value="1" class="checkbox">
                        <div class="option_inner google">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fas fa-bed"></i></div>
                          <div class="name">Suíte</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <input type="checkbox" name="elevador" value="1" class="checkbox">
                        <div class="option_inner reddit">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fas fa-arrow-alt-circle-up"></i></div>
                          <div class="name">Elevador</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <input type="checkbox" name="lazer" value="1" class="checkbox">
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
                    placeholder="Insira uma pequena descrição do Imovél"></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="input-images"></div>
              </div>

              <div class="mb-3">
                <label for="area">Insira as imagens do Imóvel</label>

                <input class="form-control" type="file" name="fileUpload[]" id="chooseFile" multiple>
              </div>

              <div class="d-grid gap-2">
                <input type="submit" class="alert alert-success" name="enviar" value="ADICIONAR IMÓVEL" />

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
      var mascara = "##.###.###,##".reverse();
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