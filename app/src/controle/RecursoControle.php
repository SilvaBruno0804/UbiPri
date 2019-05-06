<?php

namespace app\controle;
use app\controle\CrudsGenericoPDO;


class RecursoControle
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
    public function retorneLinhaEspecificaBaseDadosRecurso($id){
        $sql = "SELECT * FROM recurso WHERE recurso_id = '$id'";
        return $this->_crud->listar_sql_especifico($sql);
    }

    /**
     * Verifica se é permitido deletar o recurso
     * @param $id referencia da table recurso
     * @return boolean;
     */
    public function verificaPermissaoDeletarRecurso($id){

        $recurso  = $this->_crud->return_quant_bd('acessoaorecurso', 'Recurso_id', $id);

        if(!$recurso){
            return true;
        }else{
            return false;
        }

    }


}