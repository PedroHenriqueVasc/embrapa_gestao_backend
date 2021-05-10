<?php
    //session_start();
    header('Access-Control-Allow-Origin: http://localhost:3000');    
    header('Content-Type: application/json; charset=utf-8');
    require_once('classes/Connection.php');

    $arquivo = fopen('ids.txt', 'r');

    $conteudo = fread($arquivo, filesize('ids.txt'));

    $array = json_decode($conteudo);

    $query = "SELECT especie FROM outro_pecuaria WHERE id_propriedade = $array->idPropriedade";    

    $connection = Connection::getConnection();
    $stmt = $connection->query($query);

    $especie = $stmt->fetchAll();

    // Obtendo os rebanhos cadastrados
    $query2 = "SELECT distinct nome_rebanho_simples FROM rebanho_simples rs WHERE rs.id_propriedade = $array->idPropriedade";    
    $query3 = "SELECT distinct nome_rebanho_detalhado FROM rebanho_detalhado rd WHERE rd.id_propriedade = $array->idPropriedade";    
    $stmt2 = $connection->query($query2);
    $stmt3 = $connection->query($query3);
    
    $rebanhoSimples = $stmt2->fetchAll();
    $rebanhoDetalhado = $stmt3->fetchAll();

    // Obtendo as categorias
    $query4 = "select identificacao_animal, categoria from rebanho_detalhado where categoria = 'matriz' or categoria = 'reprodutor' and id_propriedade = $array->idPropriedade";    
    $stmt4 = $connection->query($query4);
    
    // $categorias = $stmt4->fetchAll();

    while($row = $stmt4->fetch(PDO::FETCH_ASSOC)){
        $categorias[] = $row;
    }

    // Obtendo as raças
    $query5 = "select raca from rebanho_simples where categoria = 'matriz' and id_propriedade = $array->idPropriedade union select raca from rebanho_detalhado where categoria = 'matriz' and id_propriedade = $array->idPropriedade";    
    $stmt5 = $connection->query($query5);
    
    $racas = $stmt5->fetchAll();    
    

    // while($row = $stmt4->fetch(PDO::FETCH_ASSOC)){
    //     $categorias[] = $row;
    // }

    $retorno = array('status' => 'Success', 'value' => $especie, 'rebanho_simples' => $rebanhoSimples, 'rebanho_detalhado' => $rebanhoDetalhado, 'categorias' => $categorias, 'racas' => $racas);
    // $retorno = array('status' => 'Success', 'value' => 'teste');
    echo json_encode($retorno);    
    // print_r($categorias);
    // $_SESSION['id'] = $user_id;
    
    // if($num){
        // echo "<h1>Teste</h1>";
    // }

    
    // if(!(empty($user))){        
    //     // header("Location: http://localhost:3000/selecionar-propriedade.html?id=".$user_id);
    //     echo "Teste";
    // }else{
    //     header('Location: http://localhost:3000/index.html');
    //     exit();
    // }