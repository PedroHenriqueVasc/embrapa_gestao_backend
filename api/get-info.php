<?php
    header('Access-Control-Allow-Origin: http://localhost:3000');    
    require_once('classes/Connection.php');    
    
    $arquivo = fopen('ids.txt', 'r');

    $conteudo = fread($arquivo, filesize('ids.txt'));

    $array = json_decode($conteudo);

    fclose($arquivo);

    $query = "SELECT nome FROM propriedade WHERE id_usuario = $array->id AND id_propriedade = $array->idPropriedade";

    // $query2 = ""

    $connection = Connection::getConnection();

    $sql = $connection->prepare($query);

    $sql->execute();

    $resultados = array();

    while($row = $sql->fetch(PDO::FETCH_ASSOC)){
        $resultados[] = $row;
    }

    if(!(empty($resultados))){        
        $res = array('status' => 'Success', 'value' => $resultados);
        echo json_encode($res);
    }else{
        $res = array('status' => 'Erro', 'value' => 'Erro ao obter informação');
        echo json_encode($res);
        
    }        