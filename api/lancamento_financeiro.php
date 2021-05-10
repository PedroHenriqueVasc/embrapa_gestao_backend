<?php

require_once ('classes/LancamentoFinanceiro.php');

header('Access-Control-Allow-Origin: http://localhost:3000');    

$arquivo = fopen('ids.txt', 'r');

$conteudo = fread($arquivo, filesize('ids.txt'));

$array = json_decode($conteudo);

fclose($arquivo);

$lancamento = new LancamentoFinanceiro();

$data=date("d-m-Y h:i:s");

$lancamento->setTipoLancamento($_POST['tipo']);
$lancamento->setCategoria($_POST['categoria']);
$lancamento->setAtividadeOvino($_POST['atividade-ovinos']);
$lancamento->setAtividadeCaprino($_POST['atividade-caprinos']);
$lancamento->setAtividadeBovinoLeite($_POST['bovino-leite']);
$lancamento->setAtividadeBovinoCorte($_POST['bovino-corte']);
$lancamento->setAtividadeBovinoMisto($_POST['bovino-misto']);
$lancamento->setAtividadeSuinocultura($_POST['suinocultura']);
$lancamento->setAtividadeAviculturaPost($_POST['avicultura-postura']);
$lancamento->setAtividadeAviculturaCorte($_POST['avicultura-corte']);
if($_POST['tipo'] == 'receita'){
    $lancamento->setAtividadeReceita($_POST['atividades-receita']);        
}
$lancamento->setDataLancamento($_POST['data']);
if($_POST['tipo'] == 'despesa'){
    $lancamento->setProduto($_POST['produto']);
}
if($_POST['tipo'] == 'investimento'){
    $lancamento->setVidaUtil($_POST['vida-util']);
}
if($_POST['tipo'] != 'investimento'){
    $lancamento->setQtdUnidade($_POST['qtd-unidade']);
}
$lancamento->setQtd($_POST['qtd']);
$lancamento->setValor($_POST['valor']);
$lancamento->setDescricao($_POST['descricao']);
$lancamento->setDataCadastro($data);
$lancamento->setId($array->id);
$lancamento->setIdPropriedade($array->idPropriedade);


$retorno = $lancamento->adicionarLancamento();
// $retorno = array('status' => 'Success', 'value' => 'teste');
// $retorno = array('status' => 'Success', 'value' => $_POST['valor']);
echo json_encode($retorno);


// echo json_encode($retorno);
