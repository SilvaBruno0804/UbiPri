/**
 * TIPO DE AMBIENTE
 * *********************************************************************************************************************/
$(document).ready(function () {

    /**
     * Gera a tabela listar Tipo de Ambiente
     * */
    //Inicializa os metodos da biblioteca DataTable
    var dtEsfera = $('#dadosTabelaTipoAmbiente').DataTable( {
        "paging":   true,
        "info":     true,
        "searching": true,
        "language": {"url": URLBASE+"app/config/datatable-lang-pt.txt"},
        "order": [[0, 'asc']],
        "columnDefs": [{ className: "center aligned", "targets": [ 0,1,2,3 ] }]
    });


    $('#form-tipo-ambiente').form({
        //inline : true,
        onSuccess: function (e) {

            e.preventDefault();
            var $form = $(e.target);
            var data  = $form.serialize();
            var url = $form.attr('action');

            $form.addClass("loading");
            $('#btn-submit').addClass("loading disabled");

            var response = functionGlobal.ajaxGlobal(url, data);

            if(response.status){
                alert(response.information);
                location.href=response.site;
            }else{
                $form.removeClass("loading");
                $('#btn-submit').removeClass("loading disabled");
                alert(response.information);
                return false;
            }

        },
        fields: {
            nome: {
                identifier  : 'nome',
                rules: [
                    {type: 'empty', prompt : 'Campo nome é obrigatório' },
                    {type: 'maxLength[50]', prompt : 'Digite no máximo 50 caracteres'}
                ]
            },

        }
    });

    //Deletar
    $('.deletarTipoAmbiente').click(function (){
        if(functionGlobal.confirmGlobal("Tem certeza que deseja deletar este tipo de ambiente?")){
            var url = VIEW+"ambiente/tipo-ambiente/services-tipo-ambiente.php";
            var data = {
                form                    : "deletar-tipo-ambiente",
                dataDeletarTipoAmbiente : $(this).attr('data-tipo-ambiente-id')
            };

            var response = functionGlobal.ajaxGlobal(url, data);

            if(response.status){
                alert(response.information);
                location.reload();
            }else{
                alert(response.information);
            }
        }
    });

});

/**
 * AMBIENTE
 * *********************************************************************************************************************/
$(document).ready(function () {

    /**
     * Gera a tabela listar Ambiente
     * */
        //Inicializa os metodos da biblioteca DataTable
    var dtEsfera = $('#dadosTabelaAmbiente').DataTable( {
        "paging":   true,
        "info":     true,
        "searching": true,
        "language": {"url": URLBASE+"app/config/datatable-lang-pt.txt"},
        "order": [[0, 'asc']],
        "columnDefs": [{ className: "center aligned", "targets": [ 0,1,2,3,4,5 ] }]
    });


    $('#form-novo-ambiente').form({
        //inline : true,
        onSuccess: function (e) {

            e.preventDefault();
            var $form = $(e.target);
            var data  = $form.serialize();
            var url = $form.attr('action');

            $form.addClass("loading");
            $('#btn-submit').addClass("loading disabled");

            var response = functionGlobal.ajaxGlobal(url, data);

            if(response.status){
                alert(response.information);
                location.href=response.site;
            }else{
                $form.removeClass("loading");
                $('#btn-submit').removeClass("loading disabled");
                alert(response.information);
                return false;
            }

        },
        fields: {
            nome: {
                identifier  : 'nome',
                rules: [
                    {type: 'empty', prompt : 'Campo nome é obrigatório' },
                    {type: 'maxLength[50]', prompt : 'Digite no máximo 50 caracteres'}
                ]
            },

            tipo: {
                identifier  : 'TipoAmbiente_id',
                rules: [{type: 'empty', prompt : 'Campo Tipo de Ambiente é obrigatório' }]
            },

        }
    });

    //Deletar
    $('.deletarAmbiente').click(function (){
        if(functionGlobal.confirmGlobal("Tem certeza que deseja deletar este ambiente?")){
            var url = VIEW+"ambiente/novo-ambiente/services-ambiente.php";
            var data = {
                form                    : "deletar-ambiente",
                dataDeletarAmbiente : $(this).attr('data-ambiente-id')
            };

            var response = functionGlobal.ajaxGlobal(url, data);

            if(response.status){
                alert(response.information);
                location.reload();
            }else{
                alert(response.information);
            }

        }
    });




});

/**
 * Usuário
 * *********************************************************************************************************************/

$(document).ready(function () {

    //Inicializa os metodos da biblioteca DataTable
    var dt = $('#dadosTabelaAmbienteUsuario').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": VIEW+"ambiente/novo-ambiente/services-usuario-ambiente.php",
        "language": {"url": URLBASE+"app/config/datatable-lang-pt.txt"},

        "columns": [
            { "data": 'pessoa_ambiente_id'  },
            { "data": 'pes_nome' },
            { "data": 'pes_email' , "orderable": false },
            { "data": 'dias_formtadas' },
            { "data": 'horas_formtadas' , "orderable": false },
            { "data": 'acoes' , "orderable": false }
        ],
        "order": [[0, 'asc']],
        "columnDefs": [{ className: "center aligned", "targets": [ 0,1,2,3,4,5] }]
    });

    $('#searchName')
        .search({
            apiSettings: {
                url: URLBASE + "app/services/services-global.php?q={query}&form=searchPersonGlobal",
                searchFullText: false
            },
            fields: {
                results :     'pessoas',
                title   :     'nome',
                description : 'descricao',
                image: 'img'
            },
            minCharacters : 3,
            maxResults: 10,
            cache: false,
            searchFullText: false,

            error : {
                source      : 'Não é possível pesquisar. Nenhuma fonte usado, eo módulo semântico API não foi incluído',
                noResults   : 'Nome pesquisado não possui cadastro no sistema.<br/><a class="cursor-pointer" onClick="modalShowNovoUsuario()" ><i class="large add green user icon disabled"></i>  Clique Aqui e cadastre um novo usuário.</a> ',
                logging     : 'Erro no registo de depuração, saindo.',
                noTemplate  : 'Um nome de modelo válido não foi especificado.',
                serverError : 'Houve um problema com a consultar o servidor.',
                maxResults  : 'Os resultados devem ser uma matriz para usar a configuração maxResults',
                method      : 'O método chamado não é definida.'
            },

            onSelect(result){
                $('#Usuario_id').val(result.id);
                $('#pes_email').val(result.email);
            }
        });


    $('#form-cadastrar-usuario-ambiente').form({
        //inline : true,
        onSuccess: function (e) {

            e.preventDefault();
            var $form = $(e.target);
            var data  = $form.serialize();
            var url = $form.attr('action');

            $form.addClass("loading");
            $('#btn-submit').addClass("loading disabled");

            var response = functionGlobal.ajaxGlobal(url, data);

            if(response.status){
                alert(response.information);
                location.href=response.site;
            }else{
                $form.removeClass("loading");
                $('#btn-submit').removeClass("loading disabled");
                alert(response.information);
                return false;
            }

        },
        fields: {
            nome: {
                identifier  : 'userName',
                rules: [
                    {type: 'empty', prompt : 'Campo nome é obrigatório' },
                    {type: 'maxLength[50]', prompt : 'Digite no máximo 50 caracteres'}
                ]
            },

            codigoUsuario: {
                identifier  : 'Usuario_id',
                rules: [
                    {type: 'empty', prompt : 'O código do usuário é obrigatório, selecione o nome no campo usuário que será preenchido automaticamente' }
                ]
            },

            email: {
                identifier  : 'pes_email',
                rules: [{type: 'empty', prompt : 'O e-mail do usuário é obrigatório, selecione o nome no campo usuário que será preenchido automaticamente' }]
            },

            dias: {
                identifier  : 'dias_semana',
                rules: [{type: 'empty', prompt : 'Selecione os dias que o usuário terá acesso a este ambiente' }]
            },

            hInicio: {
                identifier: 'hora_inicio',
                rules: [
                    {type: 'empty', prompt: 'Campo Hora Inicio é Obrigatório'},
                    {type: 'regExp[^([01]?[0-9]|2[0-3]):[0-5][0-9]$]', prompt: 'Hora Inicio Inválida'}
                ]
            },

            hFinal: {
                identifier: 'hora_fim',
                rules: [
                    {type: 'empty', prompt: 'Campo Hora Final é Obrigatório'},
                    {type: 'regExp[^([01]?[0-9]|2[0-3]):[0-5][0-9]$]', prompt: 'Hora Final Inválida'}
                ]
            },


        }
    });


});

/**
 * Deletar usuario do ambiente
 * @param $id referencia o pessoa_ambiente_id da tabela do banco de dados pessoa_ambiente
 * */
function modalDeletarUsuarioAmbiente($id){
    if(functionGlobal.confirmGlobal("Tem certeza que deseja deletar este ambiente?")){
        var url = VIEW+"ambiente/novo-ambiente/services-ambiente.php";
        var data = {
            form                    : "deletar-usuario-ambiente",
            dataUsuarioAmbiente     : $id
        };

        var response = functionGlobal.ajaxGlobal(url, data);

        if(response.status){
            alert(response.information);
            location.reload();
        }else{
            alert(response.information);
        }
    }
}



