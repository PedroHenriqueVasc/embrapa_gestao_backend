<?php
    require_once('classes/User.php');

    $user = new User();

    $d=date("Y-m-d");

    $user->setName($_POST['name']);
    $user->setPassword($_POST['password']);
    $user->setUsername($_POST['username']);
    $user->setEmail($_POST['email']);
    $user->setCity($_POST['city']);
    $user->setState($_POST['state']);
    $user->setCep($_POST['cep']);
    $user->setDataCadastro($d);
    
    $user->addUser();

    header('Location: http://localhost:3000/index.html');
    

    
?>