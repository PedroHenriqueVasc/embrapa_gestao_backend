<?php

require_once('../global.php');

class Rebanho{
    private $idRebanho;
    private $nomeRebanho;
    private $especie;
    private $raca;
    private $categoria;
    private $qtd;
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

    public function setQtd($qtd){
        $this->qtd = $qtd;
    }

    public function getQtd(){
        return $this->qtd;
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
            $query = "INSERT INTO rebanho_simples (nome_rebanho_simples, especie, raca, categoria, qtd, id_propriedade, id_usuario, data_cadastro) 
            VALUES (:nome_rebanho_simples, :especie, :raca, :categoria, :qtd, :id_propriedade, :id_usuario, :data_cadastro)";

            $stmt = $connection->prepare($query);

            $stmt->bindValue(':nome_rebanho_simples', $this->nomeRebanho);
            $stmt->bindValue(':especie', $this->especie);
            $stmt->bindValue(':raca', $this->raca);
            $stmt->bindValue(':categoria', $this->categoria);
            $stmt->bindValue(':qtd', $this->qtd);
            $stmt->bindValue(':id_propriedade', $this->idPropriedade);
            $stmt->bindValue(':id_usuario', $this->idUsuario);
            $stmt->bindValue(':data_cadastro', $this->dataCadastro);
            
            $result = $stmt->execute();
            return array('status' => 'Success', 'value' => 'Rebanho cadastrado com sucesso!');
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

        $query = "SELECT nome_rebanho_simples, especie, raca, categoria, qtd FROM rebanho_simples WHERE id_usuario = $info->id";

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