<?php
include_once("public/view/partial/checklog.php");
include_once("public/view/partial/checkEsferaAtiva.php");
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
                    <a class="section" href="<?php echo(VIEW.'ambiente/tipo-ambiente/listar-tipo-ambiente'); ?>">Listar Tipos de Ambientes</a>
                    <i class="right arrow icon divider"></i>
                    <div class="active section">Cadastrar Novo Tipo de Ambiente</div>
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
                    <h4 class="ui dividing header">Cadastrar Novo Tipo Ambiente</h4>

                    <form action="<?php echo(VIEW."ambiente/tipo-ambiente/services-tipo-ambiente.php")?>"  class="ui form" name="form-tipo-ambiente" id="form-tipo-ambiente" method="post">

                        <div class="ui error message"></div>
                        <input type="hidden" id="form" name="form" value="cadastrar-novo-tipo-ambiente" />
                        <input type="hidden" id="Esfera_id" name="Esfera_id" value="<?php echo($_SESSION['esferaAtivaId']);?>" />

                        <!--Nome do Ambiente-->
                        <div class="required fields ">
                            <div class="sixteen wide field">
                                <label for="nome">Nome do Tipo do Ambiente</label>
                                <input type="text" name="nome" id="nome" placeholder="Nome do Tipo do Ambiente" tabindex="1" value=""  />
                            </div>
                        </div>
                        <!--Nome do Ambiente-->

                        <!--Observação-->
                        <div class="fields ">
                            <div class="sixteen wide field">
                                <label for="obs">Observação</label>
                                <textarea id="obs" name="obs" tabindex="2" rows="2" ></textarea>
                            </div>
                        </div>
                        <!--Observação-->



                    </form>

                    <div class="center aligned">
                        <div class="ui buttons">
                            <a href="<?php echo(VIEW.'ambiente/tipo-ambiente/listar-tipo-ambiente'); ?>"  class="ui left labeled icon button" >Voltar<i class="left chevron icon"></i></a>
                            <div class="or" data-text="ou"></div>
                            <button class="ui right labeled icon orange button submit" id="btn-submit" form="form-tipo-ambiente">Salvar<i class="save icon"></i></button>
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

