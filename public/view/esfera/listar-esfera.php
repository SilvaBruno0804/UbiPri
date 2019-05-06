<?php include_once("public/view/partial/checklog.php"); ?>

<?php

use app\controle\EsferaControle;
$esferaControle = new EsferaControle();

?>

<html>
<head>
    <meta charset="UTF-8">
    <?php require_once("public/view/partial/includes.php"); ?>
    <title><?php echo(INITIALS_AND_TITLE) ?></title>
    <script src="<?php echo(JS_CONTROLLERS) ?>esferaCtrl.js" type="text/javascript"></script>
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
                    <div class="active section">Listar Esferas</div>
                </nav>
            </div>
        </div>
        <!--Navegação-->

        <!--Informações-->
        <div class="ui yellow segment">

            <table class="ui compact striped selectable celled table" id="dadosTabelaEsfera" >
                <thead>
                <tr>
                    <th class="two wide center aligned">ID</th>
                    <th class="four wide center aligned">Nome da Esfera</th>
                    <th class="four wide center aligned">Responsável</th>
                    <th class="four wide center aligned">E-mail</th>
                    <th class="two wide center aligned">Ações</th>
                </tr>
                </thead>

                <tbody>

                    <?php
                    $sqlEsfera = "SELECT * FROM esfera";
                    $bdEsfera = $crud->listar_sql_especifico($sqlEsfera);
                    foreach($bdEsfera as $list){
                        $actionColor = $_SESSION['esferaAtivaId']==$list->id ? '<i class="toggle on green link icon"></i>' : '<i class="toggle off red link icon"></i>';
                    ?>

                    <tr>
                        <td><?php echo($list->id);?></td>
                        <td><?php echo($list->nome);?></td>
                        <td><?php echo($esferaControle->retornaNomeResponsavel($list->responsavel_id));?></td>
                        <td><?php echo($list->email);?></td>
                        <td>

                            <i class="street view link icon"></i>

                            <a href="<?php echo(VIEW."esfera/editar-esfera/".$list->id);?>" ><i class="edit black icon"></i></a>

                            <?php if($esferaControle->verificaPermissaoDeletar($list->id)){?>
                                <span class="link" data-tooltip='Excluir' ><a class="deletarEsfera" data-esfera-id="<?php echo($list->id);?>"><i class='remove link icon'></i></a></span>
                            <?php } ?>

                            <span class="link" data-tooltip='Ativar Esfera' ><a class="ativarEsfera" data-esfera-id="<?php echo($list->id);?>" data-esfera-nome="<?php echo($list->nome);?>"><?php echo($actionColor);?></a></span>

                        </td>
                    </tr>

                    <?php } ?>

                </tbody>

            </table>

            <div class="cleaner-h10"></div>

            <div align="center">
                <div class="ui buttons">
                    <a href="<?php echo(VIEW."esfera/cadastrar-esfera")?>" class="ui right labeled icon orange button" >Cadastrar Nova Esfera <i class="add circle icon"></i></a>
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

