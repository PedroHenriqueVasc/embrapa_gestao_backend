<?php
    require_once('classes/Propriedade.php');
    header('Access-Control-Allow-Origin: http://localhost:3000');    

    // $url = $_SERVER["REQUEST_URI"];

    // $id = substr($url,-1);
    $id = $_REQUEST['id'];

    $d=date("Y-m-d");

    $propriedade = new Propriedade();

    $coordenadas = $_POST['coordenadas1'].' '.$_POST['coordenadas2'];
        
    $propriedade->setNome($_POST['nome']);
    $propriedade->setEstado($_POST['estado']);
    $propriedade->setMunicipio($_POST['municipio']);
    $propriedade->setCoordenadas($coordenadas);
    $propriedade->setRegistro($_POST['registro']);
    $propriedade->setAreaTotal($_POST['area-total']);
    $propriedade->setUnidadeMedida($_POST['select-unidade-area']);
    $propriedade->setValorHectare($_POST['valor-hectare']);
    $propriedade->setAreaPastagem($_POST['area-pastagem']);
    $propriedade->setAreaBenfeitoria($_POST['area-benfeitoria']);
    $propriedade->setAreaReserva($_POST['area-reserva']);
    $propriedade->setSaldo($_POST['saldo']);
    $propriedade->setDataCadastro($d);
    
    $retorno = $propriedade->cadastrar($id);
    
    $idPropriedade = $retorno[0]['id_propriedade'];

    $arquivo = fopen('ids.txt', 'w');
    if(!$arquivo){
        echo json_encode(array('status' => 'Erro', 'value' => 'Impossível criar arquivo'));    
    }

    $data = json_encode(array('id' => $id, 'idPropriedade' => $idPropriedade));
    
    fwrite($arquivo, $data);
    
    fclose($arquivo);
    
    echo json_encode(array('status' => 'Sucess', 'value' => $idPropriedade));    
?>