<?php

require_once '../../../vendor/autoload.php';
require_once '../../../app/config/value-config.php';

use app\controle\Login;
use app\database\SSP;

$login = new Login();
$login->sec_session_start();


// DB Tabela
$table = 'pessoa';

//Chave Primaria
$primaryKey = 'pes_id';

//Where
//$where = " pes.Esfera_id = 1";


//JOIN
$joinQuery = " FROM pessoa AS pes LEFT JOIN grupo_acesso AS ga ON (pes.grupo_acesso_id = ga.grupo_acesso_id) ";
$joinQuery .= "LEFT JOIN cidade AS cid ON (cid.cid_id = pes.cidade_id)";
$joinQuery .= "LEFT JOIN estado AS uf ON (cid.estado_uf_id = uf.uf_id)";
$joinQuery .= "LEFT JOIN titulacao AS tit ON (pes.titulacao_id = tit.tit_id)";


$columns = array(

    /*Pessoa*/
    array( 'db' => 'pes.pes_id',                        'dt' => 'pes_id'                        ,'field' => 0),
    array( 'db' => 'pes.pes_nome',                      'dt' => 'pes_nome'                      ,'field' => 1),
    array( 'db' => 'pes.pes_email',                     'dt' => 'pes_email'                     ,'field' => 2),
    array( 'db' => 'pes.pes_senha',                     'dt' => 'pes_senha'                     ,'field' => 3),
    array( 'db' => 'pes.grupo_acesso_id',               'dt' => 'grupo_acesso_id'               ,'field' => 4),
    array( 'db' => 'pes.pes_foto',                      'dt' => 'pes_foto'                      ,'field' => 5),
    array( 'db' => 'pes.pes_identntificacao_esfera',    'dt' => 'pes_identntificacao_esfera'    ,'field' => 6),
    array( 'db' => 'pes.cidade_id',                     'dt' => 'cidade_id'                     ,'field' => 7),

    /*Grupo de Acesso*/
    array( 'db' => 'ga.grupo_acesso_id',    'dt' => 'grupo_acesso_id'  ,'field' => 8),
    array( 'db' => 'ga.grupo_acesso_nome',  'dt' => 'grupo_acesso_nome'   ,'field' => 9),

    /*Cidade*/
    array( 'db' => 'cid.cid_id',    'dt' => 'cid_id'  ,'field' => 10),
    array( 'db' => 'cid.cid_uf',    'dt' => 'cid_uf'  ,'field' => 11),
    array( 'db' => 'cid.cid_nome',  'dt' => 'cid_nome'  ,'field' => 12),

    /*Estado*/
    array( 'db' => 'uf.uf_id',      'dt' => 'uf_id'     ,'field' => 13),
    array( 'db' => 'uf.uf_sigla',   'dt' => 'uf_sigla'  ,'field' => 14),
    array( 'db' => 'uf.uf_nome',    'dt' => 'uf_nome'   ,'field' => 15),
    /*Estado*/

    /*Titulação*/
    array( 'db' => 'tit.tit_id',    'dt' => 'tit_id'     ,'field' => 16),
    array( 'db' => 'tit.tit_nome',  'dt' => 'tit_nome'   ,'field' => 17),
    /*Titulação*/

    /*Esfera*/
    //array( 'db' => 'pes.Esfera_id',    'dt' => 'tit_id'     ,'field' => 18),
    /*Esfera*/









    /*
    array( 'db' => 'pa.pessoa_ambiente_id', 'dt' => 'acoes','field' => 16, 'formatter' =>
        function( $d, $row ) {

            $retorno = "<a href='".VIEW."ambiente/novo-ambiente/editar-usuario/{$row[0]}' class='cursor-pointer' data-tooltip='Editar' > <i class='history black edit link icon'></i></a>";
            $retorno .= "<a class='cursor-pointer' onClick='modalDeletarUsuarioAmbiente($row[0])' data-tooltip='Excluir' > <i class='history black remove link icon'></i></a>";

            return $retorno;
        }
    ),
    */

);

// SQL server connection information
$sql_details = array(
    'user' => USER,
    'pass' => PASSWORD,
    'db'   => DATABASE,
    'host' => HOST
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

//require( '../../../assets/lib/DataTables/examples/ssp-master/example/scripts/ssp.customized.class.php' );

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $where )
);