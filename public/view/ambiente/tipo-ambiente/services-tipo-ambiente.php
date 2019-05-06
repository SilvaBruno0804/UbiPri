<?php

header('Content-type: application/json');

require_once '../../../../vendor/autoload.php';
require_once '../../../../app/config/value-config.php';

use app\controle\CrudsGenericoPDO;

$crud = new CrudsGenericoPDO();


//Salva no banco de dados as informações do tipo de ambiente
if($_POST['form'] == "cadastrar-novo-tipo-ambiente"){

    $array = array();
    $array['nome']      = filter_input(INPUT_POST, 'nome',FILTER_SANITIZE_STRING);
    $array['obs']       = filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING);
    $array['Esfera_id'] = filter_input(INPUT_POST, 'Esfera_id', FILTER_SANITIZE_NUMBER_INT);

    if($crud->cadastrar("tipoambiente", $array)){
        $arr['status'] = true;
        $arr['information'] = "Tipo de ambiente cadastrada com sucesso.";
        $arr['site'] = VIEW.'ambiente/tipo-ambiente/listar-tipo-ambiente';
    }else{
        $arr['status'] = false;
        $arr['information'] = "Erro ao salvar os tipo de ambiente, tente novamente e caso o erro persista entre em contato com a comissão organizadora.";
    }

    echo  json_encode($arr);
    exit;

}

//Editar no banco de dados as informações do tipo de ambiente
if($_POST['form'] == "editar-tipo-ambiente"){

    $tipoAmbienteId = filter_input(INPUT_POST, 'tipo-ambiente-id',FILTER_SANITIZE_NUMBER_INT);

    $array = array();
    $array['nome']    = filter_input(INPUT_POST, 'nome',FILTER_SANITIZE_STRING);
    $array['obs']     = filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING);
    $array['Esfera_id'] = filter_input(INPUT_POST, 'Esfera_id', FILTER_SANITIZE_NUMBER_INT);

    if($crud->editar('id', $tipoAmbienteId, 'tipoambiente', $array)){
        $arr['status'] = true;
        $arr['information'] = "Tipo de ambiente cadastrada com sucesso.";
        $arr['site'] = VIEW.'ambiente/tipo-ambiente/editar-tipo-ambiente/'.$tipoAmbienteId;
    }else{
        $arr['status'] = false;
        $arr['information'] = "Erro ao salvar os tipo de ambiente, tente novamente e caso o erro persista entre em contato com a comissão organizadora.";
    }

    echo  json_encode($arr);
    exit;

}


if($_POST['form'] == "deletar-tipo-ambiente"){

    $arr = array();

    $id = filter_input(INPUT_POST, 'dataDeletarTipoAmbiente', FILTER_SANITIZE_NUMBER_INT);

    if($crud->deletar('id', $id, 'tipoambiente')){
        $arr['status'] = true;
        $arr['information'] = "Tipo de ambiente deletado com sucesso." ;
    }else{
        $arr['status'] = false;
        $arr['information'] = "Erro ao deletar este tipo de ambiente, tente novamente e caso o erro persista entre em contato com o administrador." ;
    }

    /* IMPRIME RETORNO */
    echo  json_encode($arr);
    exit;
}



