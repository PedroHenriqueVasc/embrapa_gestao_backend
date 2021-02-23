<?php
    //constantes de debug
    define('DEBUG', false);
    
    //constantes de configuração do banco
	//$conexao = new PDO(DB_DRIVE.':host='.DB_HOSTNAME.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));//esse array é para reconhecer caracteres especiais
    define('DB_DRIVE', "pgsql");
    define('DB_HOSTNAME', "localhost");
    define('DB_NAME',"getovi");
    define('DB_USERNAME',"postgres");
    define('DB_PASSWORD','123456');