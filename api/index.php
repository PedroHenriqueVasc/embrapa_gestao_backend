<?php
    header('Access-Control-Allow-Origin: http://localhost:3000');    
    header('Content-Type: application/json; charset=utf-8');
    //readfile('arunerDotNetResource.xml');

    require_once 'classes/User.php';

    class Rest{
        public static function open($requisicao){
            $url = explode('/', $requisicao['url']);
        
            $classe = ucfirst($url[0]);
            array_shift($url);

            $metodo = $url[0];
            array_shift($url);

            $parametros = array();
            $parametros = $url;
            
            if($_POST){
                $parametros = $_POST;
            }

            try{
                if(class_exists($classe)){
            
                    if(method_exists($classe, $metodo)){
                        $retorno = call_user_func_array(array(new $classe, $metodo), $parametros);
    
                        return json_encode(array('status' => 'Sucesso', 'dados' => $retorno));
                    }
                    else{
                        return json_encode(array('status' => 'Erro', 'dados' => 'Método inexistente!'));
                    }
                }else{
                    return json_encode(array('status' => 'Erro', 'dados' => 'Classe inexistente!'));
                }
            }catch(Exception $err){
                return json_encode(array('status' => 'Erro', 'dados' => $err->getMessage()));
            }
        }

    }

    if(isset($_REQUEST)){
        echo Rest::open($_REQUEST);
    }