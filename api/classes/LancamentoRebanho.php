<?php
    // session_start();
    require_once('../global.php');

    class LancamentoRebanho{
        private $tipo_lancamento;
        private $rebanho;
        private $tipo_parto;
        private $sexo;
        private $peso;
        private $data_nascimento;
        private $id_animal;
        private $matriz;
        private $reprodutor;
        private $id_cria;
        private $areaReserva;
        private $tipo_evento;
        private $data_lancamento;
        private $categoria;
        private $qtd;
        private $valor;
        private $observacoes;
        private $categoria_origem;
        private $categoria_destino;
        private $tipo_manejo;
        private $vacinacao_vermifugacao;
        private $data_cadastro;
        private $id_propriedade;
        private $id_usuario;

        public function getTipoLancamento(){
            return $this->tipo_lancamento;
        }

        public function setTipoLancamento($lancamento){
            $this->tipo_lancamento = $lancamento;
        }

        public function getRebanho(){
            return $this->rebanho;
        }

        public function setRebanho($rebanho){
            $this->rebanho = $rebanho;
        }
        
        public function getTipoParto(){
            return $this->tipo_parto;
        }

        public function setTipoParto($tipo){
            $this->tipo_parto = $tipo;
        }
        public function getSexo(){
            return $this->sexo;
        }

        public function setSexo($sexo){
            $this->sexo = $sexo;
        }

        public function getPeso(){
            return $this->peso;
        }

        public function setPeso($peso){
            $this->peso = $peso;
        }

        
        public function setDataNascimento($nascimento){
            $this->data_nascimento = $nascimento;
        }

        public function getDataNascimento($nascimento){
            return $this->data_nascimento;
        }

        public function getMatriz(){
            return $this->matriz;
        }

        public function setMatriz($matriz){
            $this->matriz = $matriz;
        }

        public function getReprodutor(){
            return $this->reprodutor;
        }

        public function setReprodutor($reprodutor){
            $this->reprodutor = $reprodutor;
        }
        
        public function getIdCria(){
            return $this->id_cria;
        }

        public function setIdCria($id){
            $this->id_cria = $id;
        }

        public function getIdAnimal(){
            return $this->id_animal;
        }

        public function setIdAnimal($id){
            $this->id_animal = $id;
        }

        
        public function setIdPropriedade($propriedade){
            $this->id_propriedade = $propriedade;
        }

        public function getIdPropriedade(){
            return $this->id_propriedade;
        }
        
        public function setIdUsuario($usuario){
            $this->id_usuario = $usuario;
        }

        public function getIdUsuario(){
            return $this->id_usuario;
        }
        
        public function setDataCadastro($data){
            $this->data_cadastro = $data;
        }

        public function getDataCadastro(){
            return $this->data_cadastro;
        }                
        
        public function setDataRegistro($data){
            $this->data_lancamento = $data;
        }

        public function getDataRegistro(){
            return $this->data_lancamento;
        }                
        
        public function setTipoEvento($tipo){
            $this->tipo_evento = $tipo;
        }

        public function getTipoEvento(){
            return $this->tipo_evento;
        }        

        public function adicionarNascimento(){
            $connection = Connection::getConnection();            

            $query = "INSERT INTO lancamento_rebanho (tipo_lancamento, rebanho, tipo_parto, sexo, peso, data_nascimento, matriz, reprodutor, id_cria, data_cadastro, id_propriedade, id_usuario)  
            VALUES (:tipo_lancamento, :rebanho, :tipo_parto, :sexo, :peso, :data_nascimento, :matriz, :reprodutor, :id_cria, :data_cadastro, :id_propriedade, :id_usuario)";


            try{
                $stmt = $connection->prepare($query);
                
                $stmt->bindValue(':tipo_lancamento', $this->tipo_lancamento);
                $stmt->bindValue(':rebanho', $this->rebanho);
                $stmt->bindValue(':tipo_parto', $this->tipo_parto);
                $stmt->bindValue(':sexo', $this->sexo);
                $stmt->bindValue(':peso', $this->peso);
                $stmt->bindValue(':data_nascimento', $this->data_nascimento);
                $stmt->bindValue(':matriz', $this->matriz);
                $stmt->bindValue(':reprodutor', $this->reprodutor);
                $stmt->bindValue(':id_cria', $this->id_cria);
                $stmt->bindValue(':data_cadastro', $this->data_cadastro);            
                $stmt->bindValue(':id_propriedade', $this->id_propriedade);
                $stmt->bindValue(':id_usuario', $this->id_usuario);
                
                $result = $stmt->execute();
                return array('status' => 'Success', 'value' => 'Lançamento cadastrado com sucesso!');

            }catch(PDOException $e){
                return $e;
            }
        }     

        public function adicionarRegistro(){
            $connection = Connection::getConnection();            

            $query = "INSERT INTO lancamento_rebanho (tipo_lancamento, matriz, reprodutor, tipo_evento, data_registro, data_cadastro, id_propriedade, id_usuario)  
            VALUES (:tipo_lancamento, :matriz, :reprodutor, :tipo_evento, :data_registro, :data_cadastro, :id_propriedade, :id_usuario)";


            try{
                $stmt = $connection->prepare($query);
                
                $stmt->bindValue(':tipo_lancamento', $this->tipo_lancamento);
                $stmt->bindValue(':matriz', $this->matriz);
                $stmt->bindValue(':reprodutor', $this->reprodutor);
                $stmt->bindValue(':tipo_evento', $this->tipo_evento);
                $stmt->bindValue(':data_registro', $this->data_lancamento);            
                $stmt->bindValue(':data_cadastro', $this->data_cadastro);            
                $stmt->bindValue(':id_propriedade', $this->id_propriedade);
                $stmt->bindValue(':id_usuario', $this->id_usuario);
                
                $result = $stmt->execute();
                return array('status' => 'Success', 'value' => 'Lançamento cadastrado com sucesso!');

            }catch(PDOException $e){
                return $e;
            }
        }        
    }