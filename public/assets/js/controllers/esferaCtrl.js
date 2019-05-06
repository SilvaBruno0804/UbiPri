$(document).ready(function () {

    /**
     * Gera a tabela listar Esfera
     * */
    //Inicializa os metodos da biblioteca DataTable
    var dtEsfera = $('#dadosTabelaEsfera').DataTable( {
        "paging":   true,
        "info":     true,
        "searching": true,
        "language": {"url": URLBASE+"app/config/datatable-lang-pt.txt"},
        "order": [[0, 'asc']],
        "columnDefs": [{ className: "center aligned", "targets": [ 0,1,2,3,4 ] }]
    });


//Função que carrega cidade
$('#estado_id').change(function () {

    var valor = $('#estado_id').val();
    var form = "loadingCity";

    $('#loadingCity').html("<div class='item' data-value=''>Carregando...</div>");

    //zera o valor inicial da cidade
    $('#cidade_cid_id').val("");

    setTimeout(function () {
        $('#loadingCity').html("<div class='item' data-value=''>Selecione sua Cidade</div>");
        $("#menuLoadingCity").load(URLBASE + "app/services/services-global.php", {
            form: form,
            cityId: valor
        });
    }, 2000);
});

    /**
     * Funções que valida o Formulario dos dados da instituição
     * */
    //API de verificação do CNPJ
    $.fn.form.settings.rules["checkCnpj"] = function(value) {
        if(value != ""){
            return servicesGlobal.checkCnpj(value);
        }else{
            return true;
        }
    };

    $('#form-esfera').form({
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

            UF: {
                identifier  : 'estado_id',
                rules: [
                    { type   : 'empty', prompt : 'Campo Estado é Obrigatório' }
                ]
            },

            Cidade: {
                identifier  : 'cidade_id',
                rules: [
                    { type   : 'empty', prompt : 'O campo Cidade é Obrigatório' }
                ]
            },

            endereco: {
                identifier  : 'endereco',
                rules: [
                    { type   : 'empty', prompt : 'O Campo Número é Obrigatório' }
                ]
            },

            Numero: {
                identifier  : 'numero',
                rules: [
                    { type   : 'empty', prompt : 'O Campo Número é Obrigatório' }
                ]
            },

            CEP: {
                identifier  : 'cep',
                rules: [
                    { type   : 'empty', prompt : 'O Campo Cep é Obrigatório' }
                ]
            },

            Bairro: {
                identifier  : 'bairro',
                rules: [
                    { type   : 'empty', prompt : 'O Campo Bairro é Obrigatório' }
                ]
            },

            Complemento: {
                identifier  : 'complemento',
                rules: [
                    { type   : 'empty', prompt : 'O Campo Complemento é Obrigatório' }
                ]
            },

            emailEmpresa: {
                identifier: 'email',
                rules: [
                    { type: 'empty', prompt: 'Digite seu e-mail'},
                    { type: 'email', prompt: 'E-mail Inválido'}
                ]
            },

            telefoneEmpresa: {
                identifier: 'telefone',
                rules: [
                    { type: 'empty', prompt: 'O Campo Telefone é Obrigatório'},
                ]
            },

            Link: {
                identifier  : 'site',
                optional   : true,
                rules: [
                    { type   : 'url', prompt : 'Link invalido, Ex.. http://www.site_da_instituicao.com.br' }
                ]
            },

            iestadual: {
                identifier  : 'inscricao_estadual',
                rules: [
                    { type   : 'empty', prompt : 'O Campo Inscrição Estadal é Obrigatório' }
                ]
            },

            cnpj: {
                identifier  : 'cnpj',
                rules: [
                    { type   : 'empty', prompt : 'O Campo CNPJ é Obrigatório' },
                    { type: 'checkCnpj', prompt: 'CNPJ inválido.' }
                ]
            }
        }
    });


    //Deletar
    $('.deletarEsfera').click(function (){
        if(functionGlobal.confirmGlobal("Tem certeza que deseja deletar esta Esfera?")){
            var url = VIEW+"esfera/services-esfera.php";
            var data = {
                form                    : "deletar-esfera",
                dataDeletarId           : $(this).attr('data-esfera-id')
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

    //Ativar
    $('.ativarEsfera').click(function (){
        if(functionGlobal.confirmGlobal("Tem certeza que deseja ativar esta Esfera?")){
            var url = VIEW+"esfera/services-esfera.php";
            var data = {
                form           : "ativar-esfera",
                dataAtivarId   : $(this).attr('data-esfera-id'),
                dataAtivarNome : $(this).attr('data-esfera-nome')
            };

            var response = functionGlobal.ajaxGlobal(url, data);
            location.reload();
        }
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
                noResults   : 'Nome pesquisado não possui cadastro no sistema.',
                logging     : 'Erro no registo de depuração, saindo.',
                noTemplate  : 'Um nome de modelo válido não foi especificado.',
                serverError : 'Houve um problema com a consultar o servidor.',
                maxResults  : 'Os resultados devem ser uma matriz para usar a configuração maxResults',
                method      : 'O método chamado não é definida.'
            },

            onSelect(result){
                $('#responsavel_id').val(result.id);
            }
        });




});