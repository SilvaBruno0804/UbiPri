<?php
include_once("public/view/partial/checklog.php");
include_once("public/view/partial/checkEsferaAtiva.php");

use app\controle\AmbienteControle;

$ambienteCtrl = new AmbienteControle();

$bdEditarUsuario = $ambienteCtrl->retorneLinhaEspecificaBaseDadosPessoaAmbiente($url->getURL(5));

?>

<html>
<head>
    <meta charset="UTF-8">
    <?php require_once("public/view/partial/includes.php"); ?>
    <title><?php echo(INITIALS_AND_TITLE) ?></title>
    <script src="<?php echo(JS_CONTROLLERS) ?>ambienteCtrl.js" type="text/javascript"></script>
    <script src="<?php echo(JS_CONTROLLERS) ?>usuarioCtrl.js" type="text/javascript"></script>
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
            <a class="navigation">
                <nav class="ui breadcrumb">
                    <a class="section" href="<?php echo(URLBASE); ?>">Home</a>
                    <i class="right arrow icon divider"></i>
                    <a class="section" href="<?php echo(VIEW.'ambiente/novo-ambiente/listar-ambiente'); ?>">Listar Ambientes</a>
                    <i class="right arrow icon divider"></i>
                    <a class="section" href="<?php echo(VIEW.'ambiente/novo-ambiente/listar-usuario/'.$_SESSION['sessaoTempAmbienteId']); ?>">Listar Usuários</a>
                    <i class="right arrow icon divider"></i>
                    <div class="active section">Cadastrar Usuários</div>
                </nav>
        </div>
        <!--Navegação-->

        <!--Esfera Ativa-->
        <div class="ui warning  message">
            <i class="close icon"></i>
            Esfera Ativa: <?php echo($_SESSION['esferaAtivaNome']);?><br/>
            Ambiente: <?php echo($crud->return_dado_bd('ambiente', 'id', $_SESSION['sessaoTempAmbienteId'], "nome"));?>
        </div>
        <!--Esfera Ativa-->

        <!--Informações-->
        <div class="ui yellow segment">

            <div class='ui icon message'>
                <div class='content' >
                    <h4 class="ui dividing header">Cadastrar Novo Usuário no Ambiente</h4>

                    <form action="<?php echo(VIEW."ambiente/novo-ambiente/services-ambiente.php")?>"  class="ui form" name="form-cadastrar-usuario-ambiente" id="form-cadastrar-usuario-ambiente" method="post">

                        <div class="ui error message"></div>
                        <input type="hidden" id="form" name="form" value="editar-usuario-ambiente" />
                        <input type="hidden" id="Ambiente_id" name="Ambiente_id" value="<?php echo($_SESSION['sessaoTempAmbienteId']);?>" />
                        <input type="hidden" id="pessoa_ambiente_id" name="pessoa_ambiente_id" value="<?php echo($url->getURL(5));?>" />

                        <!--Linha 1-->
                        <div class="required fields ">

                            <!--Nome do Usuário-->
                            <div class="ui  category search six wide field" id="searchName">
                                <label for="searchName" class="bold">Usuário</label>
                                <div class="ui left icon input">
                                    <input class="prompt" type="text" placeholder="Buscar pessoa" id="userName" name="userName" value="<?php echo($bdEditarUsuario[0]->pes_nome)?>" >
                                    <i class="search icon"></i>
                                </div>
                            </div>
                            <!--Nome do Usuário-->

                            <!--Codigo do Usuário-->
                            <div class="required two wide field">
                                <label for="nome">Código do Usuário</label>
                                <input type="text" name="Usuario_id" id="Usuario_id"  value="<?php echo($bdEditarUsuario[0]->pes_id)?>" readonly  />
                            </div>
                            <!--Codigo do Usuário-->

                            <!--Codigo do Usuário-->
                            <div class="required four wide field">
                                <label for="nome">E-mail do Usuário</label>
                                <input type="text" name="pes_email" id="pes_email"  value="<?php echo($bdEditarUsuario[0]->pes_email)?>" readonly  />
                            </div>
                            <!--Codigo do Usuário-->

                        </div>
                        <!--Linha 1-->

                        <!--Linha 2-->
                        <div class="required fields ">

                            <!--Dias da semana-->
                            <div class="ten wide field">
                                <label for="dias_semana">Dias da Semana</label>
                                <div class="ui fluid search multiple  selection dropdown">
                                    <input type="hidden" id="dias_semana" name="dias_semana"  tabindex="2" value="<?php echo($bdEditarUsuario[0]->dias_semana)?>" >
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Selecione os dias da semana</div>
                                    <div class="menu">
                                        <?php
                                        $sqlSemana = "SELECT * FROM semana";
                                        $listSemana = $crud->listar_sql_especifico($sqlSemana);

                                        foreach($listSemana as $list){
                                            ?>
                                            <div class="item" data-value="<?php echo($list->semana_id)?>"><?php echo($list->semana_nome);?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--Dias da semana-->

                            <!--Hora Inicio-->
                            <div class="required two wide field">
                                <label for="nome">Hora Inicio</label>
                                <input type="text" name="hora_inicio" id="hora_inicio" class="hour" placeholder="00:00" tabindex="3" value="<?php echo($bdEditarUsuario[0]->hora_inicio)?>"  />
                            </div>
                            <!--Hora Inicio-->

                            <!--Hora Inicio-->
                            <div class="required two wide field">
                                <label for="nome">Hora Final</label>
                                <input type="text" name="hora_fim" id="hora_fim" class="hour" placeholder="00:00"  tabindex="4" value="<?php echo($bdEditarUsuario[0]->hora_fim)?>"  />
                            </div>
                            <!--Hora Inicio-->


                        </div>
                        <!--Linha 2-->

                        <!--Observação-->
                        <div class="fields ">
                            <div class="sixteen wide field">
                                <label for="pessoa_ambiente_obs">Observação</label>
                                <textarea id="pessoa_ambiente_obs" name="pessoa_ambiente_obs" tabindex="5" rows="2" ><?php echo($bdEditarUsuario[0]->pessoa_ambiente_obs)?></textarea>
                            </div>
                        </div>
                        <!--Observação-->



                    </form>

                    <div class="center aligned">
                        <div class="ui buttons">
                            <a href="<?php echo(VIEW.'ambiente/novo-ambiente/listar-usuario/'.$_SESSION['sessaoTempAmbienteId']); ?>"  class="ui left labeled icon button" >Voltar<i class="left chevron icon"></i></a>
                            <div class="or" data-text="ou"></div>
                            <button class="ui right labeled icon orange button submit" id="btn-submit" form="form-cadastrar-usuario-ambiente">Salvar<i class="save icon"></i></button>
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

<?php
$reloadPage = false;
include_once ('public/view/usuario/novo-usuario.php');
?>
