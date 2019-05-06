<div class="ui small  top attached menu">
<div class="item">
    <img src="<?php echo(IMG."logo.png")?>" alt="Ubipri" title="Ubipri" />
    </div>
    <a class="item" href="<?php echo(URLBASE);?>"> <i class="large home icon"></i> Home </a>

    <!--Usuários-->
    <div class="ui dropdown item">
        <i class="users  large icon"></i> &nbsp;Usuários <i class="dropdown icon"></i>
        <div class="menu">


            <div class="item">
                <i class="dropdown icon"></i>
                <span class="text"><i class="unordered list icon"></i> Listas </span>
                <div class="menu">
                    <a class="item"><i class="large users icon"></i>Todos Usuários da Esfera Ativa</a>
                    <a href="<?php echo(VIEW."usuario/listar-todos-usuario");?>" class="item"><i class="large users icon"></i>Todos Usuários</a>
                </div>
            </div>


        </div>
    </div>
    <!--Usuários-->

    <!--Meu Perfil-->
    <div class="ui dropdown item">
        <i class="Grid Edit large icon"></i>&nbsp;Meu Perfil<i class="dropdown icon"></i>
        <div class="menu">
            <a href="" class="item"><i class="edit icon"></i>Editar Perfil </a>
            <a href="" class="item"><i class="history icon"></i>Histórico</a>
        </div>
    </div>
    <!--Meu Perfil-->


    <a class="item"><i class="large settings icon"></i> Configurações</a>

    <div class="right menu">

        <a class="item">
            <img class="ui  circular image" width="32" height="32" src="<?php echo(IMG."users/".$crud->return_dado_bd("pessoa", 'pes_id', $_SESSION['user_id'], 'pes_foto' ));?>">
        </a>

        <a class="item">
            <i class="alarm red icon"></i> 23
        </a>

        <a class="item" href="<?php echo(VIEW . 'login/sair');?>" >
            <i class="Unlock Alternate large icon"></i>
        </a>

    </div>

</div>


