<?php

require_once ('classes/AnimaisTrabalho.php');

header('Access-Control-Allow-Origin: http://localhost:3000');    


$arquivo = fopen('ids.txt', 'r');

$conteudo = fread($arquivo, filesize('ids.txt'));

$array = json_decode($conteudo);

fclose($arquivo);


$animal = new AnimaisTrabalho();

$nome = $_POST['nome-animal'];

if($nome == '-1'){
    $nome = $_POST['outro'];
}

$data=date("Y-m-d h:i:s");
    
$animal->setNome($nome);
$animal->setCaracteristica($_POST['caracteristica']);
$animal->setQtd($_POST['qtd']);
$animal->setValor($_POST['valor']);
$animal->setVidaUtil($_POST['vida-util']);
$animal->setTempoUso($_POST['tempo-uso']);
$animal->setUsoCaprinos($_POST['uso-caprinos']);
$animal->setUsoOvinos($_POST['uso-ovinos']);
$animal->setId($array->id);
$animal->setIdPropriedade($array->idPropriedade);
$animal->setDataCadastro($data);

// $retorno = array('status' => 'Success', 'value' => $_POST['area']);
    // $retorno = array('status' => 'Success', 'value' => 'Ok');
    // echo json_encode($retorno);
    
// echo json_encode($retorno);

$retorno = $animal->adicionarAnimaisTrabalho();

echo json_encode($retorno);

// $retorno = array('status' => 'Success', 'value' => 'Teste');


