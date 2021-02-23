<?php

require_once ('classes/Benfeitorias.php');

header('Access-Control-Allow-Origin: http://localhost:3000');    


$arquivo = fopen('ids.txt', 'r');

$conteudo = fread($arquivo, filesize('ids.txt'));

$array = json_decode($conteudo);

fclose($arquivo);


$benfeitoria = new Benfeitorias();

$data=date("Y-m-d h:i:s");

$nome = $_POST['nomeBenfeitoria'];

if($nome == '-1'){
    $nome = $_POST['outro'];
}
    
    
$benfeitoria->setNome($nome);
$benfeitoria->setCaracteristica($_POST['caracteristica']);
$benfeitoria->setQtd($_POST['qtd']);
$benfeitoria->setValor($_POST['valor']);
$benfeitoria->setVidaUtil($_POST['vida-util']);
$benfeitoria->setTempoUso($_POST['tempo-uso']);
$benfeitoria->setUsoCaprinos($_POST['uso-caprinos']);
$benfeitoria->setUsoOvinos($_POST['uso-ovinos']);
$benfeitoria->setId($array->id);
$benfeitoria->setIdPropriedade($array->idPropriedade);
$benfeitoria->setDataCadastro($data);

// $retorno = array('status' => 'Success', 'value' => $_POST['area']);
    // $retorno = array('status' => 'Success', 'value' => 'Ok');
    // echo json_encode($retorno);
    
// echo json_encode($retorno);

$retorno = $benfeitoria->adicionarBenfeitoria();

echo json_encode($retorno);

// $retorno = array('status' => 'Success', 'value' => 'Teste');


