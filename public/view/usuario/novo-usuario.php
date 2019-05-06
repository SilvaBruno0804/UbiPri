<div class="ui modal" id="modal-novo-usuario"> <i class="close icon"></i>

    <div class="header"> Novo Usuário </div>

    <div class="content">

        <form action="<?php echo(VIEW . "usuario/services-usuario.php") ?>" method="post" name="form-novo-usuario" id="form-novo-usuario" class="ui form" autocomplete="off" >

            <div class="ui error message"></div>
            <input type="hidden" id="form" name="form" value="novo-usuario"/>
            <input type="hidden" id="Esfera_id" name="Esfera_id" value="<?php echo($_SESSION['esferaAtivaId']);?>" />
            <input type="hidden" id="reload" name="reload" value="<?php echo($reloadPage);?>" />

            <!--Linha 1-->
            <div class="fields">

                <!--Nome-->
                <div class="required six wide field">
                    <label for="pes_nome">Nome</label>
                    <input type="text" name="pes_nome" id="pes_nome" placeholder="Digite seu nome" tabindex="1"  />
                </div>
                <!--Nome-->

                <!--Email-->
                <div class="required six wide field">
                    <label for="pes_email">E-mail</label>
                    <input type="text" name="pes_email" id="pes_email" placeholder="Digite seu E-mail" tabindex="2" />
                </div>
                <!--Email-->

                <!--Nome-->
                <div class="four wide field">
                    <label for="pes_identntificacao_esfera">Codigo Empresa</label>
                    <input type="text" name="pes_identntificacao_esfera" id="pes_identntificacao_esfera" placeholder="Codigo Identificador" tabindex="3"  />
                </div>
                <!--Nome-->

            </div>
            <!--Linha 1-->

            <!--Linha 2-->
            <div class="fields">

                <!--UF-->
                <div class="required five wide  field">
                    <label for="estado_id">UF</label>
                    <div class="ui fluid search selection dropdown">
                        <input type="hidden" id="estado_id" name="estado_id"  tabindex="4" value="" >
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
                        <input type="hidden" id="cidade_id" name="cidade_id"  tabindex="5" value="" >
                        <i class="dropdown icon"></i>
                        <div class="default text" id="loadingCity">Selecione sua Cidade</div>
                        <div class="menu" id="menuLoadingCity">
                            <?php
                            if(!empty($bdPersonInfoCompany[0]->estado_id)){
                                $sqlCity = "SELECT * FROM cidade WHERE estado_uf_id = {$bdPersonInfoCompany[0]->estado_id}";
                                $listCity = $crud->listar_sql_especifico($sqlCity);
                                foreach($listCity as $list){
                                    echo("<div class='item' data-value='{$list->cid_id}'>{$list->cid_nome}</div>");
                                }
                            }else{
                                echo("<div class='item' data-value=''>Selecione primeiro o UF</div>");
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!--Cidade-->

                <!--Data de Nascimento-->
                <div class="required three wide field">
                    <label for="pes_data_nasc">Data de Nascimento</label>
                    <input type="text" class="date" name="pes_data_nasc" id="pes_data_nasc"   placeholder="Dia/Mês/Ano" tabindex="6"  />
                </div>
                <!--Data de Nascimento-->

                <!--Sexo-->
                <div class="required three wide field">
                    <label for="pes_sexo">Sexo</label>
                    <div class="ui selection dropdown">
                        <input type="hidden" id="pes_sexo" name="pes_sexo" tabindex="6">
                        <i class="dropdown icon"></i>
                        <div class="default text">Selecione seu Sexo</div>
                        <div class="menu">
                            <div class="item" data-value="M" data-text="Masculino"><i class="male icon"></i>Masculino</div>
                            <div class="item" data-value="F" data-text="Feminino"><i class="female icon"></i>Feminino</div>
                        </div>
                    </div>
                </div>
                <!--Sexo-->

                </div>
                <!--Linha 2-->

                <!--Linha 3-->
                <div class="fields">

                    <!--Instituição-->
                    <div class="eight wide field">
                        <label for="pes_instituicao">Instituição</label>
                        <input type="text" name="pes_instituicao" id="pes_instituicao" placeholder="Escreva sua Instituição" tabindex="7"  />
                    </div>
                    <!--Instituição-->

                    <!--Titulação-->
                    <div class="eight wide field">
                        <label for="titulacao_id">Titulação</label>
                        <select class="ui fluid  dropdown" id="titulacao_id" name="titulacao_id"  tabindex="8" >
                            <option value="" >Selecione sua Titulação</option>
                            <?php
                            $sql = "SELECT * FROM titulacao";
                            $listarTitulacao = $crud->listar_sql_especifico($sql);

                            foreach ($listarTitulacao as $listar) {
                                ?>
                                <option value="<?php echo($listar->tit_id) ?>" ><?php echo($listar->tit_nome); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!--Titulação-->

                </div>
                <!--Linha 3-->

                <!--Linha 4-->
                <div class="fields">

                    <!--Senha-->
                    <div class="required eight wide field">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Senha deve conter no minímo 6 caracteres" tabindex="9"   />
                    </div>
                    <!--Senha-->

                    <!--Confirme Senha-->
                    <div class="required eight wide field">
                        <label for="senha_confirma">Confirme sua Senha</label>
                        <input type="password" name="senha_confirma" id="senha_confirma" placeholder="Senha deve conter no minímo 6 caracteres" tabindex="10"  />
                    </div>
                    <!--Confirme Senha-->

                </div>
                <!--Linha 4-->


                </form>

                </div>

    <div class="actions">
        <div class="ui black deny button"> Cancelar </div>
        <button class="ui right labeled icon submit green button" id="btn-submit" form="form-novo-usuario">Salvar <i class="save icon"></i></button>
    </div>
</div>
