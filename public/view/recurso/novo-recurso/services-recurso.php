<?php

header('Content-type: application/json');

require_once '../../../../vendor/autoload.php';
require_once '../../../../app/config/value-config.php';

use app\controle\CrudsGenericoPDO;

$crud = new CrudsGenericoPDO();


//Salva no banco de dados as informações do Recurso
if($_POST['form'] == "cadastrar-novo-recurso"){

    $array = array();
    $array['recurso_nome']              = filter_input(INPUT_POST, 'recurso_nome',FILTER_SANITIZE_STRING);
    $array['Ambiente_id']   = filter_input(INPUT_POST, 'Ambiente_id', FILTER_SANITIZE_NUMBER_INT);
    $array['recurso_obs']               = filter_input(INPUT_POST, 'recurso_obs', FILTER_SANITIZE_STRING);

    if($crud->cadastrar("recurso", $array)){
        $arr['status'] = true;
        $arr['information'] = "Recurso cadastrada com sucesso.";
        $arr['site'] = VIEW.'recurso/novo-recurso/listar-recurso';
    }else{
        $arr['status'] = false;
        $arr['information'] = "Erro ao salvar o Recurso no banco de dados, tente novamente e caso o erro persista entre em contato com a comissão organizadora.";
    }

    echo  json_encode($arr);
    exit;

}

//Editar no banco de dados as informações do recurso
if($_POST['form'] == "editar-recurso"){

    $recursoId = filter_input(INPUT_POST, 'recurso_id',FILTER_SANITIZE_NUMBER_INT);

    $array = array();
    $array['recurso_nome']              = filter_input(INPUT_POST, 'recurso_nome',FILTER_SANITIZE_STRING);
    $array['Ambiente_id']   = filter_input(INPUT_POST, 'Ambiente_id', FILTER_SANITIZE_NUMBER_INT);
    $array['recurso_obs']               = filter_input(INPUT_POST, 'recurso_obs', FILTER_SANITIZE_STRING);

    if($crud->editar('recurso_id', $recursoId, 'recurso', $array)){
        $arr['status'] = true;
        $arr['information'] = "Recurso editado com sucesso.";
        $arr['site'] = VIEW.'recurso/novo-recurso/editar-recurso/'.$recursoId;
    }else{
        $arr['status'] = false;
        $arr['information'] = "Erro ao editar o Recurso no banco de dados, tente novamente e caso o erro persista entre em contato com a comissão organizadora.";
    }

    echo  json_encode($arr);
    exit;

}


if($_POST['form'] == "deletar-recurso"){

    $arr = array();

    $id = filter_input(INPUT_POST, 'dataDeletarRecursoId', FILTER_SANITIZE_NUMBER_INT);

    if($crud->deletar('recurso_id', $id, 'recurso')){
        $arr['status'] = true;
        $arr['information'] = "Ambiente deletado com sucesso." ;
    }else{
        $arr['status'] = false;
        $arr['information'] = "Erro ao deletar este ambiente, tente novamente e caso o erro persista entre em contato com o administrador." ;
    }

    /* IMPRIME RETORNO */
    echo  json_encode($arr);
    exit;
}



