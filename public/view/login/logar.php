<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <?php require_once("public/view/partial/includes.php");?>

    <title><?php echo(INITIALS_AND_TITLE) ?></title>
    <script src="<?php echo(JS_CONTROLLERS) ?>loginCtrl.js" type="text/javascript"></script>
    <script src="<?php echo(JS_FILTERS) ?>filterMask.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo(CSS) ?>login.css">
</head>
<body>

<div id="login" class="ui middle aligned center aligned grid">

    <div class="column">


        <div class="ui two column middle aligned very relaxed stackable grid">

            <!--Coluna de Formulário do Login-->
            <div class="column">

                <img src="<?php echo(IMG."logo.png")?>" width="150" />


            </div>
            <!--Coluna de Formulário do Login-->

            <!--<div class="ui vertical divider">ou</div>-->

            <!--Coluna do Formulário do Novo cadastro-->
            <div class="center aligned column">

                <h4 class="ui dividing header">Faça login na sua conta</h4>

                <form class="ui form " method="post" name="formLogin" id="formLogin" action="<?php echo(VIEW . "login/processa-logar.php") ?>" >

                    <div class="ui error message"></div>

                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="email" name="pes_email" id="pes_email" placeholder="Endereço de E-mail" required tabindex="1" />
                        </div>
                    </div>

                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="pes_senha" id="pes_senha" placeholder="Digite sua senha" required tabindex="2"  />
                        </div>
                    </div>

                    <div class="ui buttons">
                        <div class="ui reset button">Cancelar</div>
                        <div class="or" data-text="ou"></div>
                        <div class="ui orange submit button" id="btn-submit" tabindex="3" >Login</div>
                    </div>

                </form>


            </div>

            <!--Coluna do Formulário do Novo cadastro-->

        </div>


    </div>


</div>

</body>
</html>


