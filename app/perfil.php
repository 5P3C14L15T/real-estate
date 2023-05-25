<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- CSS only -->
    <link rel="stylesheet" href="css/style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
    <script
      src="https://kit.fontawesome.com/6c66823518.js"
      crossorigin="anonymous"
    ></script>
    <title>Editar Perfil</title>
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
          
        </div>
      </div>
    </nav>

    <section class="main mt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-9 mx-auto">
            <h1 class="text-center">Editar Perfil</h1>

            <form action="#!" class="add-imovel">
              <label for="nome"> Insira o seu nome</label>
              <div class="input-group input-group-lg mb-3">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  ><i class="fas fa-home"></i
                ></span>

                <input
                  type="text"
                  class="form-control"
                  name="titulo"
                  placeholder="José Fulano de Tal"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="row">
                <div class="col-md-6">
                  <label for="regime"> Imobiliária ou Autônomo</label>
                    <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-lg"
                          ><i class="fas fa-location-arrow"></i></span>
        
                          <select name="regime" class="form-select">
                            <option selected>Proprietário ou Corretor</option>
                            <option value="1">Proprietário</option>
                            <option value="2">Corretor de Imóveis</option>

                          </select>
                      </div>
                </div>
                <div class="col-md-6">
                  <label for="creci"> Qual o CRECI? <small class="text-danger">apenas se for corretor</small> </label>
                    <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-lg"
                          ><i class="fas fa-dollar-sign"></i></span>
        
                        <input
                          type="text"
                          class="form-control"
                          name="creci"
                          placeholder="CRECI-MT 11111 F"
                          aria-describedby="inputGroup-sizing-lg"
                        />
                      </div>
                </div>
                <!-- campo separado -->
                <div class="col-md-6">
                  <label for="nomeNegocio"> WhatsApp</label>
                    <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-lg"
                          ><i class="fas fa-dollar-sign"></i></span>
        
                        <input
                          type="text"
                          class="form-control"
                          name="whatsapp"
                          placeholder="(65) 99999-9999"
                          aria-describedby="inputGroup-sizing-lg"
                        />
                      </div>
                </div>
                <!-- campo separado -->
                <div class="col-md-6">
                  <label for="nomeNegocio"> Email</label>
                    <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-lg"
                          ><i class="fas fa-dollar-sign"></i></span>
        
                        <input
                          type="text"
                          class="form-control"
                          name="email"
                          placeholder="seuemail@email.com"
                          aria-describedby="inputGroup-sizing-lg"
                        />
                      </div>
                </div>
                <!-- campo separado -->
                <div class="col-md-6">
                  <label for="nomeNegocio"> Facebook Página ou Perfil</label>
                    <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-lg"
                          ><i class="fas fa-dollar-sign"></i></span>
        
                        <input
                          type="text"
                          class="form-control"
                          name="facebook"
                          placeholder="https://www.facebook.com/suapagina"
                          aria-describedby="inputGroup-sizing-lg"
                        />
                      </div>
                </div>
                <!-- campo separado -->
                <div class="col-md-6">
                  <label for="nomeNegocio"> Instagram</label>
                    <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-lg"
                          ><i class="fas fa-dollar-sign"></i></span>
        
                        <input
                          type="text"
                          class="form-control"
                          name="instagram"
                          placeholder="https://www.instagram.com/seuinstagram"
                          aria-describedby="inputGroup-sizing-lg"
                        />
                      </div>
                </div>
                <!-- campo separado -->
                <div class="col-md-6">
                  <label for="nomeNegocio"> LinkedIn</label>
                    <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-lg"
                          ><i class="fas fa-dollar-sign"></i></span>
        
                        <input
                          type="text"
                          class="form-control"
                          name="linkedin"
                          placeholder=""
                          aria-describedby="inputGroup-sizing-lg"
                        />
                      </div>
                </div>
                <!-- campo separado -->
                <div class="col-md-12">
                  <label for="nomeNegocio"> Site</label>
                    <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-lg"
                          ><i class="fas fa-dollar-sign"></i></span>
        
                        <input
                          type="text"
                          class="form-control"
                          name="nomeNegocio"
                          placeholder=""
                          aria-describedby="inputGroup-sizing-lg"
                        />
                      </div>
                </div>

                

              <!-- mensagem -->

              <div class="col-md-12">
                <label for="perfil"> Pequeno resumo do seu perfil</label>
                <div class="mb-3">
                 
                  <textarea class="form-control" name="perfil" rows="3" placeholder="Ex: Corretor especialista em médio padrão. No mercado de trabalho há 10 anos."></textarea>
                </div>
              </div>

              <div class="mb-3">
                <label for="fotoPerfil">Insira a foto do seu perfil</label>
                
                <input class="form-control" name="fotoPerfil" type="file" id="formFileMultiple" multiple>
              </div>
              
              <div class="d-grid gap-2">
                <button class="btn btn-success" type="button">ATUALIZAR PERFIL</button>
                
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
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
