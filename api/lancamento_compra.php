<?php

header('Access-Control-Allow-Origin: http://localhost:3000');
require_once('classes/Connection.php');        
require_once('classes/Rebanho.php');
require_once('classes/RebanhoDetalhado.php');


$lancamento = new LancamentoRebanho();

$rebanho = new Rebanho();
$rebanhoDet = new RebanhoDetalhado();

$arquivo = fopen('ids.txt', 'r');

$conteudo = fread($arquivo, filesize('ids.txt'));

$array = json_decode($conteudo);

fclose($arquivo);

// $lancamento = new LancamentoRebanho();

$data=date("Y-m-d h:i:s");
$data1 = date("Y-m-d");


$rebanhoCompra = $_POST['rebanho'];
$tipoLancamento = $_POST['tipo-lancamento'];
$idAnimal = $_POST['id-animal'];
$especie = $_POST['especie'];
$raca = $_POST['raca'];
$categoria = $_POST['categoria'];
$dataCompra = $_POST['data-compra'];
$dataNascimento = $_POST['data-nascimento'];
$valor = $_POST['valor-compra'];
$qtd = $_POST['qtd-compra'];
$idPropriedade = $array->idPropriedade;
$idUsuario = $array->id;

// $valor = array();

if($idAnimal == ''){
    try{
        $connection = Connection::getConnection();                
        
        
        $rebanho->setNomeRebanho($_POST['rebanho']);    
        $rebanho->setRaca($_POST['raca']);
        $rebanho->setQtd($_POST['qtd-compra']);
        $rebanho->setCategoria($_POST['categoria']);
        $rebanho->setEspecie($especie);
        $rebanho->setIdUsuario($array->id);
        $rebanho->setIdPropriedade($array->idPropriedade);
        $rebanho->setDataCadastro($data);

        // $retornoRS = $rebanho->cadastrarRebanho();

        $query2 = "INSERT INTO lancamento_rebanho (tipo_lancamento, rebanho, data_registro, categoria, qtd, valor, data_cadastro, id_propriedade, id_usuario)  
            VALUES (:tipo_lancamento, :rebanho, :data_registro, :categoria, :qtd, :valor, :data_cadastro, :id_propriedade, :id_usuario)";
        
        $stmt2 = $connection->prepare($query2);
        
        $stmt2->bindValue(':tipo_lancamento', $tipoLancamento);
        $stmt2->bindValue(':rebanho', $rebanhoCompra);
        $stmt2->bindValue(':data_registro', $dataCompra);            
        $stmt2->bindValue(':categoria', $categoria);            
        $stmt2->bindValue(':qtd', $qtd);            
        $stmt2->bindValue(':valor', $valor);            
        $stmt2->bindValue(':data_cadastro', $data);            
        $stmt2->bindValue(':id_propriedade', $idPropriedade);
        $stmt2->bindValue(':id_usuario', $idUsuario);
    
        $result = $stmt2->execute();
            
    
        $valor = array('status' => 'Success', 'value' => 'Compra e rebanho cadastrados com sucesso!');
    
    }catch(PDOException $e){
        $valor = array('status' => 'Erro', 'value' => $e);
    }
}
else{
    try{        
        $connection = Connection::getConnection();

        $rebanhoDet->setNomeRebanho($_POST['rebanho']);
        $rebanhoDet->setIdentificacaoAnimal($_POST['id-animal']);
        $rebanhoDet->setDataNascimento($_POST['data-nascimento']);
        $rebanhoDet->setEspecie($_POST['especie']);
        $rebanhoDet->setRaca($raca);
        $rebanhoDet->setCategoria($_POST['categoria']);
        $rebanhoDet->setIdUsuario($array->id);
        $rebanhoDet->setIdPropriedade($array->idPropriedade);
        $rebanhoDet->setDataCadastro($data);
        
        $retornoDet = $rebanhoDet->cadastrarRebanho();
        
        
        $query2 = "INSERT INTO lancamento_rebanho (tipo_lancamento, rebanho, data_nascimento, id_animal, data_registro, categoria, valor, data_cadastro, id_propriedade, id_usuario)  
            VALUES (:tipo_lancamento, :rebanho, :data_nascimento, :id_animal, :data_registro, :categoria, :valor, :data_cadastro, :id_propriedade, :id_usuario)";
        
        $stmt2 = $connection->prepare($query2);
        
        $stmt2->bindValue(':tipo_lancamento', $tipoLancamento);
        $stmt2->bindValue(':rebanho', $rebanhoCompra);
        $stmt2->bindValue(':data_nascimento', $dataNascimento);            
        $stmt2->bindValue(':id_animal', $idAnimal);            
        $stmt2->bindValue(':data_registro', $dataCompra);            
        $stmt2->bindValue(':categoria', $categoria);                               
        $stmt2->bindValue(':valor', $valor);            
        $stmt2->bindValue(':data_cadastro', $data);            
        $stmt2->bindValue(':id_propriedade', $idPropriedade);
        $stmt2->bindValue(':id_usuario', $idUsuario);
    
        $result = $stmt2->execute();
            
    
        $valor = array('status' => 'Success', 'value' => 'Compra e rebanho cadastrados com sucesso!');
    
    }catch(PDOException $e){
        $valor = array('status' => 'Erro', 'value' => $e);
    }
}
// $data2 = DateTime::createFromFormat("Y-m-d", $dataNascimento);

// $intervalo = $data1->diff($data2);
// $intervalo->format('%R%a dias');

// $anoNasc = substr($dataNascimento,0,4);
// $mesesNasc = substr($dataNascimento, 5,2);

// $anoAtual = substr($dataCompra,0,4);
// $mesesAtual = substr($dataCompra, 5,2);
// $idade = ($anoAtual - $anoNasc) * 12;
// // $mesesTotal = 0;

// if($idade == 0){
//     $mesesTotal = $mesesAtual - $mesesNasc;

//     // if($mesesTotal )
// }

// $connection = Connection::getConnection();            
// $query1 = "select periodo_lactacao, idade_animal_jovem, idade_reprodutiva_matriz, idade_reprodutiva_rep from parametros_reproducao";
    
// $stmt1 = $connection->query($query1);

// $parametros = $stmt1->fetch(PDO::FETCH_ASSOC);

// try{
//     $connection = Connection::getConnection();        
    
//     $query = "INSERT INTO parametros_reproducao (periodo_lactacao, idade_animal_jovem, idade_reprodutiva_matriz, idade_reprodutiva_rep, idade_descarte_matriz, idade_descarte_rep, data_cadastro, id_propriedade, id_usuario) 
//     VALUES (:periodo_lactacao, :idade_animal_jovem, :idade_reprodutiva_matriz, :idade_reprodutiva_rep, :idade_descarte_matriz, :idade_descarte_rep, :data_cadastro, :id_propriedade, :id_usuario)";
    
//     $stmt = $connection->prepare($query);
    
//     $stmt->bindValue(':periodo_lactacao', $periodoLactacao);
//     $stmt->bindValue(':idade_animal_jovem', $animalJovem);
//     $stmt->bindValue(':idade_reprodutiva_matriz', $idadeRepMatriz);
//     $stmt->bindValue(':idade_reprodutiva_rep', $idadeRepReprodutor);
//     $stmt->bindValue(':idade_descarte_matriz', $idadeDescMatriz);
//     $stmt->bindValue(':idade_descarte_rep', $idadeDescReprodutor);
//     // $stmt->bindValue(':tempo_secagem', $tempoSecagem);
//     // $stmt->bindValue(':permanencia_reprodutor', $permanenciaReprodutores);
//     // $stmt->bindValue(':permanencia_matriz', $permanenciaMatrizes);
//     // $stmt->bindValue(':intervalo_partos', $intervaloPartos);
//     $stmt->bindValue(':data_cadastro', $data);
//     $stmt->bindValue(':id_propriedade', $idPropriedade);
//     $stmt->bindValue(':id_usuario', $idUsuario);        

//     $result = $stmt->execute();
        

//     $valor = array('status' => 'Success', 'value' => 'Parâmetros cadastrados com sucesso!');

// }catch(PDOException $e){
//     $valor =  $e;
// }


    
// $lancamento->setTipoLancamento($_POST['tipo-lancamento']);
// $lancamento->setTipoEvento($_POST['tipo-evento']);
// $lancamento->setMatriz($_POST['id-matriz']);
// $lancamento->setDataRegistro($_POST['data-registro']);
// $lancamento->setDataCadastro($data);
// $lancamento->setIdUsuario($array->id);
// $lancamento->setIdPropriedade($array->idPropriedade);
// $lancamento->setDataCadastro(;$data);

// $valor = array('status' => 'Success', 'value' => 'Teste');
// $valor = array('status' => 'Success', 'value' => $parametros);
// $valor = array('status' => 'Success', 'value' => $especie);
// $valor = array('status' => 'Success', 'value' => $data1);
// $valor = array('status' => 'Success', 'value' => $dataNascimento);

// $retorno = $lancamento->adicionarRegistro();

echo json_encode($valor);
