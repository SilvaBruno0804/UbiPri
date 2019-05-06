<?php include_once("public/view/partial/checklog.php");?>

<html>
<head>
    <meta charset="UTF-8">
    <?php require_once("public/view/partial/includes.php");?>
    <title><?php echo(INITIALS_AND_TITLE) ?></title>
    <script src="<?php echo(JS_CONTROLLERS) ?>loginCtrl.js" type="text/javascript"></script>
    <script src="<?php echo(JS_FILTERS) ?>filterMask.js" type="text/javascript"></script>
</head>

<body>

    <!--Cabeçalho-->
    <?php include_once("public/view/partial/header.php");?>
    <!--Cabeçalho-->

    <!--Container-->
    <div id="container">

        <!--Menu Esquedo-->
        <?php include_once("public/view/partial/menu-esquerdo.php");?>
        <!--Menu Esquedo-->

        <!--Conteudo-->
        <div id="conteudo">

            <div class="ui segment">
                <div class="navigation">
                    <nav class="ui breadcrumb">
                        <a class="section" href="<?php echo(URLBASE); ?>">Home</a>
                        <i class="right arrow icon divider"></i>
                        <div class="active section">Painel de Controle</div>
                    </nav>
                </div>
            </div>

            <!--Informações-->
            <div class="ui yellow segment">


                <h3 align="center">Desenvolvimento de API para implementação do UbiPri em  qualquer ambiente </h3>
                <p>Uma das  funcionalidades do UbiPri é definir os perfis dos usuários, que servem para  definir limitações no uso do ambiente (o acesso ao ambiente, utilização de  computadores, utilização do ar-condicionado, etc.). O UbiPri funciona num  servidor separado do WebService, ele guarda os dados necessários para a  definição dos perfis dos usuários. <br>
                    &nbsp;&nbsp;&nbsp;  Para a obtenção dos dados dos usuários são acessados os servidores específicos  de cada ambiente, para otimizar esse algoritmo propõe-se desenvolver uma  WebService que possa ser usada por programas (como ERP) que estão sendo  utilizados nos ambientes. A comunicação com essa API poderia funcionar com o  uso de plugins, extensões, etc. <br>
                    A API  receberá requisições contendo os dados dos usuários que irão acessar o  ambiente, e posteriormente comunicando ao servidor UbiPri os dados dos usuários  que são relevantes para a definição de perfis. <br>
                    O  WebService deve: </p>
                <ul type="disc">
                    <li>Salvar os dados       das empresas/ambientes que utilizam o UbiPri</li>
                    <li>Permitir que os       administradores dos ambientes cadastrem dados básicos (nome, email, …) das       pessoas, contendo também o período que elas irão acessar o ambiente</li>
                    <li>Possibilitar aos       administradores alteração dos dados cadastrados</li>
                    <li>Possibilitar aos       administradores acessar o histórico de acesso dos usuários, assim como o       que ele fez no ambiente</li>
                    <li>Permitir que os       dispositivos que irão autenticar os usuários no ambiente (leitores RFID,       leitores Biométricos, smartphones) realizar requisições para obtenção dos       dados de acesso</li>
                    <li>Permitir aos       usuários presentes no ambiente acessar e modificar o status dos objetos       inteligentes presentes no ambiente. Por exemplo: mudar a temperaturo do       ar-condicionado, ligar TV, definir a luminosidade do ambiente, etc.</li>
                </ul>


            </div>
            <!--Informações-->

        </div>
        <!--Conteudo-->

        <div class="cleaner"></div>

    </div>
    <!--Container-->

</body>
</html>

