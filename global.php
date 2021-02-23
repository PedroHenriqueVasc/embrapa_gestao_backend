<?php
    spl_autoload_register('chargeClass');//Registra função como autoload

    function chargeClass($className){
        if(file_exists('classes/'.$className.'.php')){
            require_once('classes/'.$className.'.php');
        }
    }