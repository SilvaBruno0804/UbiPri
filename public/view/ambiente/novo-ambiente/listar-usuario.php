<?php
include_once("public/view/partial/checklog.php");
include_once("public/view/partial/checkEsferaAtiva.php");

use app\controle\AmbienteControle;
use app\controle\Dates;

$ambienteCtrl = new AmbienteControle();
$dataCtrl = new Dates();

$_SESSION['sessaoTempAmbienteId'] = $url->getURL(5);

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
                    <div class="active section">Listar Usuários</div>
                </nav>
            </div>
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

            <table class="ui compact striped selectable celled table" id="dadosTabelaAmbienteUsuario" >
                <thead>
                <tr>
                    <th class="two wide center aligned">ID</th>
                    <th class="four wide center aligned">Nome</th>
                    <th class="four wide center aligned">E-mail</th>
                    <th class="three wide center aligned">Dias</th>
                    <th class="two wide center aligned">Horário</th>
                    <th class="one wide center aligned">Ações</th>
                </tr>
                </thead>

                <tbody>



                </tbody>

            </table>

            <div class="cleaner-h10"></div>

            <div class="center aligned">
                <div class="ui buttons">
                    <a href="<?php echo(VIEW.'ambiente/novo-ambiente/listar-ambiente'); ?>"  class="ui left labeled icon button" >Voltar<i class="left chevron icon"></i></a>
                    <div class="or" data-text="ou"></div>
                    <a href="<?php echo(VIEW."ambiente/novo-ambiente/cadastrar-usuario")?>" class="ui right labeled icon orange button" >Adicionar Novo Usuário <i class="add circle icon"></i></a>
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

