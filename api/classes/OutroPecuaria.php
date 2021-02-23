<?php

require_once('../global.php');

class OutroPecuaria{
    private $nome;
    private $especie;
    private $qtd;
    private $idPropriedade;
    private $idUsuario;
    private $dataCadastro;
    
    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setEspecie($especie){
        $this->especie = $especie;
    }

    public function getEspecie(){
        return $especie;
    }

    public function setQtd($qtd){
        $this->qtd = $qtd;
    }

    public function getQtd(){
        return $this->qtd;
    }

    public function setIdPropriedade($id){
        $this->idPropriedade = $id;
    }

    public function getIdPropriedade(){
        return $this->idPropriedade;
    }

    public function setIdUsuario($id){
        $this->idUsuario = $id;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setDataCadastro($data){
        $this->dataCadastro = $data;
    }

    public function getDataCadastro(){
        return $this->dataCadastro;
    }

    public function cadastrarOutroPecuaria(){
        $connection = Connection::getConnection();            


        try{
            $query = "INSERT INTO outro_pecuaria (nome_animal, especie, qtd, id_propriedade, id_usuario, data_cadastro) 
            VALUES (:nome_animal, :especie, :qtd, :id_propriedade, :id_usuario, :data_cadastro)";

            $stmt = $connection->prepare($query);

            $stmt->bindValue(':nome_animal', $this->nome);
            $stmt->bindValue(':especie', $this->especie);
            $stmt->bindValue(':qtd', $this->qtd);
            $stmt->bindValue(':id_propriedade', $this->idPropriedade);
            $stmt->bindValue(':id_usuario', $this->idUsuario);
            $stmt->bindValue(':data_cadastro', $this->dataCadastro);
            
            $result = $stmt->execute();
            return array('status' => 'Success', 'value' => 'Animal cadastrado com sucesso!');
        }catch(PDOException $err){
            return array('status' => 'Erro', 'value' => $err);
        }
    }

    public function finalizar(){
        $connection = Connection::getConnection();

        $arquivo = fopen('ids.txt', 'r');

        $conteudo = fread($arquivo, filesize('ids.txt'));

        $info = json_decode($conteudo);

        fclose($arquivo);

        $query = "SELECT nome_animal, especie, qtd FROM outro_pecuaria WHERE id_usuario = $info->id";

        $sql = $connection->prepare($query);

        $sql->execute();

        $resultados = array();

        while($row = $sql->fetch(PDO::FETCH_ASSOC)){
            $resultados[] = $row;
        }

        if(!$resultados){
            throw new Exception("Nenhum rebanho encontrado!");
        }

        return $resultados;
    }
}