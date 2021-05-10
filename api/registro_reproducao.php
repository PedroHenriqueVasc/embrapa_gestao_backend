<?php

require_once ('classes/LancamentoRebanho.php');

header('Access-Control-Allow-Origin: http://localhost:3000');    


$arquivo = fopen('ids.txt', 'r');

$conteudo = fread($arquivo, filesize('ids.txt'));

$array = json_decode($conteudo);

fclose($arquivo);

$lancamento = new LancamentoRebanho();

$data=date("Y-m-d h:i:s");

if($_POST['tipo-evento'] != 'cobertura'){
    $lancamento->setReprodutor('-');
}
else{
    $lancamento->setReprodutor($_POST['reprodutor']);
}

    
$lancamento->setTipoLancamento($_POST['tipo-lancamento']);
$lancamento->setTipoEvento($_POST['tipo-evento']);
$lancamento->setMatriz($_POST['id-matriz']);
$lancamento->setDataRegistro($_POST['data-registro']);
$lancamento->setDataCadastro($data);
$lancamento->setIdUsuario($array->id);
$lancamento->setIdPropriedade($array->idPropriedade);
$lancamento->setDataCadastro($data);

// $retorno = array('status' => 'Success', 'value' => 'teste');

$retorno = $lancamento->adicionarRegistro();

echo json_encode($retorno);
