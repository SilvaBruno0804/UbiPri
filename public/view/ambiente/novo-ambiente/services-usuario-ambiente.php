<?php

require_once '../../../../vendor/autoload.php';
require_once '../../../../app/config/value-config.php';

use app\controle\Login;
use app\database\SSP;

$login = new Login();
$login->sec_session_start();


// DB Tabela
$table = 'pessoa_ambiente';

//Chave Primaria
$primaryKey = 'pessoa_ambiente_id';

//Where
$where = " pa.Ambiente_id = {$_SESSION['sessaoTempAmbienteId']} ";


//JOIN
$joinQuery = " FROM pessoa_ambiente AS pa LEFT JOIN pessoa AS pes ON (pa.Usuario_id = pes.pes_id) ";


$columns = array(

    /*Pessoa Ambiente*/
    array( 'db' => 'pa.pessoa_ambiente_id', 'dt' => 'pessoa_ambiente_id'    , 'field' => 0),
    array( 'db' => 'pa.Ambiente_id',        'dt' => 'Ambiente_id'           , 'field' => 1),
    array( 'db' => 'pa.hora_inicio',        'dt' => 'hora_inicio'           , 'field' => 2),
    array( 'db' => 'pa.hora_fim',           'dt' => 'hora_fim'              , 'field' => 3),
    array( 'db' => 'pa.dias_semana',        'dt' => 'dias_semana'           , 'field' => 4),
    array( 'db' => 'pa.Usuario_id',         'dt' => 'Usuario_id'            , 'field' => 5),

    /*Pessoa*/
    array( 'db' => 'pes.pes_id',                        'dt' => 'pes_id'                , 'field' => 6),
    array( 'db' => 'pes.pes_nome',                      'dt' => 'pes_nome'              , 'field' => 7),
    array( 'db' => 'pes.pes_email',                     'dt' => 'pes_email'             , 'field' => 8),
    array( 'db' => 'pes.pes_senha',                     'dt' => 'pes_senha'             , 'field' => 9),
    array( 'db' => 'pes.grupo_acesso_id',               'dt' => 'grupo_acesso_id'       , 'field' => 10),
    array( 'db' => 'pes.pes_foto',                      'dt' => 'pes_foto'              , 'field' => 11),
    array( 'db' => 'pes.pes_identntificacao_esfera',    'dt' => 'pes_identntificacao_esfera'    , 'field' => 12),
    array( 'db' => 'pes.cidade_id',                 'dt' => 'cidade_id'         , 'field' => 13),

    //Dias da semana formatado
    array( 'db' => 'pa.dias_semana', 'dt' => 'dias_formtadas','field' => 14, 'formatter' =>
        function( $d, $row ) {
            $diasFormatado = null;
            $diasemana = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');
            $ArrayDiasSemanaBD = explode(',', $d);

            for($i=0; $i<count($ArrayDiasSemanaBD); $i++){
                $diasFormatado .= $diasemana[$ArrayDiasSemanaBD[$i]-1].", ";
            }

            $diasFormatado = rtrim($diasFormatado, ', ');

            return  $diasFormatado;
        }
    ),

    //Horário Formatado
    array( 'db' => 'pa.pessoa_ambiente_id', 'dt' => 'horas_formtadas','field' => 15, 'formatter' =>
        function( $d, $row ) {
            $horaInicio = strtotime($row[2]);
            $horaFinal = strtotime($row[3]);

            return  date("H:i", $horaInicio) ." as ". date("H:i", $horaFinal);
        }
    ),

    //Ações
    array( 'db' => 'pa.pessoa_ambiente_id', 'dt' => 'acoes','field' => 16, 'formatter' =>
        function( $d, $row ) {

            $retorno = "<a href='".VIEW."ambiente/novo-ambiente/editar-usuario/{$row[0]}' class='cursor-pointer' data-tooltip='Editar' > <i class='history black edit link icon'></i></a>";
            $retorno .= "<a class='cursor-pointer' onClick='modalDeletarUsuarioAmbiente($row[0])' data-tooltip='Excluir' > <i class='history black remove link icon'></i></a>";

            return $retorno;
        }
    ),




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