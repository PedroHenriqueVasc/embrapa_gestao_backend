<?php

require_once('../global.php');

class RebanhoDetalhado{
    private $idRebanho;
    private $nomeRebanho;
    private $identificacaoAnimal;
    private $dataNascimento;
    private $especie;
    private $raca;
    private $categoria;
    private $idPropriedade;
    private $idUsuario;
    private $dataCadastro;

    public function setIdRebanho($id){
        $this->idRebanho = $id;
    }

    public function getIdRebanho(){
        return $this->idRebanho;
    }

    public function setNomeRebanho($nome){
        $this->nomeRebanho = $nome;
    }

    public function getNomeRebanho(){
        return $this->nomeRebanho;
    }

    public function setIdentificacaoAnimal($id){
        $this->identificacaoAnimal = $id;
    }

    public function getIdentificacaoAnimal(){
        return $this->identificacaoAnimal;
    }

    public function setDataNascimento($date){
        $this->dataNascimento = $date;
    }

    public function getDataNascimento(){
        return $this->dataNascimento;
    }

    public function setEspecie($esp){
        $this->especie = $esp;
    }

    public function getEspecie($esp){
        return $this->esp;
    }

    public function setRaca($raca){
        $this->raca = $raca;
    }

    public function getRaca(){
        return $this->raca;
    }

    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setIdUsuario($id){
        $this->idUsuario = $id;
    }

    public function getIdPropriedade(){
        return $this->idPropriedade;
    }

    public function setIdPropriedade($id){
        $this->idPropriedade = $id;
    }

    public function getDataCadastro(){
        return $this->dataCadastro;
    }

    public function setDataCadastro($data){
        $this->dataCadastro = $data;
    }

    public function cadastrarRebanho(){
        $connection = Connection::getConnection();            


        try{
            $query = "INSERT INTO rebanho_detalhado (nome_rebanho_detalhado, identificacao_animal, data_nascimento, especie, raca, categoria, data_cadastro, id_propriedade, id_usuario) 
            VALUES (:nome_rebanho_detalhado, :identificacao_animal, :data_nascimento, :especie, :raca, :categoria, :data_cadastro, :id_propriedade, :id_usuario)";

            $stmt = $connection->prepare($query);

            $stmt->bindValue(':nome_rebanho_detalhado', $this->nomeRebanho);
            $stmt->bindValue(':identificacao_animal', $this->identificacaoAnimal);
            $stmt->bindValue(':data_nascimento', $this->dataNascimento);
            $stmt->bindValue(':especie', $this->especie);
            $stmt->bindValue(':raca', $this->raca);
            $stmt->bindValue(':categoria', $this->categoria);
            $stmt->bindValue(':data_cadastro', $this->dataCadastro);
            $stmt->bindValue(':id_propriedade', $this->idPropriedade);
            $stmt->bindValue(':id_usuario', $this->idUsuario);
            
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

        $query = "SELECT nome_rebanho_detalhado, identificacao_animal, data_nascimento, especie, raca, categoria FROM rebanho_detalhado WHERE id_usuario = $info->id";

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