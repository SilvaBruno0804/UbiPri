<?php
include_once("public/view/partial/checklog.php");

use app\controle\Dates;

$dataCtrl = new Dates();

?>

<html>
<head>
    <meta charset="UTF-8">
    <?php require_once("public/view/partial/includes.php"); ?>
    <title><?php echo(INITIALS_AND_TITLE) ?></title>
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
            <div class="navigation">
                <nav class="ui breadcrumb">
                    <a class="section" href="<?php echo(URLBASE); ?>">Home</a>
                    <i class="right arrow icon divider"></i>
                    <div class="active section">Listar Todos Usuários</div>
                </nav>
            </div>
        </div>
        <!--Navegação-->

        <!--Informações-->
        <div class="ui yellow segment">

            <table class="ui compact striped selectable celled table" id="dataTableLitarTodosUsuarios" >
                <thead>
                <tr>
                    <th class="one wide center aligned"></th>
                    <th class="two wide center aligned">ID</th>
                    <th class="three wide center aligned">Cod. Empresa</th>
                    <th class="four wide center aligned">Nome</th>
                    <th class="four wide center aligned">E-mail</th>
                    <th class="two wide center aligned">Ações</th>
                </tr>
                </thead>

                <tbody>



                </tbody>

            </table>

            <div class="cleaner-h10"></div>

            <div class="center aligned">
                <div class="ui buttons">
                     <a onClick="modalShowNovoUsuario()" class="ui right labeled icon orange button cursor-pointer" >Adicionar Novo Usuário <i class="add circle icon"></i></a>
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
$reloadPage = true;
include_once ('public/view/usuario/novo-usuario.php');
?>

