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
                    <div class="active section">Listar Tipos de Ambientes </div>
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

            <table class="ui compact striped selectable celled table" id="dadosTabelaTipoAmbiente" >
                <thead>
                <tr>
                    <th class="one wide center aligned">ID</th>
                    <th class="four wide center aligned">Nome</th>
                    <th class="ten wide center aligned">Observação</th>
                    <th class="one wide center aligned">Ações</th>
                </tr>
                </thead>

                <tbody>

                    <?php
                    $sqlTipoAmbiente = "SELECT * FROM tipoambiente WHERE Esfera_id = {$_SESSION['esferaAtivaId']}";
                    $bdTipoAmbiente = $crud->listar_sql_especifico($sqlTipoAmbiente);
                    foreach($bdTipoAmbiente as $list){
                    ?>

                    <tr>
                        <td><?php echo($list->id);?></td>
                        <td><?php echo($list->nome);?></td>
                        <td><?php echo($list->obs);?></td>
                        <td>

                            <a href="<?php echo(VIEW."ambiente/tipo-ambiente/editar-tipo-ambiente/".$list->id);?>" ><i class="edit black icon"></i></a>

                            <?php if($ambienteCtrl->verificaPermissaoDeletar($list->id)){?>
                            <span class="link" data-tooltip='Excluir' ><a class="deletarTipoAmbiente" data-tipo-ambiente-id="<?php echo($list->id);?>"><i class='remove link icon'></i></a></span>
                            <?php } ?>

                        </td>
                    </tr>

                    <?php } ?>

                </tbody>

            </table>

            <div class="cleaner-h10"></div>

            <div align="center">
                <div class="ui buttons">
                    <a href="<?php echo(VIEW."ambiente/tipo-ambiente/cadastrar-tipo-ambiente")?>" class="ui right labeled icon orange button" >Cadastrar Novo Tipo de Ambiente <i class="add circle icon"></i></a>
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

