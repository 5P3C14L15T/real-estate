<?php
  require_once "config/DB.php"; 

  if(isset($_SESSION['login2']) && $_SESSION['login2'] == "logado2") {
    header("Location: app/dashboard.php");
    
    }


?>

<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="imagem/icon.png">
    <!-- CSS only -->
    <link rel="stylesheet" href="css/style1.css" />
    <!-- <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    /> -->
    <script
    src="https://kit.fontawesome.com/6c66823518.js"
    crossorigin="anonymous"
  ></script>
    <title>Apartamento a Venda Cuiabá</title>
  </head>

<body>
<header class="main">
      <nav class="menu">
        <div class="containerHeader">
          <div class="logo">
            <img
              src="imagem/logo.png"
              class="img-fluid logo-img"
              alt=""
              srcset=""
            />
          </div>
        </div>
      </nav>
    </header>

	<!-- container div -->
	<div class="container">

		<!-- upper button section to select
			the login or signup form -->
		<div class="slider"></div>
		<div class="btn">
			<button class="login">Login</button>
			<button class="signup">Conta</button>
		</div>

		<!-- Form section that contains the
			login and the signup form -->
		<div class="form-section">

			<!-- login form -->
			<div class="login-box">
        <label for="email">Insira seu email</label>
				<input type="email"
					class="email ele"
					placeholder="seuemail@email.com.br">
          <label for="email">Sua senha</label>
				<input type="password"
					class="password ele"
					placeholder="Senha">
				<button class="clkbtn">Entrar</button>
			</div>

			<!-- signup form -->
			<div class="signup-box">
      <label for="email">Insira o seu nome</label>
				<input type="text"
					class="name ele"
					placeholder="Qual o seu nome">
          <label for="email">Qual o seu Email</label>
				<input type="email"
					class="email ele"
					placeholder="seuemail@email.com.br">
          <label for="email">Seu WhatsApp</label>
				<input type="text"
					class="password ele"
					placeholder="Insira seu WhatsApp">
          <label for="email">Sua senha</label>
				<input type="password"
					class="password ele"
					placeholder="Insira uma senha">
				<button class="clkbtn">Criar conta</button>
			</div>
		</div>
	</div>



  <footer class="footer">
      <div class="footerContainer">
        <div class="row">
          <h1>APARTAMENTOAVENDACUIABA.COM.BR</h1>
          <p>&copy; Todos os Direitos Reservados</p>
        </div>
      </div>
    </footer>

    <script src="index.js"></script>

    <!-- JavaScript Bundle with Popper -->
    <!-- <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
      crossorigin="anonymous"
    ></script> -->
  </body>
</html>

