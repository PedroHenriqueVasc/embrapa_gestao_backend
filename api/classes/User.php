<?php
    require_once('../global.php');    

    class User{
        private $user_id;
        private $name;
        private $username;
        private $password;
        private $email;
        private $city;
        private $state;
        private $cep;
        private $dataCadastro;

        public function getUser_id(){
            return $this->user_id;
        }

        public function setUser_id($id){
            $this->user_id = $id;
        }

        public function getName(){
            return $this->name;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function getUsername(){
            return $this->username;
        }

        public function setUsername($username){
            $this->username = $username;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getCity(){
            return $this->city;
        }

        public function setCity($city){
            $this->city = $city;
        }

        public function getState(){
            return $this->state;
        }

        public function setState($state){
            $this->state = $state;
        }

        public function getCep(){
            return $this->cep;
        }

        public function setCep($cep){
            $this->cep = $cep;
        }

        public function getDataCadastro(){
            return $this->dataCadastro;
        }

        public function setDataCadastro($data){
            $this->dataCadastro = $data;
        }

        public function addUser(){
            $query = "INSERT INTO usuario(nome, username, senha, cidade, estado, cep, email, data_cadastro) VALUES
            (:nome, :username, :senha, :cidade, :estado, :cep, :email, :data_cadastro)";

            $connection = Connection::getConnection();
            $stmt = $connection->prepare($query);

            // pass values to the statement
            $stmt->bindValue(':nome', $this->name);
            $stmt->bindValue(':username', $this->username);
            $stmt->bindValue(':senha', $this->password);
            $stmt->bindValue(':cidade', $this->city);
            $stmt->bindValue(':estado', $this->state);
            $stmt->bindValue(':cep', $this->cep);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':data_cadastro', $this->dataCadastro);
            
            // execute the insert statement
            $stmt->execute();
        }

        public function login($dados){

            // if(empty($dados['email']) || empty($dados['password'])){
            //     header('Location: http://localhost:3000/index.html');
            //     exit();
            // }

            $email = $dados['email'];
            $password = $dados['password'];

            $query = "SELECT id_usuario, nome FROM usuario WHERE email = '$email' AND senha = '$password'";

            $connection = Connection::getConnection();
            $stmt = $connection->query($query);

            $user = $stmt->fetchAll();

            $user_id = $user[0]['id_usuario'];
            

            if(!(empty($user))){
                header("Location: http://localhost:3000/selecionar-propriedade.html");
            }else{
                //header('Location: http://localhost:3000/index.html');
                return 'Usuário não encontrado!';
                exit();
            }
        }
    }