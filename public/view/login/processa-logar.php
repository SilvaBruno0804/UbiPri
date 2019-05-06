<?php

header('Content-type: application/json');

require_once '../../../vendor/autoload.php';
require_once '../../../app/config/value-config.php';

use app\controle\Login;

$login = new Login();
$login->sec_session_start();

$email      = trim(strtolower(filter_input(INPUT_POST, 'pes_email', FILTER_SANITIZE_EMAIL)));
$password   = filter_input(INPUT_POST, 'pes_senha', FILTER_SANITIZE_STRING);

$responseLogin = $login->login($email, $password);

$arr = array();

switch ($login->getStatusLogin()) {
    case 1:
        $arr['status'] = $responseLogin;
        $arr['information'] = "Usuário não existe";
        $arr['site'] = VIEW."login/logar";
        break;

    case 2:
        $arr['status'] = $responseLogin;
        $arr['information'] = "Sua conta excedeu as tentativas de login, aguarde cerca de 1 hora e tente novamente ou entre em contato com o administrador";
        $arr['site'] = VIEW."login/logar";
        break;

    case 3:
        $arr['status'] = $responseLogin;
        $arr['information'] = "A senha que voçe digitou não está correta, verifique se digitou corretamente ou se o caps lock esta habilitado";
        $arr['site'] = VIEW."login/logar";
        break;

    case 0:
        $arr['status'] = $responseLogin;
        $arr['information'] = "Login efetuado com sucesso";
        $arr['site'] = URLBASE;
        break;

    default:
        $arr['status'] = $responseLogin;
        $arr['information'] = "Erro inesperado, tente novamente e caso o erro persista entre em contato com o administrador";
        $arr['site'] = URLBASE;
        break;
}


/* IMPRIME RETORNO */
echo  json_encode($arr);
exit;