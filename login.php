<?php
    session_start();
    //require_once('api/classes/Connection.php');
    require_once('global.php');

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
    //echo $user_id;
    // header('Location: api/propriedade/mostrar');

    if(!(empty($user))){
        // header('Location: http://localhost:3000/selecionar-propriedade.html');
        // header("Location: api/propriedade/mostrar/$user_id");
        header("Location: http://localhost:3000/selecionar-propriedade.html?id=$user_id");
    }else{
        header('Location: http://localhost:3000/index.html');
        exit();
    }