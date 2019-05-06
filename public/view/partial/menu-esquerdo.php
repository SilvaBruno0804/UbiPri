<div id="menuEsquerdo">

    <div class="ui fluid  vertical menu">
        <div class="item">
            <div class="ui input"><input type="text" placeholder="Buscar..."></div>
        </div>

        <a class="item" href="<?php echo(VIEW."esfera/listar-esfera")?>">
            <i class="building icon"></i> Esfera
        </a>

        <div class="ui dropdown item">
            Ambiente
            <i class="dropdown icon"></i>
            <div class="menu">
                <a href="<?php echo(VIEW."ambiente/tipo-ambiente/listar-tipo-ambiente")?>" class="item"><i class="exchange icon"></i>Tipo de Ambiente</a>
                <a href="<?php echo(VIEW."ambiente/novo-ambiente/listar-ambiente")?>" class="item"><i class="globe icon"></i>Ambiente</a>
            </div>
        </div>

        <div class="ui dropdown item">
            Recursos
            <i class="dropdown icon"></i>
            <div class="menu">
                <a href="<?php echo(VIEW."recurso/novo-recurso/listar-recurso")?>" class="item"><i class="grid layout icon"></i>Recursos</a>
            </div>
        </div>


        <a class="item">
            <i class="large mobile icon"></i>  Dispositivos
        </a>

        <a class="item">
            Messages
        </a>

    </div>


</div>