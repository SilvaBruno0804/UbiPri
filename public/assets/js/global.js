//Funcão Fabrica da "Classe" functionGlobal
var functionGlobal = (function () {

    //Metodo Global de Confirme
    var _confirmGlobal = function (text) {
        var decision = confirm(text);
        if (decision) {
            response = true;
        } else {
            response = false;
        }
        return response;
    };

    //Metodo Ajax com retorno com os dados do php
    var _ajaxGlobal = function (url, data) {

        var returnA = $.ajax({
            type: 'POST',
            dataType: 'json',
            url: url,
            async: false,
            data: data,
            success: function (scope) {
                finalReturn = scope;
            },
            error: function (scope) {
                alert("Pagina temporáriamente indisponivel, tente novamente mais tarde.");
                console.log(scope);
                finalReturn = false;
            }

        });

        return finalReturn;
    };
    //Metodo Ajax com retorno com os dados do php

    //Metod Ajax com retorno com os dados do php + input file
    var _ajaxSubmitGlobal = function (form, url, data) {

        $('#' + form).ajaxSubmit({
            type: 'POST',
            dataType: 'json',
            url: url,
            data: data,
            async: false,
            success: function (scope) {
                finalReturn = scope;
            },
            error: function (scope) {
                lert("Pagina temporáriamente indisponivel, tente novamente mais tarde.");
                console.log(scope);
                finalReturn = scope;
            }
        });

        return finalReturn;
    };
    //Metod Ajax com retorno com os dados do php + input file
    
    //Metodo Generico de envio de E-mail
    var _ajaxSendEmail = function (url, id) {
        
        if(_confirmGlobal("Tem certeza que deseja enviar este e-mail?")){
            var data = { id: id };
            var response = _ajaxGlobal(url, data);
            if(response.status){
                alert(response.information);
            }else{
                alert('Erro ao enviar o e-mail, tente novamento e caso o erro persista entre em contato com a comissão organizadora');
            }
        }
        
    };
    //Metodo Generico de envio de E-mail
    
    return{
        confirmGlobal: _confirmGlobal,
        ajaxGlobal: _ajaxGlobal,
        ajaxSubmitGlobal: _ajaxSubmitGlobal,
        ajaxSendEmail: _ajaxSendEmail
    };

})();


//Inicio Global das Funções do Framework Semantic UI
$(document).ready(function () {

    $('.ui.radio.checkbox').checkbox();
    $('.ui.toggle.checkbox').checkbox();
    $('select.dropdown').dropdown();
    $('.ui.dropdown').dropdown();
    $('.globalPopUp').popup();
    $('.loading').progress({percent: 0});
    $('.dropdownAddDinamic').dropdown({allowAdditions: true});
    $('.ui.checkbox').checkbox();
    
    $('.ui.accordion').accordion();

    $('.message .close')
        .on('click', function () {
            $(this).closest('.message').transition('fade');
    });


});
//Iniciar Funções do Semantic
