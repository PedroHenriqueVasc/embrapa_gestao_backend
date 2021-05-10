<?php

require_once ('classes/LancamentoRebanho.php');
require_once ('classes/Rebanho.php');
require_once ('classes/RebanhoDetalhado.php');
require_once('classes/Connection.php');

header('Access-Control-Allow-Origin: http://localhost:3000');    

$arquivo = fopen('ids.txt', 'r');

$conteudo = fread($arquivo, filesize('ids.txt'));

$array = json_decode($conteudo);

fclose($arquivo);

$connection = Connection::getConnection();

$lancamento = new LancamentoRebanho();
$lancamento2 = new LancamentoRebanho();
$lancamento3 = new LancamentoRebanho();
$lancamento4 = new LancamentoRebanho();

$rebanho = new Rebanho();
$rebanhoDet = new RebanhoDetalhado();

$data=date("d-m-Y h:i:s");
$raca1 = $_POST['raca1'];
$raca2 = $_POST['raca2'];
$raca3 = $_POST['raca3'];
$raca4 = $_POST['raca4'];


if($_POST['cria1'] != ''){
    $lancamento->setMatriz($_POST['matriz']);
    $lancamento->setReprodutor($_POST['reprodutor']);

    // Cadastrando animal 1 no rebanho detalhado
    $rebanhoDet->setIdentificacaoAnimal($_POST['cria1']);
    $rebanhoDet->setDataNascimento($_POST['data-nascimento']);
    $rebanhoDet->setNomeRebanho($_POST['nasc-rebanho']);    
    $rebanhoDet->setRaca($_POST['raca1']);    
    $rebanhoDet->setIdUsuario($array->id);
    $rebanhoDet->setIdPropriedade($array->idPropriedade);
    $rebanhoDet->setDataCadastro($data);

    $query = "select especie from rebanho_detalhado where raca = '$raca1' and id_propriedade = $array->idPropriedade";    
    $stmt = $connection->query($query);

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $esp[] = $row;
    }
    
    $especie =$esp[0]['especie'];
    $rebanhoDet->setEspecie($especie);

    if($_POST['sexo1'] == 'macho'){
        $rebanhoDet->setCategoria('macho jovem');    
    }
    else{
        $rebanhoDet->setCategoria('fêmea jovem');    
    }

    $retornoRD = $rebanhoDet->cadastrarRebanho();
}
else{
    
    $lancamento->setMatriz('-');
    $lancamento->setReprodutor('-'); 
    
    // Cadastrando animal 1 no rebanho simplificado
    $rebanho->setNomeRebanho($_POST['nasc-rebanho']);    
    $rebanho->setRaca($raca1);
    $rebanho->setQtd(1);
    $rebanho->setIdUsuario($array->id);
    $rebanho->setIdPropriedade($array->idPropriedade);
    $rebanho->setDataCadastro($data);

    if($_POST['sexo1'] == 'macho'){
        $rebanho->setCategoria('macho jovem');    
    }
    else{
        $rebanho->setCategoria('fêmea jovem');    
    }    

    $query = "select especie from rebanho_simples where raca = '$raca1' and id_propriedade = $array->idPropriedade";    
    $stmt = $connection->query($query);
    

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $esp[] = $row;
    }
    
    $especie =$esp[0]['especie'];
    

    $retornoRS = $rebanho->cadastrarRebanho();
}

$lancamento->setTipoLancamento($_POST['tipo-lancamento']);
$lancamento->setRebanho($_POST['nasc-rebanho']);
$lancamento->setTipoParto($_POST['tipo-parto']);
$lancamento->setSexo($_POST['sexo1']);
$lancamento->setPeso($_POST['peso1']);
$lancamento->setIdCria($_POST['cria1']);
$lancamento->setDataNascimento($_POST['data-nascimento']);
$lancamento->setDataCadastro($data);
$lancamento->setIdUsuario($array->id);
$lancamento->setIdPropriedade($array->idPropriedade);

$retorno = $lancamento->adicionarNascimento();
$retorno = array('status' => 'Success', 'value' => 'teste');

$tipoParto = $_POST['tipo-parto'];

// Parto duplo
if($tipoParto == 'duplo'){
    // Cria 2
    if($_POST['cria2'] != ''){
        $lancamento2->setMatriz($_POST['matriz']);
        $lancamento2->setReprodutor($_POST['reprodutor']);

        // Cadastrando animal 2 no rebanho detalhado
        $rebanhoDet->setIdentificacaoAnimal($_POST['cria2']);
        $rebanhoDet->setDataNascimento($_POST['data-nascimento']);
        $rebanhoDet->setNomeRebanho($_POST['nasc-rebanho']);    
        $rebanhoDet->setRaca($_POST['raca2']);    
        $rebanhoDet->setIdUsuario($array->id);
        $rebanhoDet->setIdPropriedade($array->idPropriedade);
        $rebanhoDet->setDataCadastro($data);

        $query = "select especie from rebanho_detalhado where raca = '$raca2' and id_propriedade = $array->idPropriedade";    
        $stmt = $connection->query($query);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $esp[] = $row;
        }
        
        $especie =$esp[0]['especie'];
        $rebanhoDet->setEspecie($especie);

        if($_POST['sexo2'] == 'macho'){
            $rebanhoDet->setCategoria('macho jovem');    
        }
        else{
            $rebanhoDet->setCategoria('fêmea jovem');    
        }

        $retornoRD = $rebanhoDet->cadastrarRebanho();
    }
    else{
        $lancamento2->setMatriz('-');
        $lancamento2->setReprodutor('-');
        
        // Cadastrando animal 2 no rebanho simplificado
        $rebanho->setNomeRebanho($_POST['nasc-rebanho']);    
        $rebanho->setRaca($raca2);
        $rebanho->setQtd(1);
        $rebanho->setIdUsuario($array->id);
        $rebanho->setIdPropriedade($array->idPropriedade);
        $rebanho->setDataCadastro($data);

        if($_POST['sexo2'] == 'macho'){
            $rebanho->setCategoria('macho jovem');    
        }
        else{
            $rebanho->setCategoria('fêmea jovem');    
        }

        $query = "select especie from rebanho_simples where raca = '$raca2' and id_propriedade = $array->idPropriedade";    
        $stmt = $connection->query($query);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $esp[] = $row;
        }
        
        $especie =$esp[0]['especie'];
        $rebanho->setEspecie($especie);

        $retornoRS = $rebanho->cadastrarRebanho();
    }

    $lancamento2->setTipoLancamento($_POST['tipo-lancamento']);
    $lancamento2->setRebanho($_POST['nasc-rebanho']);
    $lancamento2->setTipoParto($_POST['tipo-parto']);
    $lancamento2->setSexo($_POST['sexo2']);
    $lancamento2->setPeso($_POST['peso2']);    
    $lancamento2->setIdCria($_POST['cria2']);
    $lancamento2->setDataNascimento($_POST['data-nascimento']);
    $lancamento2->setDataCadastro($data);
    $lancamento2->setIdUsuario($array->id);
    $lancamento2->setIdPropriedade($array->idPropriedade);

    $retorno = $lancamento2->adicionarNascimento();
}

// Parto Triplo
else if($tipoParto == 'triplo'){
    // Cria 2
    if($_POST['cria2'] != ''){
        $lancamento2->setMatriz($_POST['matriz']);
        $lancamento2->setReprodutor($_POST['reprodutor']);

        // Cadastrando animal 2 no rebanho detalhado
        $rebanhoDet->setIdentificacaoAnimal($_POST['cria2']);
        $rebanhoDet->setDataNascimento($_POST['data-nascimento']);
        $rebanhoDet->setNomeRebanho($_POST['nasc-rebanho']);    
        $rebanhoDet->setRaca($_POST['raca2']);    
        $rebanhoDet->setIdUsuario($array->id);
        $rebanhoDet->setIdPropriedade($array->idPropriedade);
        $rebanhoDet->setDataCadastro($data);

        $query = "select especie from rebanho_detalhado where raca = '$raca2' and id_propriedade = $array->idPropriedade";    
        $stmt = $connection->query($query);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $esp[] = $row;
        }
        
        $especie =$esp[0]['especie'];
        $rebanhoDet->setEspecie($especie);

        if($_POST['sexo2'] == 'macho'){
            $rebanhoDet->setCategoria('macho jovem');    
        }
        else{
            $rebanhoDet->setCategoria('fêmea jovem');    
        }

        $retornoRD = $rebanhoDet->cadastrarRebanho();
    }
    else{
        $lancamento2->setMatriz('-');
        $lancamento2->setReprodutor('-');
        
        // Cadastrando animal 2 no rebanho simplificado
        $rebanho->setNomeRebanho($_POST['nasc-rebanho']);    
        $rebanho->setRaca($raca2);
        $rebanho->setQtd(1);
        $rebanho->setIdUsuario($array->id);
        $rebanho->setIdPropriedade($array->idPropriedade);
        $rebanho->setDataCadastro($data);

        if($_POST['sexo2'] == 'macho'){
            $rebanho->setCategoria('macho jovem');    
        }
        else{
            $rebanho->setCategoria('fêmea jovem');    
        }

        $query = "select especie from rebanho_simples where raca = '$raca2' and id_propriedade = $array->idPropriedade";    
        $stmt = $connection->query($query);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $esp[] = $row;
        }
        
        $especie =$esp[0]['especie'];
        $rebanho->setEspecie($especie);

        $retornoRS = $rebanho->cadastrarRebanho();
    }
    $lancamento2->setTipoLancamento($_POST['tipo-lancamento']);
    $lancamento2->setRebanho($_POST['nasc-rebanho']);
    $lancamento2->setTipoParto($_POST['tipo-parto']);
    $lancamento2->setSexo($_POST['sexo2']);
    $lancamento2->setPeso($_POST['peso2']);    
    $lancamento2->setIdCria($_POST['cria2']);
    $lancamento2->setDataNascimento($_POST['data-nascimento']);
    $lancamento2->setDataCadastro($data);
    $lancamento2->setIdUsuario($array->id);
    $lancamento2->setIdPropriedade($array->idPropriedade);

    $retorno = $lancamento2->adicionarNascimento();

    // Cria 3
    if($_POST['cria3'] != ''){
        $lancamento3->setMatriz($_POST['matriz']);
        $lancamento3->setReprodutor($_POST['reprodutor']);

        // Cadastrando animal 3 no rebanho detalhado
        $rebanhoDet->setIdentificacaoAnimal($_POST['cria3']);
        $rebanhoDet->setDataNascimento($_POST['data-nascimento']);
        $rebanhoDet->setNomeRebanho($_POST['nasc-rebanho']);    
        $rebanhoDet->setRaca($_POST['raca3']);    
        $rebanhoDet->setIdUsuario($array->id);
        $rebanhoDet->setIdPropriedade($array->idPropriedade);
        $rebanhoDet->setDataCadastro($data);

        $query = "select especie from rebanho_detalhado where raca = '$raca3' and id_propriedade = $array->idPropriedade";    
        $stmt = $connection->query($query);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $esp[] = $row;
        }
        
        $especie =$esp[0]['especie'];
        $rebanhoDet->setEspecie($especie);

        if($_POST['sexo3'] == 'macho'){
            $rebanhoDet->setCategoria('macho jovem');    
        }
        else{
            $rebanhoDet->setCategoria('fêmea jovem');    
        }

        $retornoRD = $rebanhoDet->cadastrarRebanho();
    }
    else{
        $lancamento3->setMatriz('-');
        $lancamento3->setReprodutor('-');
        
        // Cadastrando animal 3 no rebanho simplificado
        $rebanho->setNomeRebanho($_POST['nasc-rebanho']);    
        $rebanho->setRaca($raca3);
        $rebanho->setQtd(1);
        $rebanho->setIdUsuario($array->id);
        $rebanho->setIdPropriedade($array->idPropriedade);
        $rebanho->setDataCadastro($data);

        if($_POST['sexo3'] == 'macho'){
            $rebanho->setCategoria('macho jovem');    
        }
        else{
            $rebanho->setCategoria('fêmea jovem');    
        }

        $query = "select especie from rebanho_simples where raca = '$raca3' and id_propriedade = $array->idPropriedade";    
        $stmt = $connection->query($query);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $esp[] = $row;
        }
        
        $especie =$esp[0]['especie'];
        $rebanho->setEspecie($especie);

        $retornoRS = $rebanho->cadastrarRebanho();
    }
    $lancamento3->setTipoLancamento($_POST['tipo-lancamento']);
    $lancamento3->setRebanho($_POST['nasc-rebanho']);
    $lancamento3->setTipoParto($_POST['tipo-parto']);
    $lancamento3->setSexo($_POST['sexo3']);
    $lancamento3->setPeso($_POST['peso3']);    
    $lancamento3->setIdCria($_POST['cria3']);
    $lancamento3->setDataNascimento($_POST['data-nascimento']);
    $lancamento3->setDataCadastro($data);
    $lancamento3->setIdUsuario($array->id);
    $lancamento3->setIdPropriedade($array->idPropriedade);
    
    $retorno = $lancamento3->adicionarNascimento();
}

// Parto Quadruplo
else if($tipoParto == 'quadruplo'){
    if($_POST['cria2'] != ''){
        $lancamento2->setMatriz($_POST['matriz']);
        $lancamento2->setReprodutor($_POST['reprodutor']);

        // Cadastrando animal 2 no rebanho detalhado
        $rebanhoDet->setIdentificacaoAnimal($_POST['cria2']);
        $rebanhoDet->setDataNascimento($_POST['data-nascimento']);
        $rebanhoDet->setNomeRebanho($_POST['nasc-rebanho']);    
        $rebanhoDet->setRaca($_POST['raca2']);    
        $rebanhoDet->setIdUsuario($array->id);
        $rebanhoDet->setIdPropriedade($array->idPropriedade);
        $rebanhoDet->setDataCadastro($data);

        $query = "select especie from rebanho_detalhado where raca = '$raca2' and id_propriedade = $array->idPropriedade";    
        $stmt = $connection->query($query);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $esp[] = $row;
        }
        
        $especie =$esp[0]['especie'];
        $rebanhoDet->setEspecie($especie);

        if($_POST['sexo2'] == 'macho'){
            $rebanhoDet->setCategoria('macho jovem');    
        }
        else{
            $rebanhoDet->setCategoria('fêmea jovem');    
        }

        $retornoRD = $rebanhoDet->cadastrarRebanho();
    }
    else{
        $lancamento2->setMatriz('-');
        $lancamento2->setReprodutor('-');

        // Cadastrando animal 2 no rebanho simplificado
        $rebanho->setNomeRebanho($_POST['nasc-rebanho']);    
        $rebanho->setRaca($raca2);
        $rebanho->setQtd(1);
        $rebanho->setIdUsuario($array->id);
        $rebanho->setIdPropriedade($array->idPropriedade);
        $rebanho->setDataCadastro($data);

        if($_POST['sexo2'] == 'macho'){
            $rebanho->setCategoria('macho jovem');    
        }
        else{
            $rebanho->setCategoria('fêmea jovem');    
        }

        $query = "select especie from rebanho_simples where raca = '$raca2' and id_propriedade = $array->idPropriedade";    
        $stmt = $connection->query($query);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $esp[] = $row;
        }
        
        $especie =$esp[0]['especie'];
        $rebanho->setEspecie($especie);

        $retornoRS = $rebanho->cadastrarRebanho();    
    }
    $lancamento2->setTipoLancamento($_POST['tipo-lancamento']);
    $lancamento2->setRebanho($_POST['nasc-rebanho']);
    $lancamento2->setTipoParto($_POST['tipo-parto']);
    $lancamento2->setSexo($_POST['sexo2']);
    $lancamento2->setPeso($_POST['peso2']);    
    $lancamento2->setIdCria($_POST['cria2']);
    $lancamento2->setDataNascimento($_POST['data-nascimento']);
    $lancamento2->setDataCadastro($data);
    $lancamento2->setIdUsuario($array->id);
    $lancamento2->setIdPropriedade($array->idPropriedade);

    $retorno = $lancamento2->adicionarNascimento();

    // Cria 3
    if($_POST['cria3'] != ''){
        $lancamento3->setMatriz($_POST['matriz']);
        $lancamento3->setReprodutor($_POST['reprodutor']);

        // Cadastrando animal 3 no rebanho detalhado
        $rebanhoDet->setIdentificacaoAnimal($_POST['cria3']);
        $rebanhoDet->setDataNascimento($_POST['data-nascimento']);
        $rebanhoDet->setNomeRebanho($_POST['nasc-rebanho']);    
        $rebanhoDet->setRaca($_POST['raca3']);    
        $rebanhoDet->setIdUsuario($array->id);
        $rebanhoDet->setIdPropriedade($array->idPropriedade);
        $rebanhoDet->setDataCadastro($data);

        $query = "select especie from rebanho_detalhado where raca = '$raca3' and id_propriedade = $array->idPropriedade";    
        $stmt = $connection->query($query);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $esp[] = $row;
        }
        
        $especie =$esp[0]['especie'];
        $rebanhoDet->setEspecie($especie);

        if($_POST['sexo3'] == 'macho'){
            $rebanhoDet->setCategoria('macho jovem');    
        }
        else{
            $rebanhoDet->setCategoria('fêmea jovem');    
        }

        $retornoRD = $rebanhoDet->cadastrarRebanho();
    }
    else{
        $lancamento3->setMatriz('-');
        $lancamento3->setReprodutor('-');
        
        // Cadastrando animal 3 no rebanho simplificado
        $rebanho->setNomeRebanho($_POST['nasc-rebanho']);    
        $rebanho->setRaca($raca3);
        $rebanho->setQtd(1);
        $rebanho->setIdUsuario($array->id);
        $rebanho->setIdPropriedade($array->idPropriedade);
        $rebanho->setDataCadastro($data);

        if($_POST['sexo3'] == 'macho'){
            $rebanho->setCategoria('macho jovem');    
        }
        else{
            $rebanho->setCategoria('fêmea jovem');    
        }

        $query = "select especie from rebanho_simples where raca = '$raca3' and id_propriedade = $array->idPropriedade";    
        $stmt = $connection->query($query);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $esp[] = $row;
        }
        
        $especie =$esp[0]['especie'];
        $rebanho->setEspecie($especie);

        $retornoRS = $rebanho->cadastrarRebanho();
    }
    $lancamento3->setTipoLancamento($_POST['tipo-lancamento']);
    $lancamento3->setRebanho($_POST['nasc-rebanho']);
    $lancamento3->setTipoParto($_POST['tipo-parto']);
    $lancamento3->setSexo($_POST['sexo3']);
    $lancamento3->setPeso($_POST['peso3']);    
    $lancamento3->setIdCria($_POST['cria3']);
    $lancamento3->setDataNascimento($_POST['data-nascimento']);
    $lancamento3->setDataCadastro($data);
    $lancamento3->setIdUsuario($array->id);
    $lancamento3->setIdPropriedade($array->idPropriedade);
    
    $retorno = $lancamento3->adicionarNascimento();
    
    // Cria 4
    if($_POST['cria4'] != ''){
        $lancamento4->setMatriz($_POST['matriz']);
        $lancamento4->setReprodutor($_POST['reprodutor']);

        // Cadastrando animal 4 no rebanho detalhado
        $rebanhoDet->setIdentificacaoAnimal($_POST['cria4']);
        $rebanhoDet->setDataNascimento($_POST['data-nascimento']);
        $rebanhoDet->setNomeRebanho($_POST['nasc-rebanho']);    
        $rebanhoDet->setRaca($_POST['raca4']);    
        $rebanhoDet->setIdUsuario($array->id);
        $rebanhoDet->setIdPropriedade($array->idPropriedade);
        $rebanhoDet->setDataCadastro($data);

        $query = "select especie from rebanho_detalhado where raca = '$raca4' and id_propriedade = $array->idPropriedade";    
        $stmt = $connection->query($query);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $esp[] = $row;
        }
        
        $especie =$esp[0]['especie'];
        $rebanhoDet->setEspecie($especie);

        if($_POST['sexo4'] == 'macho'){
            $rebanhoDet->setCategoria('macho jovem');    
        }
        else{
            $rebanhoDet->setCategoria('fêmea jovem');    
        }

        $retornoRD = $rebanhoDet->cadastrarRebanho();
    }
    else{
        $lancamento4->setMatriz('-');
        $lancamento4->setReprodutor('-');
        
        // Cadastrando animal 4 no rebanho simplificado
        $rebanho->setNomeRebanho($_POST['nasc-rebanho']);    
        $rebanho->setRaca($raca4);
        $rebanho->setQtd(1);
        $rebanho->setIdUsuario($array->id);
        $rebanho->setIdPropriedade($array->idPropriedade);
        $rebanho->setDataCadastro($data);

        if($_POST['sexo4'] == 'macho'){
            $rebanho->setCategoria('macho jovem');    
        }
        else{
            $rebanho->setCategoria('fêmea jovem');    
        }

        $query = "select especie from rebanho_simples where raca = '$raca4' and id_propriedade = $array->idPropriedade";    
        $stmt = $connection->query($query);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $esp[] = $row;
        }
        
        $especie =$esp[0]['especie'];
        $rebanho->setEspecie($especie);

        $retornoRS = $rebanho->cadastrarRebanho();
    }
    $lancamento4->setTipoLancamento($_POST['tipo-lancamento']);
    $lancamento4->setRebanho($_POST['nasc-rebanho']);
    $lancamento4->setTipoParto($_POST['tipo-parto']);
    $lancamento4->setSexo($_POST['sexo4']);
    $lancamento4->setPeso($_POST['peso4']);
    $lancamento4->setMatriz($_POST['matriz']);
    $lancamento4->setReprodutor($_POST['reprodutor']);
    $lancamento4->setIdCria($_POST['cria4']);
    $lancamento4->setDataNascimento($_POST['data-nascimento']);
    $lancamento4->setDataCadastro($data);
    $lancamento4->setIdUsuario($array->id);
    $lancamento4->setIdPropriedade($array->idPropriedade); 

    $retorno = $lancamento4->adicionarNascimento();
}



// $retorno = array('status' => 'Success', 'value' => 'teste');
// $retorno = array('status' => 'Success', 'value' => $rebanho->getEspecie());
echo json_encode($retorno);


// OBSERVAÇÃO: Caso a raça informada não exista no rebanho ocorrerá um erro, mas o usuário
// não será notificado, temos que bolar uma forma de tratar isso.