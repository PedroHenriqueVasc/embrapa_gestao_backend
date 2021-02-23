<?php
    //session_start();
    header('Access-Control-Allow-Origin: http://localhost:3000');    
    // header('Content-Type: application/json; charset=utf-8');

    // $arquivo = fopen('teste.txt', 'w');
    // if(!$arquivo) die('Não foi possível criar o arquivo');

    // $nome = $_POST['name'];
    // $email = $_POST['email'];

    // $texto = json_encode(array('nome' => $nome, 'email' => $email));
    
    // fwrite($arquivo, $texto);
    
    // fclose($arquivo);
    
    // if($nome){
    //     echo json_encode("Sucesso".$nome);
    // }else{        
    //     echo json_encode("Falha");
    // }
    $retorno = array('status' => 'Success', 'value' => 'Teste');
    echo json_encode($retorno);

    //$user = $_COOKIE['userIds'];

    //echo $user;