<?php
include_once("public/view/partial/checklog.php");
include_once("public/view/partial/checkEsferaAtiva.php");

use app\controle\RecursoControle;

$recursoCtrl = new RecursoControle();

?>

<html>
<head>
    <meta charset="UTF-8">
    <?php require_once("public/view/partial/includes.php"); ?>
    <title><?php echo(INITIALS_AND_TITLE) ?></title>
    <script src="<?php echo(JS_CONTROLLERS) ?>recursoCtrl.js" type="text/javascript"></script>
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
                    <div class="active section">Listar Recursos</div>
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

            <table class="ui compact striped selectable celled table" id="dadosTabelaNovoRecurso" >
                <thead>
                <tr>
                    <th class="one wide center aligned">ID</th>
                    <th class="three wide center aligned">Nome</th>
                    <th class="three wide center aligned">Ambiente</th>
                    <th class="one wide center aligned">Ações</th>
                </tr>
                </thead>

                <tbody>

                    <?php
                    $sqlRecurso = "SELECT * 
                    
                    FROM recurso 
                    LEFT JOIN ambiente ON recurso.Ambiente_id = ambiente.id 
                    WHERE ambiente.Esfera_id =  {$_SESSION['esferaAtivaId']}";
                    $bdRecurso = $crud->listar_sql_especifico($sqlRecurso);
                    foreach($bdRecurso as $list){
                    ?>

                    <tr>
                        <td><?php echo($list->recurso_id);?></td>
                        <td><?php echo($list->recurso_nome);?></td>
                        <td><?php echo($list->nome);?></td>

                        <td>

                            <a href="<?php echo(VIEW."recurso/novo-recurso/editar-recurso/".$list->recurso_id);?>" ><i class="edit black icon"></i></a>

                            <?php if($recursoCtrl->verificaPermissaoDeletarRecurso($list->recurso_id)){?>
                            <span class="link" data-tooltip='Excluir' ><a class="deletarRecurso" data-recurso-id="<?php echo($list->recurso_id);?>"><i class='remove link icon'></i></a></span>
                            <?php } ?>

                        </td>

                    </tr>

                    <?php } ?>

                </tbody>

            </table>

            <div class="cleaner-h10"></div>

            <div align="center">
                <div class="ui buttons">
                    <a href="<?php echo(VIEW."recurso/novo-recurso/cadastrar-recurso")?>" class="ui right labeled icon yellow button" >Cadastrar Novo Recurso <i class="add circle icon"></i></a>
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

