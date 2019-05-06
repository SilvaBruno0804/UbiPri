<?php
include_once("public/view/partial/checklog.php");
include_once("public/view/partial/checkEsferaAtiva.php");

use app\controle\AmbienteControle;

$ambienteCtrl = new AmbienteControle();

$bdAmbiente = $ambienteCtrl->retorneLinhaEspecificaBaseDadosAmbiente($url->getURL(5));

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
                    <a class="section" href="<?php echo(VIEW.'ambiente/novo-ambiente/listar-ambiente'); ?>">Listar Ambientes</a>
                    <i class="right arrow icon divider"></i>
                    <div class="active section">Editar Ambiente</div>
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
                    <h4 class="ui dividing header">Editar Ambiente</h4>

                    <form action="<?php echo(VIEW."ambiente/novo-ambiente/services-ambiente.php")?>"  class="ui form" name="form-novo-ambiente" id="form-novo-ambiente" method="post">

                        <div class="ui error message"></div>
                        <input type="hidden" id="form" name="form" value="editar-ambiente" />
                        <input type="hidden" id="Esfera_id" name="Esfera_id" value="<?php echo($_SESSION['esferaAtivaId']);?>" />
                        <input type="hidden" id="ambiente-id" name="ambiente-id" value="<?php echo($url->getURL(5))?>" />

                        <!--Nome do Ambiente-->
                        <div class=" fields ">
                            <div class="required sixteen wide field">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="nome" placeholder="Nome" tabindex="1" value="<?php echo($bdAmbiente[0]->nome)?>"  />
                            </div>
                        </div>
                        <!--Nome do Ambiente-->

                        <div class=" fields ">

                            <!--Tipo de ambiente-->
                            <div class="eight wide required  field">
                                <label for="TipoAmbiente_id">Tipo de Ambiente</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" id="TipoAmbiente_id" name="TipoAmbiente_id"  tabindex="2" value="<?php echo($bdAmbiente[0]->TipoAmbiente_id)?>" >
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Tipo de Ambiente</div>
                                    <div class="menu">
                                        <?php
                                        $sqlTipoAmbiente = "SELECT * FROM tipoambiente WHERE Esfera_id = {$_SESSION['esferaAtivaId']}";
                                        $listTipoAmbiente = $crud->listar_sql_especifico($sqlTipoAmbiente);

                                        foreach($listTipoAmbiente as $list){
                                            ?>
                                            <div class="item" data-value="<?php echo($list->id)?>"><?php echo($list->nome);?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--Tipo de ambiente-->

                            <!--Ambiente Pai-->
                            <div class="eight wide  field">
                                <label for="AmbientePai_id">Ambiente Pai</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" id="AmbientePai_id" name="AmbientePai_id"  tabindex="3" value="<?php echo($bdAmbiente[0]->AmbientePai_id)?>" >
                                    <i class="dropdown icon"></i>
                                    <div class="default text"></div>
                                    <div class="menu">
                                        <div class="item" data-value=""></div>
                                        <?php
                                        $sqlAmbientePai = "SELECT * FROM ambiente WHERE Esfera_id = {$_SESSION['esferaAtivaId']}";
                                        $listAmbientePai = $crud->listar_sql_especifico($sqlAmbientePai);

                                        foreach($listAmbientePai as $list){
                                            ?>
                                            <div class="item" data-value="<?php echo($list->id)?>"><?php echo($list->nome);?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--Ambiente Pai-->

                        </div>

                        <!--Observação-->
                        <div class="fields ">
                            <div class="sixteen wide field">
                                <label for="obs">Observação</label>
                                <textarea id="obs" name="obs" tabindex="4" rows="2" ><?php echo($bdAmbiente[0]->obs)?></textarea>
                            </div>
                        </div>
                        <!--Observação-->



                    </form>

                    <div class="center aligned">
                        <div class="ui buttons">
                            <a href="<?php echo(VIEW.'ambiente/novo-ambiente/listar-ambiente'); ?>"  class="ui left labeled icon button" >Voltar<i class="left chevron icon"></i></a>
                            <div class="or" data-text="ou"></div>
                            <button class="ui right labeled icon orange button submit" id="btn-submit" form="form-novo-ambiente">Salvar Alterações<i class="save icon"></i></button>
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

