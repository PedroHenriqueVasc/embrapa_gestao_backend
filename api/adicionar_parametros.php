<?php

// require_once ('classes/LancamentoRebanho.php');

header('Access-Control-Allow-Origin: http://localhost:3000');
require_once('classes/Connection.php');        


$arquivo = fopen('ids.txt', 'r');

$conteudo = fread($arquivo, filesize('ids.txt'));

$array = json_decode($conteudo);

fclose($arquivo);

// $lancamento = new LancamentoRebanho();

$data=date("Y-m-d h:i:s");

$periodoLactacao = $_POST['periodo-lactacao'];
$animalJovem = $_POST['animais-jovens'];
$idadeRepMatriz = $_POST['idade-reprodutiva-matriz'];
$idadeRepReprodutor = $_POST['idade-reprodutiva-rep'];
$idadeDescReprodutor = $_POST['idade-descarte-rep'];
$idadeDescMatriz = $_POST['idade-descarte-mat'];
$idPropriedade = $array->idPropriedade;
$idUsuario = $array->id;


$valor = array();

try{
    $connection = Connection::getConnection();            
    
    $query = "INSERT INTO parametros_reproducao (periodo_lactacao, idade_animal_jovem, idade_reprodutiva_matriz, idade_reprodutiva_rep, idade_descarte_matriz, idade_descarte_rep, data_cadastro, id_propriedade, id_usuario) 
    VALUES (:periodo_lactacao, :idade_animal_jovem, :idade_reprodutiva_matriz, :idade_reprodutiva_rep, :idade_descarte_matriz, :idade_descarte_rep, :data_cadastro, :id_propriedade, :id_usuario)";
    
    $stmt = $connection->prepare($query);
    
    $stmt->bindValue(':periodo_lactacao', $periodoLactacao);
    $stmt->bindValue(':idade_animal_jovem', $animalJovem);
    $stmt->bindValue(':idade_reprodutiva_matriz', $idadeRepMatriz);
    $stmt->bindValue(':idade_reprodutiva_rep', $idadeRepReprodutor);
    $stmt->bindValue(':idade_descarte_matriz', $idadeDescMatriz);
    $stmt->bindValue(':idade_descarte_rep', $idadeDescReprodutor);
    $stmt->bindValue(':data_cadastro', $data);
    $stmt->bindValue(':id_propriedade', $idPropriedade);
    $stmt->bindValue(':id_usuario', $idUsuario);        

    $result = $stmt->execute();
        

    $valor = array('status' => 'Success', 'value' => 'Parâmetros cadastrados com sucesso!');

}catch(PDOException $e){
    $valor =  $e;
}


    
// $lancamento->setTipoLancamento($_POST['tipo-lancamento']);
// $lancamento->setTipoEvento($_POST['tipo-evento']);
// $lancamento->setMatriz($_POST['id-matriz']);
// $lancamento->setDataRegistro($_POST['data-registro']);
// $lancamento->setDataCadastro($data);
// $lancamento->setIdUsuario($array->id);
// $lancamento->setIdPropriedade($array->idPropriedade);
// $lancamento->setDataCadastro($data);

// $valor = array('status' => 'Success', 'value' => 'teste');

// $retorno = $lancamento->adicionarRegistro();

echo json_encode($valor);
