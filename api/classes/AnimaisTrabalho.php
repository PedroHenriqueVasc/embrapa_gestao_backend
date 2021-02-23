<?php

require_once('../global.php');

class AnimaisTrabalho{
    private $nome;
    private $caracteristica;
    private $qtd;
    private $valor;
    private $vidaUtil;
    private $tempoUso;
    private $usoCaprinos;
    private $usoOvinos;
    private $idPropriedade;
    private $id;
    private $dataCadastro;

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getCaracteristica(){
        return $this->caracteristica;
    }

    public function setCaracteristica($carac){
        $this->caracteristica = $carac;
    }

    public function getQtd(){
        return $this->qtd;
    }

    public function setQtd($qtd){
        $this->qtd = $qtd;
    }

    public function getValor(){
        return $this->valor;
    }

    public function setValor($valor){
        $this->valor = $valor;
    }

    public function getVidaUtil(){
        return $this->vidaUtil;
    }

    public function setVidaUtil($vida){
        $this->vidaUtil = $vida;
    }

    public function setTipoTempoVida($tipo){
        $this->tipoTempoVida = $tipo;
    }

    public function getTipoTempoVida($tipo){
        return $this->tipoTempoVida;
    }

    public function setTempoUso($tempo){
        $this->tempoUso = $tempo;
    }

    public function getTempoUso(){
        return $this->tempoUso;
    }

    public function setTipoTempo($tipo){
        $this->tipoTempoUso = $tipo;
    }

    public function getTipoTempo($tipo){
        return $this->tipoTempoUso;
    }

    public function setUsoCaprinos($uso){
        $this->usoCaprinos = $uso;
    }

    public function getUsoCaprinos(){
        return $this->usoCaprinos;
    }

    public function setUsoOvinos($uso){
        $this->usoOvinos = $uso;
    }

    public function getUsoOvinos(){
        return $this->usoOvinos;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
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

    public function adicionarAnimaisTrabalho(){
        $connection = Connection::getConnection();            

        $query = "INSERT INTO animais_trabalho (nome_animal, caracteristicas, qtd, valor, vida_util, tempo_uso, uso_caprinos, uso_ovinos, id_propriedade, id_usuario, data_cadastro) 
        VALUES (:nome_animal, :caracteristicas, :qtd, :valor, :vida_util, :tempo_uso, :uso_caprinos, :uso_ovinos, :id_propriedade, :id_usuario, :data_cadastro)";

        try{

            $stmt = $connection->prepare($query);
            
            $stmt->bindValue(':nome_animal', $this->nome);
            $stmt->bindValue(':caracteristicas', $this->caracteristica);
            $stmt->bindValue(':qtd', $this->qtd);
            $stmt->bindValue(':valor', $this->valor);
            $stmt->bindValue(':vida_util', $this->vidaUtil);
            $stmt->bindValue(':tempo_uso', $this->tempoUso);
            $stmt->bindValue(':uso_caprinos', $this->usoCaprinos);
            $stmt->bindValue(':uso_ovinos', $this->usoOvinos);
            $stmt->bindValue(':id_propriedade', $this->idPropriedade);
            $stmt->bindValue(':id_usuario', $this->id);
            $stmt->bindValue(':data_cadastro', $this->dataCadastro);
            
            
            $result = $stmt->execute();
            return array('status' => 'Success', 'value' => 'Animais de Trabalho cadastrados com sucesso!');
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

        $query = "SELECT nome_animal, caracteristicas, qtd, valor, vida_util, tempo_uso, uso_caprinos, uso_ovinos  FROM animais_trabalho WHERE id_usuario = $info->id";

        $sql = $connection->prepare($query);

        $sql->execute();

        $resultados = array();

        while($row = $sql->fetch(PDO::FETCH_ASSOC)){
            $resultados[] = $row;
        }

        if(!$resultados){
            throw new Exception("Nenhum equipamento encontrado!");
        }

        return $resultados;
    }
}