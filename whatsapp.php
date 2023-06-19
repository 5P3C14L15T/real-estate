<?php

require_once('config/DB.php');

$db = new DB;

if (isset($_POST['enviar'])) {

$data = $_REQUEST;

echo '<pre>';
print_r($data);
echo '</pre>';

$titulo = rtrim($data['titulo']);
$whatsapp = rtrim($data['whatsapp']);
$quartos = rtrim($data['quarto']);
$area = rtrim($data['area']) . "m²";
// echo $titulo;

// insert lead

$nomeLead = $_POST['nomeLead'];
$whatsappLead = $_POST['whatsappLead'];
$urlLead = $data['url'];
$valorLead = $data['valor'];
$bairroLead = $data['bairroNome'];
$quartosLead = $data['quarto'];

$db->inserirLead($nomeLead,$whatsappLead,$urlLead,$valorLead,$bairroLead,$quartosLead);

    $urlEncaminha = "https://api.whatsapp.com/send?phone=55".$whatsapp."&text=";
    $urlEncaminha .= "🏢 *" . $titulo . "* %0A%0A";
    $urlEncaminha .= "```Valor: R$" . number_format($data['valor'],2,',','.') . "```%0A";
    $urlEncaminha .= "```Bairro: " . $data['bairroNome'] . "```%0A";
    $urlEncaminha .= "```Quartos: " . $quartos . "```%0A";
    $urlEncaminha .= "```Área: " . $area . "m²" . "```%0A%0A";
    $urlEncaminha .= "Meu nome é: *" .$nomeLead . "*, Vi esse imóvel no site: %0A". $data['url'];

    echo $urlEncaminha;

    header("Location: $urlEncaminha");



}

https://api.whatsapp.com/send?phone=5565996335509&text=%F0%9F%8F%A2%20*T%C3%ADtulo%20do%20apartamento%20vai%20aqui*%0A%60%60%60Valor%3A%20R%24%20pre%C3%A7o%20aqui%60%60%60%0A%60%60%60Bairro%3A%20bairro%20aqui%60%60%60%0AVi%20esse%20apartamento%20no%20site%3A%20url%20aqui