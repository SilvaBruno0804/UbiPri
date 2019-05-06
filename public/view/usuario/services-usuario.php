<?php

header('Content-type: application/json');

require_once '../../../vendor/autoload.php';
require_once '../../../app/config/value-config.php';

use app\controle\Dates;
use app\controle\CrudsGenericoPDO;

$crud = new CrudsGenericoPDO();
$date = new Dates();


//Salva no banco de dados as informações do tipo de ambiente
if($_POST['form'] == "novo-usuario"){

    $array = array();
    $array['pes_nome']                      = filter_input(INPUT_POST, 'pes_nome', FILTER_SANITIZE_STRING);
    $array['pes_data_nasc']                 = filter_input(INPUT_POST, 'pes_data_nasc', FILTER_SANITIZE_STRING);
    $array['pes_sexo']                      = filter_input(INPUT_POST, 'pes_sexo', FILTER_SANITIZE_STRING);
    $array['pes_email']                     = trim(strtolower(filter_input(INPUT_POST, 'pes_email', FILTER_SANITIZE_EMAIL)));
    $array['pes_senha']                     = hash('sha512', $_POST['senha']);
    $array['pes_token']                     = hash('sha512', trim(strtolower($_POST['pes_email'])));
    $array['grupo_acesso_id']               = 3;
    $array['pes_instituicao']               = filter_input(INPUT_POST, 'pes_instituicao', FILTER_SANITIZE_NUMBER_INT);
    $array['pes_identntificacao_esfera']    = filter_input(INPUT_POST, 'pes_identntificacao_esfera', FILTER_SANITIZE_STRING);
    $array['cidade_id']                     = filter_input(INPUT_POST, 'cidade_id', FILTER_SANITIZE_NUMBER_INT);
    $array['titulacao_id']                  = filter_input(INPUT_POST, 'titulacao_id', FILTER_SANITIZE_NUMBER_INT);
    $array['Esfera_id']                     = empty($_POST['Esfera_id'])? null : filter_input(INPUT_POST, 'Esfera_id', FILTER_SANITIZE_NUMBER_INT);


    $lastInsertId = $crud->cadastrar("pessoa", $array);

    if($lastInsertId){
        $arr['status'] = true;
        $arr['information'] = "Novo usuário cadastrado com sucesso";
        $arr['id'] = $lastInsertId;
        $arr['name'] = $array['pes_nome'];
        $arr['email'] = $array['pes_email'];
        $arr['reload'] = filter_input(INPUT_POST, 'reload', FILTER_SANITIZE_NUMBER_INT);
    }else{
        $arr['status'] = false;
        $arr['information'] = "Erro ao salvar o usuário no banco de dados, tente novamente e caso o erro persista entre em contato com a comissão organizadora.";
    }

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
