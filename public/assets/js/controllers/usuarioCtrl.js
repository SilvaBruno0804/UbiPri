$(document).ready(function () {

    //API de Verificação de E-mail do novo usuário
    $.fn.form.settings.rules["checkEmailLoginNewUser"] = function(value) {
        if(servicesGlobal.validEmail(value)){
            return false;
        }else{
            return true;
        }
    };


    //Função que carrega cidade
    $('#estado_id').change(function () {

        var valor = $('#estado_id').val();
        var form = "loadingCity";

        $('#loadingCity').html("<div class='item' data-value=''>Carregando...</div>");

        //zera o valor inicial da cidade
        $('#cidade_id').val("");

        setTimeout(function () {
            $('#loadingCity').html("<div class='item' data-value=''>Selecione sua Cidade</div>");
            $("#menuLoadingCity").load(URLBASE + "app/services/services-global.php", {
                form: form,
                cityId: valor
            });
        }, 2000);
    });

    /*Funções que valida o Formulario do novo usuario*/
    $('#form-novo-usuario')
        .form({

            //revalidate: false,
            keyboardShortcuts: false,
            inline : true,

            onSuccess : function(e){

                e.preventDefault();

                var $form = $(e.target);
                var data  = $form.serialize();
                var url   = $form.attr('action');

                $form.addClass("loading");
                $('#btn-submit').addClass("loading disabled");

                var response = functionGlobal.ajaxGlobal(url, data);

                if(response.status){

                    if(response.reload){
                        alert(response.information);
                        location.reload();
                    }else{

                        $('#Usuario_id').val(response.id);
                        $('#userName').val(response.name);
                        $('#pes_email').val(response.email);

                        $form.removeClass("loading");
                        $('#btn-submit').removeClass("loading disabled");

                        $('#modal-novo-usuario').modal('hide');

                    }

                }else{
                    $form.removeClass("loading");
                    $('#btn-submit').removeClass("loading disabled");
                    alert(response.information);
                }

            },

            fields: {

                nome: {
                    identifier:'pes_nome',
                    rules: [
                        { type: 'empty', prompt: 'O campo nome é obrigatório' },
                        {type: 'length[10]',prompt: 'O nome deve conter no mínimo {ruleValue} caracteres'}
                    ]
                },

                email: {
                    identifier:'pes_email',
                    rules: [
                        { type: 'empty', prompt: 'Digite seu e-mail'},
                        { type: 'email', prompt: 'E-mail Inválido'},
                        { type: 'checkEmailLoginNewUser', prompt: 'Este e-mail já esta vinculado á outra conta.' }
                    ]
                },

                password: {
                    identifier: 'pes_senha',
                    rules: [
                        {type: 'empty', prompt: 'Digite sua senha'},
                        {type: 'length[6]',prompt: 'Sua senha deve conter no mínimo {ruleValue}  caracteres'}
                    ]
                },

                Pais: {
                    identifier: 'pais_id',
                    rules: [
                        { type: 'empty', prompt: 'Selecione seu Pais' }
                    ]
                },

                data_nacimento: {
                    identifier  : 'pes_data_nasc',
                    rules: [
                        { type: 'empty', prompt: 'Campo Data de Nascimento Obrigatório' },
                        { type: 'regExp[^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[12][0-9]{3}$]', prompt : 'Data de Nascimento Inválida, Ex.: 05/07/1984' }
                    ]
                },

                sexo: {
                    identifier: 'pes_sexo',
                    rules: [
                        { type: 'empty', prompt : 'Campo Sexo Obrigatório' }
                    ]
                },

                estado: {
                    identifier: 'estado_id',
                    rules: [
                        { type: 'empty', prompt : 'Campo UF é Obrigatório' }
                    ]
                },

                cidade: {
                    identifier  : 'cidade_id',
                    rules: [
                        { type   : 'empty', prompt : 'Campo Cidade é Obrigatório' }
                    ]
                },

                titulacao: {
                    identifier  : 'titulacao_id',
                    rules: [
                        { type   : 'empty', prompt : 'Campo Titulação é Obrigatório' }
                    ]
                },

                senha: {
                    identifier: 'senha',
                    rules: [
                        {type: 'empty', prompt: 'Campo Senha é Obrigatório' },
                        {type: 'minLength[6]', prompt: 'Senha deve conter no mínimo 6 caracteres' }
                    ]
                },


                senha_confirma: {
                    identifier  : 'senha_confirma',
                    rules: [
                        {type: 'empty', prompt: 'Campo Senha é Obrigatório'},
                        {type: 'minLength[6]', prompt: 'Senha deve conter no mínimo 6 caracteres'},
                        {type: 'match[senha]', prompt: 'Senha não correspondem'}
                    ]
                }

            }
        });


    /**
     * Service que carrega todos os usuários do banco de dados
     * */
    //Retorna as informações adicionais da tabela
    function formatTodosUsuarios ( d ) {
        return  '<table class="ui compact striped grey selectable celled table">'+
            '<tr><td class="three wide right aligned" > <strong> Grupo de Acesso:</strong> </td><td>'+d['grupo_acesso_nome']+'</td></tr>'+
            '<tr><td class="three wide right aligned" > <strong> Estado:</strong> </td><td>'+d['uf_nome']+'('+d['uf_sigla']+')</td></tr>'+
            '<tr><td class="three wide right aligned" > <strong> Cidade:</strong> </td><td>'+d['cid_nome']+'</td></tr>'+
            '<tr><td class="three wide right aligned" > <strong> Titulação:</strong> </td><td>'+d['tit_nome']+'</td></tr>'+
            '<tr><td class="three wide right aligned" > <strong> Esfera:</strong> </td><td>'+d['pes_id']+'</td></tr>'+
            '</table>';
    };

    //Inicializa os metodos da biblioteca DataTable
    var dt = $('#dataTableLitarTodosUsuarios').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": VIEW+"usuario/services-todos-usuario.php",
        "language": {"url": URLBASE+"app/config/datatable-lang-pt.txt"},

        "columns": [
            {
                "class":          "details-control",
                "orderable":      false,
                "data":           null,
                "defaultContent": ""
            },

            { "data": 'pes_id'  },
            { "data": 'pes_identntificacao_esfera' },
            { "data": 'pes_nome' },
            { "data": 'pes_email' , "orderable": false },
            { "data": 'pes_id' , "orderable": false }

        ],
        "order": [[1, 'asc']],
        "columnDefs": [{ className: "center aligned", "targets": [ 1,2,3,4,5 ] }]

    });

// Array para rastrear os ids dos detalhes exibidos linhas
    var detailRowsInscription = [];

    $('#dataTableLitarTodosUsuarios tbody').on( 'click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = dt.row( tr );
        var idx = $.inArray( tr.attr('id'), detailRowsInscription );

        if ( row.child.isShown() ) {
            tr.removeClass( 'details' );
            row.child.hide();
            // Remove from the 'open' array
            detailRowsInscription.splice( idx, 1 );
        }
        else {
            tr.addClass( 'details' );
            row.child( formatTodosUsuarios( row.data() ) ).show();
            // Add to the 'open' array
            if ( idx === -1 ) {
                detailRowsInscription.push( tr.attr('id') );
            }
        }
    });

// Em cada sorteio, faça um loop sobre a matriz `detailRows` e mostre quaisquer linhas filho
    dt.on( 'draw', function () {
        $.each( detailRowsInscription, function ( i, id ) {
            $('#'+id+' td.details-control').trigger( 'click' );
        } );
    });


});


/*Modal do novo cadastro*/
function modalShowNovoUsuario(){
    $('#modal-novo-usuario').modal({
        closable  : false
    }).modal('show');
}

