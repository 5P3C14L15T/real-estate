<?php
  require_once "../config/DB.php";
  require_once "./logado.php";

  $db = new DB;
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
    <title>Casa a Venda Cuiabá</title>
  </head>
  <body>
    <header class="main">
      <nav class="menu">
        <div class="container">
          <div class="logo">
            <img
              src="imagem/logo.png"
              class="img-fluid logo-img"
              alt=""
              
            />
          </div>
        </div>
      </nav>
    </header>

    <nav class="componentes">
        <div class="container">
            <div class="row">
                <div class="col-md-3 my-3">
                    <a href="add.php" class="btn btn-success d-block">Add Novo Imóvel</a>
                </div>
                <div class="col-md-3 my-3">
                    <a href="#!" class="btn btn-primary d-block">Editar Perfil</a>
                </div>
                <div class="col-md-3 my-3">
                    <a href="./logout.php" class="btn btn-secondary d-block">Sair do perfil</a>
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
                        <th class="text-center">Imagem</th>
                        <th class="text-center">Título do Imóvel</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="text-center">312234</th>
                        <td class="text-center"><img class="rounded img-fluid" width="40" src="imagem/casa.jpg" alt=""></td>
                        <td class="text-center">Casa térrea no belvedere</td>
                        <td class="text-center">
                            <a href="#!" title="Editar"> <i class="fas fa-edit"></i></a>
                            <a href="#!" title="Deletar"><i class="fas fa-trash-alt"></i></a>
                            <a href="#!" title="Ver Imóvel"><i class="fas fa-home"></i></a>

                        </td>
                    </tr>
                    
                    
                </tbody>
            </table>
            <nav>
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
            </nav>
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
