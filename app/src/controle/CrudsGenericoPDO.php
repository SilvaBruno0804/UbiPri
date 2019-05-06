<?php

namespace app\controle;
use PDO;
use app\database\Conexao;

/**
 * Classe Generica em PDO.
 * Create 
 * Read
 * Update
 * Delete
 * @author Leandro
 */

class CrudsGenericoPDO {

    protected $_conexao;

    /**
     *Metodo construtor, traz por parametro a conexão ativa   
     */
    public function __construct() {
        $conexao = new Conexao();
        $this->_conexao = $conexao->conectar();
    }

    /**
     * Metodo Cadastrar, após salvar o mesmo retorna o id banco de dados. 
     */
    public function cadastrar($tabela, $atributos) {

        /* Pega indices do array que são os nomes dos campos da tabela */
        $chaves = array_keys($atributos);

        /* Os Nomes da tabela em forma de string */
        $camposTabela = implode(',', $chaves);

        /* Iniciando variavel que será usada no looping */
        $values = NULL;

        /* Looping para pegar os valores e colocar os dois pontos (:) na frente de cada um deles */
        foreach ($chaves as $chave) {
            $values.=', :' . $chave;
        }

        //tira a primeira virgula
        $values = (ltrim($values, ','));

        //tira os espa�o do come�o e do Fim
        $values = (ltrim($values));

        $cadastrar = $this->_conexao->prepare("INSERT INTO $tabela ($camposTabela) VALUES ($values)");

        try {
            $cadastrar->execute($atributos);
            return $this->_conexao->lastInsertId();
        } catch (PDOException $erro) {
            //$erro->getMessage();
            echo($erro->getMessage());
            return  false;
        }
    }

    /**
     * Metodo Editar, como o nome já diz o mesmo atualiza as informações do banco de dados. 
     */
    public function editar($nomeCampoID, $id, $tabela, $atributos) {

        $values = NULL;

        foreach ($atributos as $chave => $value) {
            $values.= $chave . '=:' . $chave . ',';
        }

        $values = (rtrim($values, ','));

        $atualizar = $this->_conexao->prepare("UPDATE $tabela SET $values WHERE $nomeCampoID=:id");
        $atributos['id'] = $id;

        try {
            $atualizar->execute($atributos);
            return true;
        } catch (PDOException $erro) {
            //$erro->getMessage();
            return false;
        }
    }
    
    /**
     * Metodo para editar campos especifico
     * @param string $tabela Nome da tabela do banco de dados que será atualizada.
     * @param string $setId nome da tupla que receberá o novo dado.
     * @param string $setDado o novo dado que será salvo no banco de dados.
     * @param string $whereId campo identificar que o where utilizará para modificação
     * @param string $whereDado campo dados de comparação no Where do sql
     */
    public function editarCampoEspecifico($tabela, $setId, $setDado, $whereId, $whereDado) {
        $sql = "UPDATE {$tabela} SET {$setId} = '{$setDado}' WHERE {$whereId} =  '{$whereDado}'";
        $atualizar = $this->_conexao->prepare($sql);
        
         try {
            $atualizar->execute();
            return true;
        } catch (PDOException $erro) {
            //return$erro->getMessage();
            return false;
        }
        
    }

   /**
     * Metodo Deletar, como o nome já diz o mesmo deleta as informações do banco de dados. 
     */
    public function deletar($nomeCampoID, $id, $tabela) {

        $deletar = $this->_conexao->prepare("DELETE FROM $tabela WHERE $nomeCampoID = :id");
        $deletar->bindValue(":id", $id);

        try {
            $deletar->execute();
            return $deletar->rowCount();
        } catch (PDOException $erro) {
            //$erro->getMessage();
            return false;
        }
    }
    
    /**
     * Metodo Deletar, como o nome já diz o mesmo deleta as informações do banco de dados, já trazendo por parametro o sql 
     */
    public function deletarSql($sql) {

        $deletar = $this->_conexao->prepare($sql);
        
        try {
            $deletar->execute();
            return $deletar->rowCount();
        } catch (PDOException $erro) {
            //$erro->getMessage();
            return false;
        }
    }
    
    /**
     * Metodo Listar, como o nome já diz o mesmo lista as informações do banco de dados. 
     */
    public function listar($tabela) {

        $listar = $this->_conexao->query("SELECT * FROM $tabela");
        $listar->execute();
        return $listar->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Crud listar SQL Especifico
     */
    public function listar_sql_especifico($sql) {

        $listar = $this->_conexao->query($sql);
        $listar->execute();
        return $listar->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     * Retorna dado Especifico, utilizando os campos como parametro
     */
    public function return_dado_bd($tabela, $campo, $id, $dado) {

        $stmt = $this->_conexao->prepare("SELECT * FROM $tabela WHERE $campo = :id LIMIT 1");
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();   // Execute the prepared query.

        while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $resultado = $linha[$dado];
        }

        return $resultado;
    }
    
    /**
     * Retorna dado Especifico, utilizando o comando sql na totalidade 
     */
    public function return_dado_bd2($sql, $dado) {

        $stmt = $this->_conexao->prepare($sql);
        $stmt->execute();   // Execute the prepared query.

        while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $resultado = $linha[$dado];
        }

        return $resultado;
    }
    
    
    /**
     * Metodo que retorna a quantidade de registro no banco de dados utilizando os campos em parametro 
     */
    public function return_quant_bd($tabela, $campo, $id) {

        $stmt = $this->_conexao->prepare("SELECT * FROM $tabela WHERE $campo = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();   // Execute the prepared query.

        return $stmt->rowCount();
    }
    
    /**
     * Metodo que retorna a quantidade de registro no banco de dados utilizando o sql na totalidade 
     */
    public function return_quant_bd2($sql) {
        $stmt = $this->_conexao->prepare($sql);
        $stmt->execute();   // Execute the prepared query.
        return $stmt->rowCount();
    }
    
    /**
     * Metodo generico que salva os logs importante da inscrição 
     * @param type $inscricao_id Referencia no banco de dados da inscrição
     * @param type $observacao Texto de obseração do log
     */
    public function inscricaoLogs($inscricao_id, $observacao) {

        date_default_timezone_set('America/Sao_Paulo');

        $array = array();
        $array['inscr_obs_data'] = date('Y-m-d H:i:s');
        $array['inscr_obs_texto'] = $observacao;
        $array['inscricao_id'] = $inscricao_id;

        $this->cadastrar("inscricao_observacao", $array);
    }
    
}