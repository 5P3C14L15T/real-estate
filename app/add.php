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
  <title>Casa a Venda Cuiabá</title>
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
          <a href="dashboard.html" class="btn btn-info d-block">Voltar ao dashboard</a>
        </div>
        <div class="col-md-3">
          <a href="#!" class="btn btn-primary d-block">Editar Perfil</a>
        </div>
      </div>
    </div>
  </nav>

  <section class="main mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-9 mx-auto">
          <h1 class="text-center">Adicione um novo Apartamento</h1>

          <form action="#!" class="add-imovel">
            <label for="titulo"> Insira o Título do Imóvel</label>
            <div class="input-group input-group-lg mb-3">
              <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-home"></i></span>

              <input type="text" class="form-control" name="titulo" placeholder="Casa de 3 quartos próximo ao centro"
                aria-describedby="inputGroup-sizing-lg" />
            </div>

            <div class="row">
              <div class="col-md-6">
                <label for="bairro"> Escolha o Bairro</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-location-arrow"></i></span>

                  <select name="bairro" class="form-select">
                    <option selected>Escolha o Bairro</option>
                    <option value="1">Araés</option>
                    <option value="2">CPA 1</option>
                    <option value="3">Belvedere</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <label for="preco"> Qual o valor do Imóvel?</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-dollar-sign"></i></span>

                  <input type="text" class="form-control" name="preco" placeholder="200.000,00"
                    aria-describedby="inputGroup-sizing-lg" />
                </div>
              </div>

              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="condominio"> Qual o valor do condomínio?</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-dollar-sign"></i></span>

                  <input type="text" class="form-control" name="condominio" placeholder="400,00"
                    aria-describedby="inputGroup-sizing-lg" />
                </div>
              </div>
              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="condominio"> Qual o valor do IPTU?</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-dollar-sign"></i></span>

                  <input type="text" class="form-control" name="condominio" placeholder="1300,00"
                    aria-describedby="inputGroup-sizing-lg" />
                </div>
              </div>
              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="area"> Metros quadrados do Imóvel</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-ruler-vertical"></i></span>

                  <input type="text" class="form-control" name="area" placeholder="120"
                    aria-describedby="inputGroup-sizing-lg" />
                </div>
              </div>
              <!-- aqui vai os quartos -->

              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="quartos"> Quantos quartos possui?</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-bed"></i></span>

                  <input class="text-center form-control" type="number" name="qtdBanheiro" min="0" id="" placeholder="0">
                  </select>
                </div>
              </div>



              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="banheiro">Quantos banheiros?</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-shower"></i></span>

                  <input class="text-center form-control" type="number" name="qtdBanheiro" min="0" id="" placeholder="0">
                </div>
              </div>

              <!-- aqui vai os quartos -->
              <div class="col-md-4">
                <label for="area"> Quantas garagem?</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-car"></i></span>

                  <input class="text-center form-control" type="number" min="0" name="qtdGaragem" id="" placeholder="0">
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
                        <input type="checkbox" class="checkbox" checked>
                        <div class="option_inner facebook">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fas fa-utensils"></i></div>
                          <div class="name">Cozinha</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <input type="checkbox" class="checkbox" checked>
                        <div class="option_inner twitter">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fab fa-twitter"></i></div>
                          <div class="name">Sala</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <input type="checkbox" class="checkbox">
                        <div class="option_inner instagram">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fab fa-instagram"></i></div>
                          <div class="name">Gardem</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <input type="checkbox" class="checkbox">
                        <div class="option_inner linkedin">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fab fa-linkedin-in"></i></div>
                          <div class="name">Sacada</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <input type="checkbox" class="checkbox">
                        <div class="option_inner whatsapp">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fab fa-whatsapp"></i></div>
                          <div class="name">Lavanderia</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <input type="checkbox" class="checkbox">
                        <div class="option_inner google">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fab fa-google-plus-g"></i></div>
                          <div class="name">Suíte</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <input type="checkbox" class="checkbox">
                        <div class="option_inner reddit">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fab fa-reddit"></i></div>
                          <div class="name">Elevador</div>
                        </div>
                      </label>
                    </div>
                    <div class="col-md-3">
                      <label class="option_item">
                        <input type="checkbox" class="checkbox">
                        <div class="option_inner quora">
                          <div class="tickmark"></div>
                          <div class="icon"><i class="fab fa-quora"></i></div>
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

                  <textarea class="form-control" rows="5"
                    placeholder="Insira uma pequena descrição do Imovél"></textarea>
                </div>
              </div>

              <div class="mb-3">
                <label for="area">Insira as imagens do Imóvel</label>

                <input class="form-control" type="file" id="formFileMultiple" multiple>
              </div>

              <div class="d-grid gap-2">
                <button class="btn btn-success" type="button">ADICIONAR IMÓVEL</button>

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
        <h1>CASAAVENDACUIABA.COM.BR</h1>
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