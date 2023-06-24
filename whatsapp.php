<?php

require_once('config/DB.php');

$db = new DB;

if (isset($_POST['enviar'])) {

$data = $_REQUEST;

echo '<pre>';
print_r($data);
echo '</pre>';

function deixarNumero($string){
    return preg_replace("/[^0-9]/", "", $string);
  }
  

$titulo = rtrim($data['titulo']);
$whatsapp = rtrim($data['whatsapp']);
$quartos = rtrim($data['quarto']);
$area = rtrim($data['area']) . "m²";

$whatsapp = deixarNumero($whatsapp);

// insert lead

$nomeLead = $_POST['nomeLead'];
$whatsappLead = $_POST['whatsappLead'];
$urlLead = $data['url'];
$valorLead = $data['valor'];
$bairroLead = $data['bairroNome'];
$quartosLead = $data['quarto'];

echo $urlLead;

echo '<hr>';

$db->inserirLead($nomeLead,$whatsappLead,$urlLead,$valorLead,$bairroLead,$quartosLead);

    $urlEncaminha = "https://api.whatsapp.com/send?phone=55".$whatsapp."&text=";
    $urlEncaminha .= "🏢 *" . $titulo . "* %0A%0A";
    $urlEncaminha .= "💰```Valor: R$" . number_format($data['valor'],2,',','.') . "```%0A";
    $urlEncaminha .= "📍```Bairro: " . $data['bairroNome'] . "```%0A";
    $urlEncaminha .= "⏹```Quartos: " . $quartos . "```%0A";
    $urlEncaminha .= "📐```Área: " . $area .  "```%0A%0A";
    $urlEncaminha .= "Meu nome é: *" .$nomeLead . "*, Vi esse imóvel no site: %0A". "https://www.apartamentoavendacuiaba.com.br". $data['url'];

    echo $urlEncaminha;

    header("Location: $urlEncaminha");



}
