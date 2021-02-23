<?php
    header('Access-Control-Allow-Origin: http://localhost:3000');  
    
    unlink("ids.txt");

    $retorno = array('status' => 'Success', 'value' => 'Cadastro Concluído!');

    echo json_encode($retorno);