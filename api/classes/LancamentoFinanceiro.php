<?php

require_once('../global.php');

class LancamentoFinanceiro{
    private $tipoLancamento;
    private $categoria;
    private $atividadeOvino;
    private $atividadeCaprino;
    private $atividadeBovinoLeite;
    private $atividadeBovinoCorte;
    private $atividadeBovinoMisto;    
    private $atividadeSuinocultura;
    private $atividadeAviculturaPost;
    private $atividadeAviculturaCorte;
    private $atividadeReceita;
    private $dataLancamento;
    private $produto;
    private $vidaUtil;
    private $qtd;
    private $qtdUnidade;
    private $valor;
    private $descricao;
    private $idPropriedade;
    private $id;
    private $dataCadastro;

    public function getTipoLancamento(){
        return $this->tipoLancamento;
    }

    public function setTipoLancamento($tipo){
        $this->tipoLancamento = $tipo;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }

    public function getAtividadeOvino(){
        return $this->atividadeOvino;
    }

    public function setAtividadeOvino($atividade){
        $this->atividadeOvino = $atividade;
    }

    public function getQtd(){
        return $this->qtd;
    }

    public function setQtd($qtd){
        $this->qtd = $qtd;
    }

    public function getQtdUnidade(){
        return $this->qtdUnidade;
    }

    public function setQtdUnidade($qtd){
        $this->qtdUnidade = $qtd;
    }

    public function getVidaUtil(){
        return $this->vidaUtil;
    }

    public function setVidaUtil($tempo){
        $this->vidaUtil = $tempo;
    }

    public function getValor(){
        return $this->valor;
    }

    public function setValor($valor){
        $this->valor = $valor;
    }

    public function getAtividadeCaprino(){
        return $this->atividadeCaprino;
    }

    public function setAtividadeCaprino($atividade){
        $this->atividadeCaprino = $atividade;
    }
    

    public function setAtividadeBovinoLeite($atv){
        $this->atividadeBovinoLeite = $atv;
    }

    public function getAtividadeBovinoLeite(){
        return $this->atividadeBovinoLeite;
    }

    public function setAtividadeBovinoCorte($atv){
        $this->atividadeBovinoCorte = $atv;
    }

    public function getAtividadeBovinoCorte(){
        return $this->atividadeBovinoCorte;
    }

    public function setAtividadeBovinoMisto($atv){
        $this->atividadeBovinoMisto = $atv;
    }

    public function getAtividadeBovinoMisto(){
        return $this->atividadeBovinoMisto;
    }

    public function setAtividadeSuinocultura($atv){
        $this->atividadeSuinocultura = $atv;
    }

    public function getAtividadeSuinocultura(){
        return $this->atividadeSuinocultura;
    }

    public function setAtividadeAviculturaPost($atv){
        $this->atividadeAviculturaPost = $atv;
    }

    public function getAtividadeAviculturaPost(){
        return $this->atividadeAviculturaPost;
    }

    public function setAtividadeAviculturaCorte($atv){
        $this->atividadeAviculturaCorte = $atv;
    }

    public function getAtividadeAviculturaCorte(){
        return $this->atividadeAviculturaCorte;
    }

    public function setAtividadeReceita($atv){
        $this->atividadeReceita = $atv;
    }

    public function getAtividadeReceita(){
        return $this->atividadeReceita;
    }

    public function setProduto($produto){
        $this->produto = $produto;
    }

    public function getProduto(){
        return $this->produto;
    }

    public function setDataLancamento($data){
        $this->dataLancamento = $data;
    }

    public function getDataLancamento(){
        return $this->dataLancamento;
    }    
    
    public function setDescricao($desc){
        $this->descricao = $desc;
    }

    public function getDescricao(){
        return $this->descricao;
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

    public function adicionarLancamento(){
        $connection = Connection::getConnection();            

        // $query = "INSERT INTO equipamentos (nome_equipamento, caracteristica, qtd, valor, vida_util, tempo_uso, uso_caprinos, uso_ovinos, id_propriedade, id_usuario, data_cadastro) 
        // VALUES (:nome_equipamento, :caracteristica, :qtd, :valor, :vida_util, :tempo_uso, :uso_caprinos, :uso_ovinos, :id_propriedade, :id_usuario, :data_cadastro)";

        $query = "INSERT INTO lancamento_financeiro (tipo_lancamento, categoria_lancamento, atividade_ovino, atividade_caprino, atividade_bovino_leite, atividade_bovino_corte, atividade_bovino_misto, atividade_suinocultura, atividade_avicultura_postura, atividade_avicultura_corte, atividade_receita, data_despesa, produto, vida_util, qtd, qtd_unidade, valor, descricao, data_lancamento, id_usuario, id_propriedade) 
        VALUES (:tipo_lancamento, :categoria_lancamento, :atividade_ovino, :atividade_caprino, :atividade_bovino_leite, :atividade_bovino_corte, :atividade_bovino_misto, :atividade_suinocultura, :atividade_avicultura_postura, :atividade_avicultura_corte, :atividade_receita, :data_despesa, :produto, :vida_util, :qtd, :qtd_unidade, :valor, :descricao, :data_lancamento, :id_usuario, :id_propriedade)
        ";

        try{

            $stmt = $connection->prepare($query);
            
            $stmt->bindValue(':tipo_lancamento', $this->tipoLancamento);
            $stmt->bindValue(':categoria_lancamento', $this->categoria);
            $stmt->bindValue(':atividade_ovino', $this->atividadeOvino);
            $stmt->bindValue(':atividade_caprino', $this->atividadeCaprino);
            $stmt->bindValue(':atividade_bovino_leite', $this->atividadeBovinoLeite);
            $stmt->bindValue(':atividade_bovino_corte', $this->atividadeBovinoCorte);
            $stmt->bindValue(':atividade_bovino_misto', $this->atividadeBovinoMisto);
            $stmt->bindValue(':atividade_suinocultura', $this->atividadeSuinocultura);
            $stmt->bindValue(':atividade_avicultura_postura', $this->atividadeAviculturaPost);
            $stmt->bindValue(':atividade_avicultura_corte', $this->atividadeAviculturaCorte);
            $stmt->bindValue(':atividade_receita', $this->atividadeReceita);
            $stmt->bindValue(':data_despesa', $this->dataLancamento);
            $stmt->bindValue(':produto', $this->produto);
            $stmt->bindValue(':vida_util', $this->vidaUtil);
            $stmt->bindValue(':qtd', $this->qtd);
            $stmt->bindValue(':qtd_unidade', $this->qtdUnidade);
            $stmt->bindValue(':valor', $this->valor);
            $stmt->bindValue(':descricao', $this->descricao);
            $stmt->bindValue(':data_lancamento', $this->dataCadastro);                        
            $stmt->bindValue(':id_propriedade', $this->idPropriedade);
            $stmt->bindValue(':id_usuario', $this->id);                        
            
            $result = $stmt->execute();
            return array('status' => 'Success', 'value' => 'Lançamento cadastrado com sucesso!');
        }catch(PDOException $err){
            return array('status' => 'Erro', 'value' => $err);
        }
    }

    public function obterTotal(){
        $connection = Connection::getConnection();
        
        $arquivo = fopen('ids.txt', 'r');

        $conteudo = fread($arquivo, filesize('ids.txt'));

        $array = json_decode($conteudo);

        fclose($arquivo);

        $query = "SELECT SUM(valor) from lancamento_financeiro WHERE id_propriedade = $array->idPropriedade 
                    AND tipo_lancamento = 'despesa'";

        $query2 = "SELECT SUM(valor) from lancamento_financeiro WHERE id_propriedade = $array->idPropriedade 
        AND tipo_lancamento = 'receita'";

        $query3 = "SELECT SUM(valor) from lancamento_financeiro WHERE id_propriedade = $array->idPropriedade 
        AND tipo_lancamento = 'investimento'";

        try{
            $stmt = $connection->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt2 = $connection->prepare($query2);
            $stmt2->execute();
            $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

            $stmt3 = $connection->prepare($query3);
            $stmt3->execute();
            $result3 = $stmt3->fetch(PDO::FETCH_ASSOC);
            // return  $result;
            return array('despesa' => $result, 'receita' => $result2, 'investimento' => $result3);
        }catch(PDOException $err){
            return array('status' => 'Erro', 'value' => $err);
        }
    }

}