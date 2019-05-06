<?php

header('Content-type: application/json');

require_once '../../../../vendor/autoload.php';
require_once '../../../../app/config/value-config.php';

use app\controle\Dates;
use app\controle\CrudsGenericoPDO;

$crud = new CrudsGenericoPDO();
$date = new Dates();


//Salva no banco de dados as informações do tipo de ambiente
if($_POST['form'] == "cadastrar-novo-ambiente"){

    $array = array();
    $array['Esfera_id']         = filter_input(INPUT_POST, 'Esfera_id', FILTER_SANITIZE_NUMBER_INT);
    $array['nome']              = filter_input(INPUT_POST, 'nome',FILTER_SANITIZE_STRING);
    $array['TipoAmbiente_id']   = filter_input(INPUT_POST, 'TipoAmbiente_id', FILTER_SANITIZE_NUMBER_INT);
    $array['AmbientePai_id']    = empty($_POST['AmbientePai_id']) ? null : filter_input(INPUT_POST, 'AmbientePai_id', FILTER_SANITIZE_NUMBER_INT);
    $array['obs']               = filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING);

    if($crud->cadastrar("ambiente", $array)){
        $arr['status'] = true;
        $arr['information'] = "Ambiente cadastrada com sucesso.";
        $arr['site'] = VIEW.'ambiente/novo-ambiente/listar-ambiente';
    }else{
        $arr['status'] = false;
        $arr['information'] = "Erro ao salvar o ambiente no banco de dados, tente novamente e caso o erro persista entre em contato com a comissão organizadora.";
    }

    echo  json_encode($arr);
    exit;

}

//Editar no banco de dados as informações do tipo de ambiente
if($_POST['form'] == "editar-ambiente"){

    $ambienteId = filter_input(INPUT_POST, 'ambiente-id',FILTER_SANITIZE_NUMBER_INT);

    $array = array();
    $array['Esfera_id']         = filter_input(INPUT_POST, 'Esfera_id', FILTER_SANITIZE_NUMBER_INT);
    $array['nome']              = filter_input(INPUT_POST, 'nome',FILTER_SANITIZE_STRING);
    $array['TipoAmbiente_id']   = filter_input(INPUT_POST, 'TipoAmbiente_id', FILTER_SANITIZE_NUMBER_INT);
    $array['AmbientePai_id']    = empty($_POST['AmbientePai_id']) ? null : filter_input(INPUT_POST, 'AmbientePai_id', FILTER_SANITIZE_NUMBER_INT);
    $array['obs']               = filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING);

    if($crud->editar('id', $ambienteId, 'ambiente', $array)){
        $arr['status'] = true;
        $arr['information'] = "Ambiente editado com sucesso.";
        $arr['site'] = VIEW.'ambiente/novo-ambiente/editar-ambiente/'.$ambienteId;
    }else{
        $arr['status'] = false;
        $arr['information'] = "Erro ao editar o ambiente no banco de dados, tente novamente e caso o erro persista entre em contato com a comissão organizadora.";
    }

    echo  json_encode($arr);
    exit;

}

//Deletar o ambiente
if($_POST['form'] == "deletar-ambiente"){

    $arr = array();

    $id = filter_input(INPUT_POST, 'dataDeletarAmbiente', FILTER_SANITIZE_NUMBER_INT);

    if($crud->deletar('id', $id, 'ambiente')){
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

//Cadastrar o usuário no ambiente
if($_POST['form'] == "cadastrar-usuario-ambiente"){

    $arr = array();

    $usuarioEmail = filter_input(INPUT_POST, 'pes_email', FILTER_SANITIZE_EMAIL);

    $array = array();
    $array['pessoa_ambiente_data_cadastrado'] = $date->returnDateTimeNow();
    $array['Ambiente_id']               = filter_input(INPUT_POST, 'Ambiente_id', FILTER_SANITIZE_NUMBER_INT);
    $array['hora_inicio']               = filter_input(INPUT_POST, 'hora_inicio',FILTER_SANITIZE_STRING);
    $array['hora_fim']                  = filter_input(INPUT_POST, 'hora_fim', FILTER_SANITIZE_STRING);
    $array['dias_semana']               = filter_input(INPUT_POST, 'dias_semana', FILTER_SANITIZE_STRING);
    $array['Usuario_id']                = filter_input(INPUT_POST, 'Usuario_id', FILTER_SANITIZE_NUMBER_INT);
    $array['pessoa_ambiente_obs']       = filter_input(INPUT_POST, 'pessoa_ambiente_obs', FILTER_SANITIZE_STRING);

    if($crud->cadastrar("pessoa_ambiente", $array)){
        $arr['status'] = true;
        $arr['information'] = "Usuário cadastrada com sucesso.";
        $arr['site'] = VIEW.'ambiente/novo-ambiente/listar-usuario/'.$array['Ambiente_id'];
    }else{
        $arr['status'] = false;
        $arr['information'] = "Erro ao salvar o usuário no banco de dados, tente novamente e caso o erro persista entre em contato com a comissão organizadora.";
    }

    /* IMPRIME RETORNO */
    echo  json_encode($arr);
    exit;

}

//Editar o usuário do ambiente
if($_POST['form'] == "editar-usuario-ambiente"){

    $arr = array();

    $usuarioEmail = filter_input(INPUT_POST, 'pes_email', FILTER_SANITIZE_EMAIL);
    $pessoaAmbienteId = filter_input(INPUT_POST, 'pessoa_ambiente_id', FILTER_SANITIZE_NUMBER_INT);

    $array = array();
    $array['Ambiente_id']               = filter_input(INPUT_POST, 'Ambiente_id', FILTER_SANITIZE_NUMBER_INT);
    $array['hora_inicio']               = filter_input(INPUT_POST, 'hora_inicio',FILTER_SANITIZE_STRING);
    $array['hora_fim']                  = filter_input(INPUT_POST, 'hora_fim', FILTER_SANITIZE_STRING);
    $array['dias_semana']               = filter_input(INPUT_POST, 'dias_semana', FILTER_SANITIZE_STRING);
    $array['Usuario_id']                = filter_input(INPUT_POST, 'Usuario_id', FILTER_SANITIZE_NUMBER_INT);
    $array['pessoa_ambiente_obs']       = filter_input(INPUT_POST, 'pessoa_ambiente_obs', FILTER_SANITIZE_STRING);

    if($crud->editar('pessoa_ambiente_id', $pessoaAmbienteId, 'pessoa_ambiente', $array)){
        $arr['status'] = true;
        $arr['information'] = "Usuário editado com sucesso.";
        $arr['site'] = VIEW.'ambiente/novo-ambiente/editar-usuario/'.$pessoaAmbienteId;
    }else{
        $arr['status'] = false;
        $arr['information'] = "Erro ao editar o usuário no banco de dados, tente novamente e caso o erro persista entre em contato com a comissão organizadora.";
    }

    /* IMPRIME RETORNO */
    echo  json_encode($arr);
    exit;
}

//Deletar o usuário do ambiente
if($_POST['form'] == "deletar-usuario-ambiente"){

    $arr = array();

    $id = filter_input(INPUT_POST, 'dataUsuarioAmbiente', FILTER_SANITIZE_NUMBER_INT);

    if($crud->deletar('pessoa_ambiente_id', $id, 'pessoa_ambiente')){
        $arr['status'] = true;
        $arr['information'] = "Usuário do ambiente deletado com sucesso." ;
    }else{
        $arr['status'] = false;
        $arr['information'] = "Erro ao deletar o usuário do ambiente, tente novamente e caso o erro persista entre em contato com o administrador." ;
    }

    /* IMPRIME RETORNO */
    echo  json_encode($arr);
    exit;
}
