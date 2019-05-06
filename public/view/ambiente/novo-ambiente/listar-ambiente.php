<?php
include_once("public/view/partial/checklog.php");
include_once("public/view/partial/checkEsferaAtiva.php");

use app\controle\AmbienteControle;

$ambienteCtrl = new AmbienteControle();

?>

<html>
<head>
    <meta charset="UTF-8">
    <?php require_once("public/view/partial/includes.php"); ?>
    <title><?php echo(INITIALS_AND_TITLE) ?></title>
    <script src="<?php echo(JS_CONTROLLERS) ?>ambienteCtrl.js" type="text/javascript"></script>
    <script src="<?php echo(JS_FILTERS) ?>filterMask.js" type="text/javascript"></script>
</head>

<body>

<!--Cabeçalho-->
<?php include_once("public/view/partial/header.php"); ?>
<!--Cabeçalho-->

<!--Container-->
<div id="container">

    <!--Menu Esquedo-->
    <?php include_once("public/view/partial/menu-esquerdo.php"); ?>
    <!--Menu Esquedo-->

    <!--Conteudo-->
    <div id="conteudo">

        <!--Navegação-->
        <div class="ui segment">
            <div class="navigation">
                <nav class="ui breadcrumb">
                    <a class="section" href="<?php echo(URLBASE); ?>">Home</a>
                    <i class="right arrow icon divider"></i>
                    <div class="active section">Listar Ambientes</div>
                </nav>
            </div>
        </div>
        <!--Navegação-->

        <!--Esfera Ativa-->
        <div class="ui warning  message">
            <i class="close icon"></i>
            Esfera Ativa: <?php echo($_SESSION['esferaAtivaNome']);?>
        </div>
        <!--Esfera Ativa-->

        <!--Informações-->
        <div class="ui yellow segment">

            <table class="ui compact striped selectable celled table" id="dadosTabelaAmbiente" >
                <thead>
                <tr>
                    <th class="one wide center aligned">ID</th>
                    <th class="four wide center aligned">Nome</th>
                    <th class="four wide center aligned">Ambiente</th>
                    <th class="four wide center aligned">Tipo de Ambiente</th>
                    <th class="two wide center aligned">Usuários</th>
                    <th class="one wide center aligned">Ações</th>
                </tr>
                </thead>

                <tbody>

                    <?php
                    $sqlAmbiente = "SELECT 
                    ambiente.id, ambiente.nome, ambiente.Esfera_id, ambiente.TipoAmbiente_id, ambiente.obs, ambiente.AmbientePai_id,
                    tipoambiente.nome AS tipoNome, tipoambiente.obs AS tipoObs
                    FROM ambiente 
                    LEFT JOIN tipoambiente ON ambiente.TipoAmbiente_id = tipoambiente.id 
                    WHERE ambiente.Esfera_id =  {$_SESSION['esferaAtivaId']}";
                    $bdAmbiente = $crud->listar_sql_especifico($sqlAmbiente);
                    foreach($bdAmbiente as $list){
                    ?>

                    <tr>
                        <td><?php echo($list->id);?></td>
                        <td><?php echo($list->nome);?></td>
                        <td><?php echo($ambienteCtrl->retornaInformacoesAmbientePai($list->AmbientePai_id, 'nome'));?></td>
                        <td><?php echo($list->tipoNome);?></td>

                        <td>
                            <a href="<?php echo(VIEW."ambiente/novo-ambiente/listar-usuario/".$list->id);?>"><i class="users link black icon"></i></a>
                        </td>

                        <td>

                            <a href="<?php echo(VIEW."ambiente/novo-ambiente/editar-ambiente/".$list->id);?>" ><i class="edit black icon"></i></a>

                            <?php if($ambienteCtrl->verificaPermissaoDeletarAmbiente($list->id)){?>
                            <span class="link" data-tooltip='Excluir' ><a class="deletarAmbiente" data-ambiente-id="<?php echo($list->id);?>"><i class='remove link icon'></i></a></span>
                            <?php } ?>

                        </td>

                    </tr>

                    <?php } ?>

                </tbody>

            </table>

            <div class="cleaner-h10"></div>

            <div align="center">
                <div class="ui buttons">
                    <a href="<?php echo(VIEW."ambiente/novo-ambiente/cadastrar-ambiente")?>" class="ui right labeled icon orange button" >Cadastrar Novo Ambiente <i class="add circle icon"></i></a>
                </div>
            </div>

        </div>
        <!--Informações-->

    </div>
    <!--Conteudo-->

    <div class="cleaner"></div>

</div>
<!--Container-->

</body>
</html>

