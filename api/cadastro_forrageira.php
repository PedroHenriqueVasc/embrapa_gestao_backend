<?php

require_once ('classes/Forrageira.php');

header('Access-Control-Allow-Origin: http://localhost:3000');    

// $id = $_REQUEST['id'];

// $idPropriedade = $_REQUEST['idProp'];
$arquivo = fopen('ids.txt', 'r');

$conteudo = fread($arquivo, filesize('ids.txt'));

$array = json_decode($conteudo);

fclose($arquivo);

$forrageira = new Forrageira();

$data=date("Y-m-d h:i:s");

if($_POST['cycle'] == 'anual'){
    $forrageira->setFimCiclo($_POST['fim-ciclo']);
    $forrageira->setVidaUtil(null);    
}else{
    $forrageira->setFimCiclo(null);
    $forrageira->setVidaUtil($_POST['vida-util']);    
}
    
$forrageira->setCultura($_POST['culture']);
$forrageira->setArea($_POST['area']);
$forrageira->setCiclo($_POST['cycle']);
$forrageira->setUso($_POST['use']);
$forrageira->setIdUsuario($array->id);
$forrageira->setIdPropriedade($array->idPropriedade);
$forrageira->setDataCadastro($data);

// $retorno = array('status' => 'Success', 'value' => $_POST['vida-util']);
// echo json_encode($retorno);

$retorno = $forrageira->addForrageira();

echo json_encode($retorno);
