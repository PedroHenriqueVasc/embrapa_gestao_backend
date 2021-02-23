<?php
    require_once('../config.php');
    
    class Connection{
        public static function getConnection(){
            $connection = new PDO(DB_DRIVE.':host='.DB_HOSTNAME.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //configuração do erro do banco para php

            return $connection;
        }
    }		
?>