<?php
    //session_start();
    header('Access-Control-Allow-Origin: http://localhost:3000');    
    header('Content-Type: application/json; charset=utf-8');
    require_once('classes/Connection.php');

    $arquivo = fopen('ids.txt', 'r');

    $conteudo = fread($arquivo, filesize('ids.txt'));

    $array = json_decode($conteudo);

    $query = "SELECT id_usuario, nome FROM usuario WHERE id_usuario = $array->id";

    $connection = Connection::getConnection();
    $stmt = $connection->query($query);

    $user = $stmt->fetchAll();

    $nome = $user[0]['nome'];

    $retorno = array('status' => 'Success', 'value' => $nome);

    echo json_encode($retorno);
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