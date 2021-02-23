<?php

require_once ('classes/OutroPecuaria.php');

header('Access-Control-Allow-Origin: http://localhost:3000');    


$arquivo = fopen('ids.txt', 'r');

$conteudo = fread($arquivo, filesize('ids.txt'));

$array = json_decode($conteudo);

fclose($arquivo);
// $retorno = array('status' => 'Success', 'value' => 'Teste');
// echo json_encode($retorno);

$data=date("Y-m-d");

$rebanho = new OutroPecuaria();

$rebanho->setNome($_POST['nome-rebanho']);
$rebanho->setEspecie($_POST['especie']);
$rebanho->setQtd($_POST['qtd']);
$rebanho->setIdUsuario($array->id);
$rebanho->setIdPropriedade($array->idPropriedade);
$rebanho->setDataCadastro($data);


//echo json_encode($retorno);

$retorno = $rebanho->cadastrarOutroPecuaria();
// $retorno = array('status' => 'Success', 'value' => 'Teste');


echo json_encode($retorno);