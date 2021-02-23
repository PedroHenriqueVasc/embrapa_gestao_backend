<?php
    header('Access-Control-Allow-Origin: http://localhost:3000');    
    require_once('classes/Connection.php');

    if(empty($_POST['email']) || empty($_POST['password'])){
        header('Location: http://localhost:3000/index.html');
        exit();
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT id_usuario, nome FROM usuario WHERE email = '$email' AND senha = '$password'";

    $connection = Connection::getConnection();
    $stmt = $connection->query($query);

    $user = $stmt->fetchAll();

    $user_id = $user[0]['id_usuario'];

    // $_SESSION['id'] = $user_id;

    if(!(empty($user))){        
        // header("Location: http://localhost:3000/selecionar-propriedade.html?id=".$user_id);
        $res = array('status' => 'Success', 'value' => $user_id);
        echo json_encode($res);
    }else{
        $res = array('status' => 'Erro', 'value' => 'E-mail ou senha incorretos!');
        echo json_encode($res);
        
    }

    
    // if(!(empty($user))){        
    //     $query = "SELECT nome, estado, municipio FROM propriedade WHERE id_usuario = $user_id";

    //     $sql = $connection->prepare($query);

    //     $sql->execute();

    //     $resultados = array();

    //     while($row = $sql->fetch(PDO::FETCH_ASSOC)){
    //         $resultados[] = $row;
    //     }

    //     if(!$resultados){
    //         echo "Nenhuma propriedade encontrada! Clique em 'Nova Propriedade' para adicionar.";
    //     }

    //     echo $resultados;
    // }else{
    //     echo 'Usuário não encontrado!';        
    // }