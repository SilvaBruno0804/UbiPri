<?php

namespace app\controle;
use app\controle\CrudsGenericoPDO;

class AmbienteControle
{

    private $_crud;

    public function __construct(){
        $this->_crud =  new CrudsGenericoPDO();
    }


    /**
     * Retorna os dados da tabela tipoambiente utilizando o ID de referencia
     * @param $id do id da tabela tipoambiente
     * @return Array
     */
    public function retorneLinhaEspecificaBaseDadosTipoAmbiente($id){
        $sql = "SELECT * FROM tipoambiente WHERE id = '$id'";
        return $this->_crud->listar_sql_especifico($sql);
    }

    /**
     * Verifica se é permitido a exclusão do Tipo de ambiente
     * @param $id referencia da table tipoambiente
     * @return boolean;
     */
    public function verificaPermissaoDeletarTipoAmbiente($id){
        if(!$this->_crud->return_quant_bd('ambiente', 'id', $id)){
            return true;
        }else{
            return false;
        }

    }

    /**
     * Verifica se é permitido a exclusão do tipo de ambiente
     * @param $id referencia da table ambiente
     * @return boolean;
     */
    public function verificaPermissaoDeletar($id){
        if(!$this->_crud->return_quant_bd('ambiente', 'TipoAmbiente_id', $id)){
            return true;
        }else{
            return false;
        }
    }


    /**
     * AMBIENTE########################################################################################################
    */

    /**
     * Retorna os dados da tabela ambiente utilizando o ID de referencia
     * @param $id do id da tabela ambiente
     * @return Array
     */
    public function retorneLinhaEspecificaBaseDadosAmbiente($id){
        $sql = "SELECT 
        ambiente.id, ambiente.nome, ambiente.Esfera_id, ambiente.TipoAmbiente_id, ambiente.obs, ambiente.AmbientePai_id,
        tipoambiente.nome AS tipoNome, tipoambiente.obs AS tipoObs
        FROM ambiente 
        LEFT JOIN tipoambiente ON ambiente.TipoAmbiente_id = tipoambiente.id
        WHERE ambiente.id = '$id'";
        return $this->_crud->listar_sql_especifico($sql);
    }

    /**
     * retorna o nome do ambiente pai do ambiente
     * @param $id referencia da table ambiente
     * @param $value define o valor que será retornado
     * @return String
    */
    public function retornaInformacoesAmbientePai($id, $value){
        return $this->_crud->return_dado_bd('ambiente', 'id', $id, "{$value}");
    }

    /**
     * Verifica se é permitido deletar o ambiente
     * @param $id referencia da table ambiente
     * @return boolean;
     */
    public function verificaPermissaoDeletarAmbiente($id){

        $recurso            = $this->_crud->return_quant_bd('recurso', 'Ambiente_id', $id);
        $ambientePai        = $this->_crud->return_quant_bd('ambiente', 'AmbientePai_id', $id);
        $usuarioAmbiente    = $this->_crud->return_quant_bd('pessoa_ambiente', 'Ambiente_id', $id);

        if(!$ambientePai && !$recurso && !$usuarioAmbiente){
            return true;
        }else{
            return false;
        }

    }

    /**
     * Retorna os dados da tabela pessoa_ambiente utilizando o ID de referencia
     * @param $id do pessoa_ambiente_id da tabela pessoa_ambiente
     * @return Array
     */
    public function retorneLinhaEspecificaBaseDadosPessoaAmbiente($id){
        $sql = "SELECT * FROM pessoa_ambiente 
        LEFT JOIN pessoa ON pessoa_ambiente.Usuario_id = pessoa.pes_id
        WHERE pessoa_ambiente_id = {$id}";

        return $this->_crud->listar_sql_especifico($sql);
    }



}