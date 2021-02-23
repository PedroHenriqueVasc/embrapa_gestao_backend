<?php
    // session_start();
    require_once('../global.php');

    class Propriedade{
        private $nome;
        private $estado;
        private $municipio;
        private $coordenadas;
        private $registro;
        private $areaTotal;
        private $unidadeMedida;
        private $valorHectare;
        private $areaPastagem;
        private $areaBenfeitoria;
        private $areaReserva;
        private $saldo;
        private $dataCadastro;

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getEstado(){
            return $this->estado;
        }

        public function setEstado($est){
            $this->estado = $est;
        }
        
        public function getMunicipio(){
            return $this->municipio;
        }

        public function setMunicipio($munic){
            $this->municipio = $munic;
        }
        public function getCoordenadas(){
            return $this->coordenadas;
        }

        public function setCoordenadas($coord){
            $this->coordenadas = $coord;
        }

        public function getRegistro(){
            return $this->registro;
        }

        public function setRegistro($regist){
            $this->registro = $regist;
        }

        
        public function setAreaTotal($area){
            $this->areaTotal = $area;
        }

        public function getAreaTotal(){
            return $this->areaTotal;
        }

        public function setUnidadeMedida($unidade){
            $this->unidadeMedida = $unidade;
        }

        public function getUnidadeMedida(){
            return $this->unidadeMedida;
        }

        public function setValorHectare($valor){
            $this->valorHectare = $valor;
        }
        
        public function getValorHectare(){
            return $this->valorHectare;
        }

        public function getAreaPastagem(){
            return $this->areaPastagem;
        }

        public function setAreaPastagem($area){
            $this->areaPastagem = $area;
        }

        public function getAreaBenfeitoria(){
            return $this->areaBenfeitoria;
        }

        public function setAreaBenfeitoria($area){
            $this->areaBenfeitoria = $area;
        }

        public function getAreaReserva(){
            return $this->areaReserva;
        }

        public function setAreaReserva($area){
            $this->areaReserva = $area;
        }

        public function getSaldo(){
            return $this->saldo;
        }

        public function setSaldo($saldo){
            $this->saldo = $saldo;
        }

        public function getDataCadastro(){
            return $this->dataCadastro;
        }

        public function setDataCadastro($data){
            $this->dataCadastro = $data;
        }


        public function mostrar($id){
            $connection = Connection::getConnection();

            $query = "SELECT nome, estado, municipio FROM propriedade WHERE id_usuario = $id";

            $sql = $connection->prepare($query);

            $sql->execute();

            $resultados = array();

            while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                $resultados[] = $row;
            }

            if(!$resultados){
                throw new Exception("Nenhuma propriedade encontrada! Clique em 'Nova Propriedade' para adicionar.");
            }

            return $resultados;
        }

        public function cadastrar($id){
            $connection = Connection::getConnection();            

            $query = "INSERT INTO propriedade (nome, municipio, estado, coordenadas, inscricao, area_total, valor_hectare, area_pastagem, area_benfeitoria, area_reserva, saldo, id_usuario, unidade_medida, data_cadastro) 
            VALUES (:nome, :municipio, :estado, :coordenadas, :inscricao, :area_total, :valor_hectare, :area_pastagem, :area_benfeitoria, :area_reserva, :saldo, :id_usuario, :unidade_medida, :data_cadastro)";

            $stmt = $connection->prepare($query);

            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':municipio', $this->municipio);
            $stmt->bindValue(':estado', $this->estado);
            $stmt->bindValue(':coordenadas', $this->coordenadas);
            $stmt->bindValue(':inscricao', $this->registro);
            $stmt->bindValue(':area_total', $this->areaTotal);
            $stmt->bindValue(':valor_hectare', $this->valorHectare);
            $stmt->bindValue(':area_pastagem', $this->areaPastagem);
            $stmt->bindValue(':area_benfeitoria', $this->areaBenfeitoria);
            $stmt->bindValue(':area_reserva', $this->areaReserva);
            $stmt->bindValue(':saldo', $this->saldo);
            $stmt->bindValue(':id_usuario', $id);
            $stmt->bindValue(':unidade_medida', $this->unidadeMedida);
            $stmt->bindValue(':data_cadastro', $this->dataCadastro);

            try{
                $result = $stmt->execute();
                
                $query2 = "SELECT id_propriedade FROM propriedade WHERE id_usuario = $id AND inscricao = $this->registro";

                $sql = $connection->prepare($query2);

                $sql->execute();

                $resultados = array();

                while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                    $resultados[] = $row;
                }

                return $resultados;

            }catch(PDOException $e){
                return $e;
            }
        }

        public function finalizar(){
            $connection = Connection::getConnection();

            $arquivo = fopen('ids.txt', 'r');

            $conteudo = fread($arquivo, filesize('ids.txt'));

            $info = json_decode($conteudo);

            fclose($arquivo);

            $query = "SELECT nome, municipio, estado, coordenadas, inscricao, area_total, valor_hectare, area_pastagem, area_benfeitoria, area_reserva, saldo, unidade_medida  FROM propriedade WHERE id_usuario = $info->id";

            $sql = $connection->prepare($query);

            $sql->execute();

            $resultados = array();

            while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                $resultados[] = $row;
            }

            if(!$resultados){
                throw new Exception("Nenhuma propriedade encontrada!");
            }

            return $resultados;
        }
    }