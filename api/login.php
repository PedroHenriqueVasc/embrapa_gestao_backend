<?php
    //session_start();
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
    $num = 1;
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