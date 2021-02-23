<?php

require_once ('classes/CulturaAgricola.php');

header('Access-Control-Allow-Origin: http://localhost:3000');    


$arquivo = fopen('ids.txt', 'r');

$conteudo = fread($arquivo, filesize('ids.txt'));

$array = json_decode($conteudo);

fclose($arquivo);

$data=date("Y-m-d h:i:s");

$cultura = new CulturaAgricola();

if($_POST['cycle'] == 'anual'){
    $cultura->setFimCiclo($_POST['fim-ciclo']);
    $cultura->setVidaUtil(null);    
}else{
    $cultura->setFimCiclo(null);
    $cultura->setVidaUtil($_POST['vida-util']);    
}
    
$cultura->setCultura($_POST['cultura']);
$cultura->setArea($_POST['area']);
$cultura->setCiclo($_POST['cycle']);
$cultura->setId($array->id);
$cultura->setIdPropriedade($array->idPropriedade);
$cultura->setDataCadastro($data);

// $retorno = array('status' => 'Success', 'value' => 'Teste');
// $retorno = array('status' => 'Success', 'value' => $_POST['vida-util']);

// echo json_encode($retorno);

$retorno = $cultura->adicionarCultura();
//  $retorno = array('status' => 'Success', 'value' => 'Teste');


echo json_encode($retorno);
