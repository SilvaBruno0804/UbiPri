<?php

header('Content-type: application/json');

require_once '../../vendor/autoload.php';
require_once '../config/value-config.php';

use app\controle\Url;
use app\controle\Login;
use app\controle\Dates;
use app\controle\CrudsGenericoPDO;
use app\controle\ValidInputGlobal;

$crud 	= new CrudsGenericoPDO();
$date = new Dates();
$login = new Login();
$validInputs = new ValidInputGlobal();

$login->sec_session_start();



/**
 * Verifica se o e-mail consultado existe no bando de dados da tabela pessoa
 * @return Boolean
 */
if($_POST['form'] == "checkEmail"){
	
	$postEmail = trim(strtolower(filter_input(INPUT_POST, 'pes_email', FILTER_SANITIZE_EMAIL)));
    $sql = "SELECT * FROM pessoa WHERE pes_email = '{$postEmail}' ";
        
	if($crud->return_quant_bd2($sql)){
		$arr = array();
		$arr['status'] = true;
		$arr['information'] = "E-mail já cadastrado no Sitema";
		$arr['site'] = URLBASE;
		$valide = $arr;
	}else{
		$arr = array();
		$arr['status'] = false;
		$arr['information'] = "E-mail Não Existe";
		$arr['site'] = URLBASE;
		$valide = $arr;
	}

/* IMPRIME RETORNO */
echo  json_encode($valide);
exit;

}

/*Buscar Autores*/
if($_GET['form'] == "searchPersonGlobal"){
        
    $search = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
    $sql = "SELECT * FROM pessoa LEFT JOIN grupo_acesso ON pessoa.grupo_acesso_id = grupo_acesso.grupo_acesso_id WHERE pes_nome LIKE '%{$search}%'";
    $bdResults = $crud->listar_sql_especifico($sql);
    $totalCount = $crud->return_quant_bd2($sql);
    
    if($totalCount>0){
        
        foreach ($bdResults as $list) {
             $pessoa = array(
                'id' => $list->pes_id,
                'nome' => $list->pes_nome,
                'email' => $list->pes_email,
                'emailAlternativo' => $list->pes_email_alternativo,
                'descricao' =>"Codigo de Pessoa: ".$list->pes_id."<br/>Email: ".$list->pes_email ."<br/> Grupo: ".$list->grupo_acesso_nome,
                'img' => IMG."users/".$list->pes_foto
            );

            //$json['pessoas'][] = $pessoa;
             $json[] = $pessoa;
        }
        
        $arr = array();
        $arr['total_count'] = $totalCount;
        $arr['incomplete_results'] = true;
        $arr['status'] = 400;
        $arr['pessoas'] = $json;
        $valide = $arr;
    }else{
        $arr = array();
        $arr['status'] = 200;
        $valide = $arr;
    }
    
    echo json_encode($valide);
}

/*Carrega as cidades*/
if($_POST['form'] == "loadingCity"){

    $cityId = filter_input(INPUT_POST, 'cityId', FILTER_SANITIZE_NUMBER_INT);

    $sqlCity = "SELECT * FROM cidade WHERE estado_uf_id = {$cityId}";

    $bdCity = $crud->listar_sql_especifico($sqlCity);
    foreach($bdCity as $list){
        echo "<div class='item' data-value='{$list->cid_id}'>{$list->cid_nome}</div>\n";
    }
}

/**
 * Verifica se o cnpj é válido
 */
if($_POST['form'] == "checkCNPJ"){

    $cnpj = filter_input(INPUT_POST, 'pes_cnpj', FILTER_SANITIZE_STRING);

    $arr = array();
    $arr['status'] = $validInputs->validar_cnpj($cnpj);
    $arr['information'] =  "CNPJ invalido";

    /* IMPRIME RETORNO */
    echo  json_encode($arr);
    exit;
}
