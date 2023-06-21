<?php
require_once "../config/DB.php";
require_once "./logado.php";

$db = new DB;

// $emailLogado = $_SESSION['user'];
// var_dump($emailLogado);

$perfilActive = $db->buscarPorEmail($_SESSION['user']);
// var_dump($perfilActive);


if (isset($_POST['enviar'])) {


  $nome_user = $_POST['nome'];
  $imob_autonomo = $_POST['regime'];
  $whatsapp = $_POST['whatsapp'];
  $email = $_SESSION['user'];
  // $img = $_FILES['img'];
  $descricao_user = $_POST['descricao_user'];
  $fb = $_POST['fb'];
  $ig = $_POST['ig'];
  $linkedin = $_POST['linkedin'];
  $site = $_POST['site'];
  $creci = $_POST['creci'];
  $access_type = "user";
  $payment = null;

  // var_dump($img);


  $db->saveUserData(
    $nome_user,
    $imob_autonomo,
    $whatsapp,
    $email,
    // $img,
    $descricao_user,
    $fb,
    $ig,
    $linkedin,
    $site,
    $creci,
    $access_type = "user",
    $payment = ""
  );
}




// foreach para pegar os dados e preencher o form

foreach ($perfilActive as $value) {
  // echo "<pre>";
  // print_r($value);
  // echo "</pre>";
}

// echo $value['whatsapp'];


// $emailLogado = $db->checkUserExists($_SESSION['user']);





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
          <a href="dashboard.php" class="alert alert-info d-block"> < Voltar ao dashboard</a>
        </div>

      </div>
    </div>
  </nav>

  <section class="main mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-9 mx-auto">
          <h1 class="text-center">Editar Perfil</h1>

          <?php
          $imagem = $db->getProfileImage($_SESSION['user']);
          // var_dump($imagem);
          ?>

          <img class="imagemPerfil" src="<?php echo $imagem; ?>" alt="" class="img-fluid">


          <div class="col-md-6 offset-md-3 mb-3">
            <form action="atualizar_post.php" method="post" class="add-imovel" id="myForm"
              enctype="multipart/form-data">
              <div class="input-group">
                <input type="file" name="img" class="form-control" id="inputGroupFile04"
                  aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                <input name="editar" class="btn btn-outline-success" type="submit" value="Atualizar">
              </div>
            </form>
          </div>

          <form action="atualizar_post.php" method="post" class="add-imovel" id="myForm" enctype="multipart/form-data">
            <label for="nome"> Insira o seu nome</label>
            <div class="input-group input-group-lg mb-3">
              <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-home"></i></span>
              <!-- <input type="text" class="form-control" name="nome" id="nameInput" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>"> -->
              <input type="text" class="form-control" name="nome" placeholder="José Fulano de Tal"
                value="<?php echo $value['nome_user'] ?>" aria-describedby="inputGroup-sizing-lg" />
            </div>

            <div class="row">
              <div class="col-md-6">
                <label for="regime"> Imobiliária ou Autônomo</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-location-arrow"></i></span>

                  <select name="regime" class="form-select">
                    <?php
                    $proprietarioCorretor = ''; // Variável para armazenar o valor selecionado
                    // Verificar se há resultados no banco de dados
                    if ($value['imob_autonomo']) {
                      // Se houver resultados, definir o valor correspondente à variável $proprietarioCorretor
                      if ($value['imob_autonomo'] == 1) {
                        $proprietarioCorretor = '1';
                      } elseif ($value['imob_autonomo'] == 2) {
                        $proprietarioCorretor = '2';
                      }
                    }
                    ?>
                    <option <?php echo ($proprietarioCorretor == null) ? 'selected' : ''; ?>>Proprietário ou Corretor
                    </option>
                    <option value="1" <?php echo ($proprietarioCorretor == '1') ? 'selected' : ''; ?>>Proprietário
                    </option>
                    <option value="2" <?php echo ($proprietarioCorretor == '2') ? 'selected' : ''; ?>>Corretor de Imóveis
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <label for="creci"> Qual o CRECI? <small class="text-danger">apenas se for corretor</small> </label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-address-card"></i></span>

                  <input type="text" class="form-control" name="creci" value="<?php echo $value['creci'] ?>"
                    placeholder="CRECI-MT 11111 F" aria-describedby="inputGroup-sizing-lg" />
                </div>
              </div>
              <!-- campo separado -->
              <div class="col-md-6">
                <label for="nomeNegocio"> WhatsApp <small class="text-danger">***preencha somente os
                    números</small></label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fab fa-whatsapp-square"></i></span>

                  <input type="text" class="form-control" name="whatsapp" value="<?php echo $value['whatsapp']; ?>"
                    id="telefone" maxlength="15" placeholder="(65) 99999-9999"
                    aria-describedby="inputGroup-sizing-lg" required />
                </div>
              </div>
              <!-- campo separado -->
              <div class="col-md-6">
                <label for="nomeNegocio"> Email</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-envelope"></i></span>

                  <input disabled type="text" class="form-control" value="<?php echo $value['email']; ?>" name="email"
                    placeholder="seuemail@email.com" aria-describedby="inputGroup-sizing-lg" />
                </div>
              </div>
              <!-- campo separado -->
              <div class="col-md-6">
                <label for="nomeNegocio"> Facebook Página ou Perfil</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fab fa-facebook-square"></i></span>

                  <input type="text" class="form-control" value="<?php echo $value['fb']; ?>" name="fb"
                    placeholder="https://www.facebook.com/suapagina" aria-describedby="inputGroup-sizing-lg" />
                </div>
              </div>
              <!-- campo separado -->
              <div class="col-md-6">
                <label for="nomeNegocio"> Instagram</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fab fa-instagram-square"></i></span>

                  <input type="text" class="form-control" value="<?php echo $value['ig']; ?>" name="ig"
                    placeholder="https://www.instagram.com/seuinstagram" aria-describedby="inputGroup-sizing-lg" />
                </div>
              </div>
              <!-- campo separado -->
              <div class="col-md-6">
                <label for="nomeNegocio"> LinkedIn</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fab fa-linkedin"></i></span>

                  <input type="text" class="form-control" value="<?php echo $value['linkedin']; ?>" name="linkedin"
                    placeholder="https://www.linkedin.com/in/seuperfil/" aria-describedby="inputGroup-sizing-lg" />
                </div>
              </div>
              <!-- campo separado -->
              <div class="col-md-6">
                <label for="nomeNegocio"> Site</label>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fas fa-link"></i></span>

                  <input type="text" class="form-control" value="<?php echo $value['site']; ?>" name="site"
                    placeholder="https://www.seusite.com.br" aria-describedby="inputGroup-sizing-lg" />
                </div>
              </div>



              <!-- mensagem -->

              <div class="col-md-12">
                <label for="perfil"> Pequeno resumo do seu perfil</label>
                <div class="mb-3">

                  <textarea class="form-control" name="descricao_user"
                    rows="3"
                    placeholder="Ex: Corretor especialista em médio padrão. No mercado de trabalho há 10 anos."><?php echo $value['descricao_user']; ?></textarea>
                </div>
              </div>



              <div class="d-grid gap-2">
                <input class="alert alert-success" name="enviar" type="submit" value="ATUALIZAR PERFIL">

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

  <script>
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
    window.onload = function () {
      id('telefone').onkeyup = function () {
        mascara(this, mtel);
      }
    }
  </script>


</body>

</html>