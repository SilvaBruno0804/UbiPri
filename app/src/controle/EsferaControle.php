<?php

namespace app\controle;

use app\controle\CrudsGenericoPDO;

class EsferaControle{

    private $_crud;

    public function __construct(){
        $this->_crud =  new CrudsGenericoPDO();
    }

    /**
     * Retorna os dados da tabela Esfera utilizando o ID de referencia
     * @param $id do id da tabela Esfera
     * @return Array
    */
    public function retorneLinhaEspecificaBaseDadosEsfera($id){
        $sql = "SELECT * FROM esfera
        LEFT JOIN cidade ON esfera.cidade_id = cidade.cid_id
        LEFT JOIN estado ON cidade.estado_uf_id = estado.uf_id
        WHERE id = '$id'";
        return $this->_crud->listar_sql_especifico($sql);
    }

    /**
     * Retorna o nome do responsável pela esfera
     * @param usuarioId referencia o id do usuário registrado no banco de dados
     * @return String;
    */
    public function retornaNomeResponsavel($usuarioId){
        return $this->_crud->return_dado_bd('pessoa', 'pes_id', $usuarioId, 'pes_nome');
    }

    /**
     * Verifica se é permitido a exclusão da esfera
     * @param $id referencia da table ambiente
     * @return boolean;
    */
    public function verificaPermissaoDeletar($id){

        $ambiente = $this->_crud->return_quant_bd('ambiente', 'Esfera_id', $id);
        $tipoAmbiente = $this->_crud->return_quant_bd('tipoambiente', 'Esfera_id', $id);

        if(!$ambiente && !$tipoAmbiente){
            return true;
        }else{
            return false;
        }

    }




}