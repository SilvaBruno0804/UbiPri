<?php include_once("public/view/partial/checklog.php"); ?>

<?php

    use app\controle\EsferaControle;

    $esferaControle = new EsferaControle();

    $bdEsfera = $esferaControle->retorneLinhaEspecificaBaseDadosEsfera($url->getURL(4));

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
                    <a class="section" href="<?php echo(VIEW.'esfera/listar-esfera'); ?>">Listar Esferas</a>
                    <i class="right arrow icon divider"></i>
                    <div class="active section">Editar Esfera</div>
                </nav>
            </div>
        </div>
        <!--Navegação-->

        <!--Informações-->
        <div class="ui yellow segment">

            <div class='ui icon message'>
                <div class='content' >
                    <h4 class="ui dividing header">Editar Esfera</h4>

                    <form action="<?php echo(VIEW."esfera/services-esfera.php")?>"  class="ui form" name="form-esfera" id="form-esfera" method="post">

                        <div class="ui error message"></div>
                        <input type="hidden" id="form" name="form" value="editar-esfera" />
                        <input type="hidden" id="esfera-id" name="esfera-id" value="<?php echo($url->getURL(4))?>" />

                        <!--Linha 1-->
                        <div class="required fields ">

                            <!--Nome da Esfera-->
                            <div class="ten wide field">
                                <label for="nome">Nome da Instituição</label>
                                <input type="text" name="nome" id="nome" placeholder="Nome da Instituição" tabindex="1" value="<?php echo($bdEsfera[0]->nome)?>"  />
                            </div>
                            <!--Nome da Esfera-->

                            <!--Nome do Responsável-->
                            <div class="ui category search six wide field" id="searchName">
                                <label for="searchName" class="bold">Responsável</label>
                                <div class="ui left icon input">
                                    <input class="prompt" type="text" placeholder="Buscar pessoa" id="userName" name="userName" value="<?php echo($esferaControle->retornaNomeResponsavel($bdEsfera[0]->responsavel_id))?>" >
                                    <input type="hidden" name="responsavel_id" id="responsavel_id" value="<?php echo($bdEsfera[0]->responsavel_id)?>" />
                                    <i class="search icon"></i>
                                </div>
                            </div>
                            <!--Nome do Responsável-->


                        </div>
                        <!--Linha 1-->


                        <!--Linha 2-->
                        <div class="fields ">

                            <!--UF-->
                            <div class="required four wide  field">
                                <label for="estado_id">UF</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" id="estado_id" name="estado_id"  tabindex="2" value="<?php echo($bdEsfera[0]->uf_id)?>" >
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Selecione seu Estado</div>
                                    <div class="menu">
                                        <?php
                                        $sqlState = "SELECT * FROM estado WHERE uf_id != 28";
                                        $listState = $crud->listar_sql_especifico($sqlState);

                                        foreach($listState as $list){
                                            ?>
                                            <div class="item" data-value="<?php echo($list->uf_id)?>"><?php echo($list->uf_nome);?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--UF-->

                            <!--Cidade-->
                            <div class="required four wide  field">
                                <label for="cidade_id">Cidade</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" id="cidade_id" name="cidade_id"  tabindex="3" value="<?php echo($bdEsfera[0]->cidade_id)?>" >
                                    <i class="dropdown icon"></i>
                                    <div class="default text" id="loadingCity">Selecione sua Cidade</div>
                                    <div class="menu" id="menuLoadingCity">
                                        <?php
                                        if(!empty($bdEsfera[0]->uf_id)){
                                            $sqlCity = "SELECT * FROM cidade WHERE estado_uf_id = {$bdEsfera[0]->uf_id}";
                                            $listCity = $crud->listar_sql_especifico($sqlCity);
                                            foreach($listCity as $list){
                                                echo("<div class='item' data-value='{$list->cid_id}'>{$list->cid_nome}</div>");
                                            }
                                        }else{
                                            echo("<div class='item' data-value=''>Selecione primeiro o estado</div>");
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!--Cidade-->

                            <!--Endereço-->
                            <div class="required six wide field">
                                <label for="endereco">Endereço</label>
                                <input type="text" name="endereco" id="endereco" tabindex="4" value="<?php echo($bdEsfera[0]->endereco)?>" />
                            </div>
                            <!--Endereço-->

                            <!--Endereço-->
                            <div class="required two wide field">
                                <label for="numero">Número</label>
                                <input type="text" name="numero" id="numero" tabindex="5" value="<?php echo($bdEsfera[0]->numero)?>" />
                            </div>
                            <!--Endereço-->

                        </div>
                        <!--Linha 2-->

                        <!--Linha 3-->
                        <div class="fields ">

                            <!--CEP-->
                            <div class="required four wide field">
                                <label for="cep">CEP</label>
                                <input type="text" name="cep" id="cep" class="cep" tabindex="6" value="<?php echo($bdEsfera[0]->cep)?>" />
                            </div>
                            <!--CEP-->

                            <!--Bairro-->
                            <div class="required five wide field">
                                <label for="bairro">Bairro</label>
                                <input type="text" name="bairro" id="bairro" tabindex="7" value="<?php echo($bdEsfera[0]->bairro)?>" />
                            </div>
                            <!--Bairro-->

                            <!--Complemento-->
                            <div class="required nine wide field">
                                <label for="complemento">Complemento</label>
                                <input type="text" name="complemento" id="complemento"  tabindex="8" placeholder="Sala, Setor, Auditório e etc." value="<?php echo($bdEsfera[0]->complemento)?>" />
                            </div>
                            <!--Complemento-->

                        </div>
                        <!--Linha 3-->

                        <!--Linha 4-->
                        <div class="fields ">

                            <!--Email da Empresa-->
                            <div class="required  four wide field">
                                <label for="email">E-mail da Empresa</label>
                                <input type="text" name="email"  id="email" tabindex="9" placeholder="E-mail da Empresa" value="<?php echo($bdEsfera[0]->email)?>" />
                            </div>
                            <!--E-mail da Empresa-->

                            <!--Telefone da Empresa-->
                            <div class="required  three wide field">
                                <label for="telefone">Telefone da Empresa</label>
                                <input type="text" name="telefone" class="fone" id="telefone" tabindex="10" placeholder="Telefone da Empresa" value="<?php echo($bdEsfera[0]->telefone)?>" />
                            </div>
                            <!--telefone da Empresa-->

                            <!--Link-->
                            <div class="six wide field">
                                <label for="site">Site da Empresa</label>
                                <input type="text" name="site" id="site" tabindex="11" placeholder="Site, Facebook, Twitter, Google+ e Etc" value="<?php echo($bdEsfera[0]->site)?>" />
                            </div>
                            <!--Link-->

                            <!--Inscrição Estadual-->
                            <div class="required three wide field">
                                <label for="inscricao_estadual">Inscrição Estadual</label>
                                <input type="text" name="inscricao_estadual" id="inscricao_estadual"  tabindex="12"  value="<?php echo($bdEsfera[0]->inscricao_estadual)?>" />
                            </div>
                            <!--Inscrição Estadual-->

                            <!--CNPJ-->
                            <div class="required three wide field">
                                <label for="cnpj">CNPJ</label>
                                <input type="text" name="cnpj" id="cnpj" class="cnpj"  tabindex="13" placeholder="00.000.000/0001-00" value="<?php echo($bdEsfera[0]->cnpj)?>" />
                            </div>
                            <!--CNPJ-->


                        </div>
                        <!--Linha 4-->


                    </form>

                    <div class="center aligned">
                        <div class="ui buttons">
                            <a href="<?php echo(VIEW.'esfera/listar-esfera'); ?>"  class="ui left labeled icon button" >Voltar<i class="left chevron icon"></i></a>
                            <div class="or" data-text="ou"></div>
                            <button class="ui right labeled icon orange button submit" id="btn-submit" form="form-esfera">Salvar Alterações<i class="save icon"></i></button>
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

