<?php
    // $url = $_SERVER["REQUEST_URI"];

    // $id = substr($url,-1);
    $id = $_SESSION['id'];

    echo json_encode(array('valor' => 'Qualquer coisa', 'id' => $id));