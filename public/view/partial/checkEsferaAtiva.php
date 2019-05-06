<?php
 if(empty($_SESSION['esferaAtivaId'])){
    $site_retorno = VIEW . "esfera/listar-esfera";
     $menssagem = "Para acessar esta funcionalidade é obrigatório ativar a Esfera";
     echo "
            <META HTTP-EQUIV=REFRESH CONTENT='0; URL=$site_retorno'>
            <script type=\"text/javascript\">
            alert(\"$menssagem.\");
            </script> ";
    exit;
}