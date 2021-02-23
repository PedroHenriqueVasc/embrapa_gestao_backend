<?php

require_once ('classes/Equipamentos.php');

header('Access-Control-Allow-Origin: http://localhost:3000');    


$arquivo = fopen('ids.txt', 'r');

$conteudo = fread($arquivo, filesize('ids.txt'));

$array = json_decode($conteudo);

fclose($arquivo);


$equipamento = new Equipamentos();

$data=date("Y-m-d h:i:s");

$nome = $_POST['nome-equipamento'];

if($nome == '-1'){
        $nome = $_POST['outro'];
    }
    
    
$equipamento->setNome($nome);
$equipamento->setCaracteristica($_POST['caracteristica']);
$equipamento->setQtd($_POST['qtd']);
$equipamento->setValor($_POST['valor']);
$equipamento->setVidaUtil($_POST['vida-util']);
$equipamento->setTempoUso($_POST['tempo-uso']);
$equipamento->setUsoCaprinos($_POST['uso-caprinos']);
$equipamento->setUsoOvinos($_POST['uso-ovinos']);
$equipamento->setId($array->id);
$equipamento->setIdPropriedade($array->idPropriedade);
$equipamento->setDataCadastro($data);

// $retorno = array('status' => 'Success', 'value' => $_POST['area']);
    // $retorno = array('status' => 'Success', 'value' => 'Ok');
    // echo json_encode($retorno);
    
// echo json_encode($retorno);

$retorno = $equipamento->adicionarEquipamentos();

echo json_encode($retorno);

// $retorno = array('status' => 'Success', 'value' => 'Teste');


