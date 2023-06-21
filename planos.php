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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <title>Planos | Apartamento a Venda Cuiabá</title>
</head>

<body>
    <header class="main">
        <nav class="menu">
            <div class="container">
                <div class="logo">
                    <a href="index.php">
                        <img src="imagem/logo.png" class="img-fluid logo-img" alt="" srcset="" />
                    </a>
                </div>
            </div>

        </nav>
    </header>
    <section class="planoMain">
        <div class="container mb-5">
            <div class="row mb-5">
                <div class="planoMainTitulo col-md-8 mx-auto text-center">
                    <h1 class="mb-5">Anuncie seu apartamento em Cuiabá e alcance os compradores certos!</h1>
                    <a href="#" class="text-center">
                        <div class="imgPlan col-md-4 mx-auto text-center" role="alert">
                            <img src="imagem/plan.svg" width="40"> <span> &nbsp; Planos Premium</span>
                        </div>
                    </a>

                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4 adsMainBox my-2">
                    <div class="adsMainBoxContent">
                        <div class="adsMainBoxContentIcon">
                            <img src="imagem/apartamento.svg" width="40" alt="" srcset="">
                        </div>
                        <div class="adsMainBoxContentTitle">
                            <h3>Focado em Apartamentos</h3>
                        </div>
                        <div class="adsMainBoxContentDesc">
                            Atraímos interessados reais em apartamentos
                        </div>
                    </div>
                </div>
                <div class="col-md-4 adsMainBox my-2">
                    <div class="adsMainBoxContent">
                        <div class="adsMainBoxContentIcon">

                            <img src="imagem/cuiaba.svg" width="40" alt="" srcset="">

                        </div>
                        <div class="adsMainBoxContentTitle">
                            <h3>Cidade de Cuiabá</h3>
                        </div>
                        <div class="adsMainBoxContentDesc">
                            Buscando mais negócios para a capital
                        </div>
                    </div>
                </div>
                <div class="col-md-4 adsMainBox my-2">
                    <div class="adsMainBoxContent">
                        <div class="adsMainBoxContentIcon">

                            <img src="imagem/lupa.svg" width="40" alt="" srcset="">

                        </div>
                        <div class="adsMainBoxContentTitle">
                            <h3>600Mil Buscas</h3>
                        </div>
                        <div class="adsMainBoxContentDesc">
                            Potencial de atender toda a população de Cuiabá
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="container">
            <div class="row">
                <section class="precoMain text-center">
                    <h1 class="mb-5">Qual plano PREMUIM se adequa melhor para você?</h1>
                </section>

                <div class="col-md-8 mx-auto precoCore">
                    <div class="row">
                        <div class="col-md-6 text-center">

                            <div class="planoCard">
                                <div class="planoCardHeader">
                                    Plano Premium Mês
                                </div>
                                <div class="planoCardBody">
                                    <h4>Anúncios Ilimitados</h4>
                                    <p>R$ <span class="planoPrice">97,90</span> <span class="planoTempo"> / mês</span> </p>
                                    <a href="#" class="planoCardBotao">Contratar Agora</a>
                                </div>
                                <div class="planoCardRodape">
                                    <p>Insira anúncios <strong>ilimitados</strong> por mês</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6  text-center">
                            <div class="planoCard">
                                <div class="planoCardHeader">
                                    <span class="desconto">-50%OFF</span> Plano Premium <span class="anual">Ano</span>
                                </div>
                                <div class="planoCardBody">
                                    <h4>Anúncios Ilimitados</h4>
                                    <p>R$ <span class="planoPrice">497,90</span> <span class="planoTempo"> / ano</span> </p>
                                    <a href="#" class="planoCardBotao">Contratar Agora</a>
                                </div>
                                <div class="planoCardRodape">
                                    <p>Insira anúncios <strong>ilimitados</strong> por ano</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mx-auto formas-pgto text-center mt-5">Formas de pagamento aceitas:</div>
                    <div class="col-md-6 mx-auto formas-pgto text-center"><img src="imagem/pgto.png" alt=""></div>
                    <div class="col-md-6 mx-auto formas-pgto text-center">O plano tem cobrança recorrente, até o cancelamento. Você pode cancelar a qualquer momento sem multa.</div>
                </div>
            </div>
        </div>
    </section>

    <section class="social">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto text-center">
                    <div class="row">
                        <div class="col-md-6">
                            <h1>titulo</h1>
                            <h2>subtitulo</h2>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi, ut illo doloremque dignissimos expedita repudiandae? Et a alias animi? Distinctio sint consequuntur facilis vero exercitationem error? Natus temporibus consequatur saepe, unde quam provident minima fuga ea, corporis iusto veritatis porro!</p>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem quisquam ab nihil modi vero enim culpa, atque eaque ipsam facilis voluptate excepturi exercitationem saepe? Consectetur ducimus ipsa laudantium sed eos!</p>
                            <p class="chamada">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Blanditiis, officiis.</p>
                        </div>
                        <div class="col-md-6">Imagem</div>
                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


</body>

</html>