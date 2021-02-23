<?php

require_once ('classes/Rebanho.php');

header('Access-Control-Allow-Origin: http://localhost:3000');    


$arquivo = fopen('ids.txt', 'r');

$conteudo = fread($arquivo, filesize('ids.txt'));

$array = json_decode($conteudo);

fclose($arquivo);
// $retorno = array('status' => 'Success', 'value' => 'Teste');
// echo json_encode($retorno);

$data=date("Y-m-d");

$raca = $_POST['raca'];

if($raca == '-1'){
    $raca = $_POST['outro'];
}


$rebanho = new Rebanho();

$rebanho->setNomeRebanho($_POST['nome-rebanho']);
$rebanho->setEspecie($_POST['especie']);
$rebanho->setRaca($raca);
$rebanho->setCategoria($_POST['categoria']);
$rebanho->setQtd($_POST['qtd']);
$rebanho->setIdUsuario($array->id);
$rebanho->setIdPropriedade($array->idPropriedade);
$rebanho->setDataCadastro($data);


// $retorno = array('status' => 'Success', 'value' => $_POST['raca']);

//echo json_encode($retorno);

$retorno = $rebanho->cadastrarRebanho();
// $retorno = array('status' => 'Success', 'value' => 'Teste');


echo json_encode($retorno);