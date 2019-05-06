<?php

header('Content-type: application/json');

require_once '../../../vendor/autoload.php';
require_once '../../../app/config/value-config.php';

use app\controle\CrudsGenericoPDO;
use app\controle\Login;

$login = new Login();
$crud = new CrudsGenericoPDO();

$login->sec_session_start();

//Salva no banco de dados as informações da Esfera
if($_POST['form'] == "cadastrar-esfera"){

    $array = array();
    $array['nome']               = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $array['responsavel_id']     = filter_input(INPUT_POST, 'responsavel_id', FILTER_SANITIZE_NUMBER_INT);
    $array['cidade_id']          = filter_input(INPUT_POST, 'cidade_id', FILTER_SANITIZE_NUMBER_INT);
    $array['endereco']           = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
    $array['numero']             = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
    $array['cep']                = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
    $array['bairro']             = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
    $array['complemento']        = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);
    $array['site']               = filter_input(INPUT_POST, 'site', FILTER_SANITIZE_URL);
    $array['cnpj']               = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_STRING);
    $array['inscricao_estadual'] = filter_input(INPUT_POST, 'inscricao_estadual', FILTER_SANITIZE_STRING);
    $array['email']              = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $array['telefone']           = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);

    if($crud->cadastrar("esfera", $array)){
        $arr['status'] = true;
        $arr['information'] = "Esfera cadastrada com sucesso.";
        $arr['site'] = VIEW.'esfera/listar-esfera';
    }else{
        $arr['status'] = false;
        $arr['information'] = "Erro ao salvar os dados da Esfera, tente novamente e caso o erro persista entre em contato com a comissão organizadora.";
    }

    echo  json_encode($arr);
    exit;

}


//Editar no banco de dados as informações da Esfera
if($_POST['form'] == "editar-esfera"){

    $esferaId = filter_input(INPUT_POST, 'esfera-id', FILTER_SANITIZE_NUMBER_INT);

    $array = array();
    $array['nome']               = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $array['responsavel_id']     = filter_input(INPUT_POST, 'responsavel_id', FILTER_SANITIZE_NUMBER_INT);
    $array['cidade_id']          = filter_input(INPUT_POST, 'cidade_id', FILTER_SANITIZE_NUMBER_INT);
    $array['endereco']           = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
    $array['numero']             = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
    $array['cep']                = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
    $array['bairro']             = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
    $array['complemento']        = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);
    $array['site']               = filter_input(INPUT_POST, 'site', FILTER_SANITIZE_URL);
    $array['cnpj']               = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_STRING);
    $array['inscricao_estadual'] = filter_input(INPUT_POST, 'inscricao_estadual', FILTER_SANITIZE_STRING);
    $array['email']              = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $array['telefone']           = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);

    if($crud->editar('id', $esferaId, 'esfera', $array)){
        $arr['status'] = true;
        $arr['information'] = "Esfera editado com sucesso.";
        $arr['site'] = VIEW.'esfera/editar-esfera/'.$esferaId;
    }else{
        $arr['status'] = false;
        $arr['information'] = "Erro ao salvar os dados da Esfera, tente novamente e caso o erro persista entre em contato com a comissão organizadora.";
    }

    echo  json_encode($arr);
    exit;

}

if($_POST['form'] == "deletar-esfera"){

    $arr = array();

    $id = filter_input(INPUT_POST, 'dataDeletarId', FILTER_SANITIZE_NUMBER_INT);

    if($crud->deletar('id', $id, 'esfera')){
        $arr['status'] = true;
        $arr['information'] = "Esfera deletada com sucesso." ;
    }else{
        $arr['status'] = false;
        $arr['information'] = "Erro ao deletar esta esfera, tente novamente e caso o erro persista entre em contato com o administrador." ;
    }

    /* IMPRIME RETORNO */
    echo  json_encode($arr);
    exit;
}

if($_POST['form'] == "ativar-esfera"){
    $_SESSION['esferaAtivaId'] = filter_input(INPUT_POST, 'dataAtivarId', FILTER_SANITIZE_NUMBER_INT);
    $_SESSION['esferaAtivaNome'] = filter_input(INPUT_POST, 'dataAtivarNome', FILTER_SANITIZE_STRING);

    $arr = array();
    $arr['status'] = true;

    /* IMPRIME RETORNO */
    echo  json_encode($arr);
    exit;
}