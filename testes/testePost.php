<?php
    //header('Access-Control-Allow-Origin: \*');    
    header('Content-Type: application/json; charset=utf-8');

    $arquivo = fopen('teste.txt', 'r');
    if(!$arquivo) die('Não foi possível criar o arquivo');

    // $nome = $_POST['name'];
    // $email = $_POST['email'];

    // $texto = json_encode(array('nome' => $nome, 'email' => $email));
    
    $conteudo = fread($arquivo, filesize('teste.txt'));

    $array = json_decode($conteudo);
    
    fclose($arquivo);


    //$nome = $array["nome"];
    
    if($arquivo){
        // echo $conteudo["nome"];
        // echo $nome;
        // print_r($array);
        print_r($array->nome);
    }else{        
        echo json_encode("Falha");
    }