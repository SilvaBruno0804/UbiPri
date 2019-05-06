<?php

/**
 * Front controler e rotas manual no index
 * design patterns active record para comunicação com o bando
 * Padroes PSRs com excessão do psr0
 * Estimativa de Software, utilizando a formaula de calculo UCP (Use Case Point) 43(pontos)*5 = 215 horas = 26 dias
 * Utilizando a conversão de projetos simples academicos de UCP*5 horas
*/

require_once 'vendor/autoload.php';
require_once 'app/config/value-config.php';

use app\controle\Url;
use app\controle\Login;
use app\controle\CrudsGenericoPDO;

//Classes Globais

$url = new Url();
$crud = new CrudsGenericoPDO();
$login = new Login();

$login->sec_session_start();

$primeiraPasta = array('public');
$segundaPasta = array('view');
$terceiraPasta = array('home', 'login', 'esfera', 'ambiente', 'recurso', 'usuario' );
$quartaPasta = array('tipo-ambiente', 'novo-ambiente', 'novo-recurso');
$quintaPasta = array('n/a');
$sextaPasta = array('n/a');

if (in_array(Url::getURL(0), $primeiraPasta)) {
    if (in_array(Url::getURL(1), $segundaPasta)) {
        if (in_array(Url::getURL(2), $terceiraPasta)) {
            if (in_array(Url::getURL(3), $quartaPasta)) {
                if (in_array(Url::getURL(4), $quintaPasta)) {
                    if (in_array(Url::getURL(5), $sextaPasta)) {
                        if (file_exists(Url::getURL(0) . "/" . Url::getURL(1) . "/" . Url::getURL(2) . "/" . Url::getURL(3) . "/" . Url::getURL(4) . "/". Url::getURL(5) . "/" . Url::getURL(6) . ".php")) {
                            require Url::getURL(0) . "/" . Url::getURL(1) . "/" . Url::getURL(2) . "/" . Url::getURL(3) . "/" . Url::getURL(4) . "/" . Url::getURL(5) . "/" . Url::getURL(6) . ".php";
                        } else {
                            require 'public/view/home/home.php';
                        }
                    }else{
                        if (file_exists(Url::getURL(0) . "/" . Url::getURL(1) . "/" . Url::getURL(2) . "/" . Url::getURL(3) . "/" . Url::getURL(4) . "/" . Url::getURL(5) . ".php")) {
                            require Url::getURL(0) . "/" . Url::getURL(1) . "/" . Url::getURL(2) . "/" . Url::getURL(3) . "/" . Url::getURL(4) . "/" . Url::getURL(5) . ".php";
                        } else {
                            require 'public/view/home/home.php';
                        }
                    }
                } else {
                    if (file_exists(Url::getURL(0) . "/" . Url::getURL(1) . "/" . Url::getURL(2) . "/" . Url::getURL(3) . "/" . Url::getURL(4) . ".php")) {
                        require Url::getURL(0) . "/" . Url::getURL(1) . "/" . Url::getURL(2) . "/" . Url::getURL(3) . "/" . Url::getURL(4) . ".php";
                    } else {
                        require 'public/view/home/home.php';
                    }
                }
            } else {
                if (file_exists(Url::getURL(0) . "/" . Url::getURL(1) . "/" . Url::getURL(2) . "/" . Url::getURL(3) . ".php")) {
                    require Url::getURL(0) . "/" . Url::getURL(1) . "/" . Url::getURL(2) . "/" . Url::getURL(3) . ".php";
                } else {
                    require 'public/view/home/home.php';
                }
            }
        } else {
            if (file_exists(Url::getURL(0) . "/" . Url::getURL(1) . "/" . Url::getURL(2) . ".php")) {
                require Url::getURL(0) . "/" . Url::getURL(1) . "/" . Url::getURL(2) . ".php";
            } else {
                require 'public/view/home/home.php';
            }
        }
    } else if (file_exists(Url::getURL(0) . "/" . Url::getURL(1) . ".php")) {
        require Url::getURL(0) . "/" . Url::getURL(1) . ".php";
    } else {
        require 'public/view/home/home.php';
    }
} else {
    require 'public/view/home/home.php';
}