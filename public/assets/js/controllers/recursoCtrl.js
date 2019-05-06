/**
 * Novo Recurso
 * *********************************************************************************************************************/
$(document).ready(function () {

    /**
     * Gera a tabela listar Recursos
     * */
    //Inicializa os metodos da biblioteca DataTable
    var dtEsfera = $('#dadosTabelaNovoRecurso').DataTable( {
        "paging":   true,
        "info":     true,
        "searching": true,
        "language": {"url": URLBASE+"app/config/datatable-lang-pt.txt"},
        "order": [[0, 'asc']],
        "columnDefs": [{ className: "center aligned", "targets": [ 0,1,2,3 ] }]
    });


    $('#form-novo-recurso').form({
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
                identifier  : 'recurso_nome',
                rules: [
                    {type: 'empty', prompt : 'Campo nome é obrigatório' },
                    {type: 'maxLength[200]', prompt : 'Digite no máximo 200 caracteres'}
                ]
            },

            ambiente: {
                identifier  : 'Ambiente_id',
                rules: [{type: 'empty', prompt : 'Campo Ambiente é obrigatório' }]
            },

        }
    });

    //Deletar
    $('.deletarRecurso').click(function (){
        if(functionGlobal.confirmGlobal("Tem certeza que deseja deletar este recurso?")){
            var url = VIEW+"recurso/novo-recurso/services-recurso.php";
            var data = {
                form                    : "deletar-recurso",
                dataDeletarRecursoId : $(this).attr('data-recurso-id')
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