<?php
include_once("public/view/partial/checklog.php");
include_once("public/view/partial/checkEsferaAtiva.php");


use app\controle\RecursoControle;

$recursoCtrl = new RecursoControle();

$bdRecurso = $recursoCtrl->retorneLinhaEspecificaBaseDadosRecurso($url->getURL(5));


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
                    <a class="section" href="<?php echo(VIEW.'recurso/novo-recurso/listar-recurso'); ?>">Listar Recursos</a>
                    <i class="right arrow icon divider"></i>
                    <div class="active section">Editar Novo Recurso</div>
                </nav>
            </div>
        </div>
        <!--Navegação-->

        <!--Esfera Ativa-->
        <div class="ui warning message">
            <i class="close icon"></i>
            Esfera Ativa: <?php echo($_SESSION['esferaAtivaNome']);?>
        </div>
        <!--Esfera Ativa-->

        <!--Informações-->
        <div class="ui yellow segment">

            <div class='ui icon message'>
                <div class='content' >
                    <h4 class="ui dividing header">Editar Novo Recurso</h4>

                    <form action="<?php echo(VIEW."recurso/novo-recurso/services-recurso.php")?>"  class="ui form" name="form-novo-recurso" id="form-novo-recurso" method="post">

                        <div class="ui error message"></div>
                        <input type="hidden" id="form" name="form" value="editar-recurso" />
                        <input type="hidden" id="recurso_id" name="recurso_id" value="<?php echo($url->getURL(5))?>" />

                        <div class=" fields ">

                            <!--Nome do Recurso-->
                            <div class="required eight wide field">
                                <label for="nome">Nome</label>
                                <input type="text" name="recurso_nome" id="nome" placeholder="recurso_nome" tabindex="1" value="<?php echo($bdRecurso[0]->recurso_nome)?>"  />
                            </div>
                            <!--Nome do Recurso-->

                            <!--Ambiente-->
                            <div class="required eight wide  field">
                                <label for="Ambiente_id">Ambiente</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" id="Ambiente_id" name="Ambiente_id"  tabindex="2" value="<?php echo($bdRecurso[0]->Ambiente_id)?>" >
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Selecione o Ambiente</div>
                                    <div class="menu">
                                        <?php
                                        $sqlAmbiente = "SELECT * FROM ambiente WHERE Esfera_id = {$_SESSION['esferaAtivaId']}";
                                        $listAmbiente = $crud->listar_sql_especifico($sqlAmbiente);

                                        foreach($listAmbiente as $list){
                                            ?>
                                            <div class="item" data-value="<?php echo($list->id)?>"><?php echo($list->nome);?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--Ambiente-->

                        </div>

                        <!--Observação-->
                        <div class="fields ">
                            <div class="sixteen wide field">
                                <label for="obs">Observação</label>
                                <textarea id="recurso_obs" name="recurso_obs" tabindex="3" rows="2" ><?php echo($bdRecurso[0]->recurso_obs)?></textarea>
                            </div>
                        </div>
                        <!--Observação-->



                    </form>

                    <div class="center aligned">
                        <div class="ui buttons">
                            <a href="<?php echo(VIEW.'recurso/novo-recurso/listar-recurso'); ?>"  class="ui left labeled icon button" >Voltar<i class="left chevron icon"></i></a>
                            <div class="or" data-text="ou"></div>
                            <button class="ui right labeled icon yellow button submit" id="btn-submit" form="form-novo-recurso">Salvar<i class="save icon"></i></button>
                        </div>
                    </div>

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

