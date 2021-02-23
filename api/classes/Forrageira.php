<?php

require_once('../global.php');

class Forrageira{
    private $cultura;
    private $area;
    private $ciclo;
    private $uso;
    private $idUsuario;
    private $idPropriedade;
    private $dataCadastro;
    private $fimCiclo;
    private $vidaUtil;

    public function setCultura($cultura){
        $this->cultura = $cultura;
    }

    public function getCultura(){
        return $this->cultura;
    }

    public function setArea($area){
        $this->area = $area;
    }

    public function getArea(){
        return $this->area;
    }

    public function setCiclo($ciclo){
        $this->ciclo = $ciclo;
    }

    public function getCiclo(){
        return $this->ciclo;
    }

    public function setUso($uso){
        $this->uso = $uso;
    }

    public function getUso(){
        return $this->uso;
    }

    public function setIdUsuario($id){
        $this->idUsuario = $id;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setIdPropriedade($id){
        $this->idPropriedade = $id;
    }

    public function getIdPropriedade(){
        return $this->idPropriedade;
    }

    public function getDataCadastro(){
        return $this->dataCadastro;
    }

    public function setDataCadastro($data){
        $this->dataCadastro = $data;
    }

    public function getFimCiclo(){
        return $this->fimCiclo;
    }

    public function setFimCiclo($data){
        $this->fimCiclo = $data;
    }

    public function getVidaUtil(){
        return $this->vidaUtil;
    }

    public function setVidaUtil($tempo){
        $this->vidaUtil = $tempo;
    }

    public function addForrageira(){
        $connection = Connection::getConnection();            

        $query = "INSERT INTO forrageira (cultura, area, ciclo, uso, id_propriedade, id_usuario, data_cadastro, fim_ciclo, vida_util) 
        VALUES (:cultura, :area, :ciclo, :uso, :id_propriedade, :id_usuario, :data_cadastro, :fim_ciclo, :vida_util)";

        try{

            $stmt = $connection->prepare($query);
            
            $stmt->bindValue(':cultura', $this->cultura);
            $stmt->bindValue(':area', $this->area);
            $stmt->bindValue(':ciclo', $this->ciclo);
            $stmt->bindValue(':uso', $this->uso);
            $stmt->bindValue(':id_propriedade', $this->idPropriedade);
            $stmt->bindValue(':id_usuario', $this->idUsuario);
            $stmt->bindValue(':data_cadastro', $this->dataCadastro);
            $stmt->bindValue(':fim_ciclo', $this->fimCiclo);
            $stmt->bindValue(':vida_util', $this->vidaUtil);
            
            $result = $stmt->execute();
            return array('status' => 'Success', 'value' => 'Cadastrado com sucesso');
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

        $query = "SELECT cultura, area, ciclo, uso, fim_ciclo, vida_util  FROM forrageira WHERE id_usuario = $info->id";

        $sql = $connection->prepare($query);

        $sql->execute();

        $resultados = array();

        while($row = $sql->fetch(PDO::FETCH_ASSOC)){
            $resultados[] = $row;
        }

        if(!$resultados){
            throw new Exception("Nenhuma cultura agrícola encontrada!");
        }

        return $resultados;
    }
}