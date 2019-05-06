/* global servicesGlobal, functionGlobal */

//API de Verificação de E-mail
$.fn.form.settings.rules["checkEmailLogin"] = function(value) {
  return servicesGlobal.validEmail(value);
};

$.fn.form.settings.rules["checkEmailLoginNewAcount"] = function(value) {
  if(servicesGlobal.validEmail(value)){
    return false;
  }else{
    return true;
  }
};

$(document).ready(function() {

  /*Funções que valida o Formulario do login*/
  $('#formLogin')
    .form({

      revalidate: false,
      keyboardShortcuts: false, 
     
      onSuccess : function(e){

          e.preventDefault();

          var $form = $(e.target);
          var data  = $form.serialize();
          var url   = $form.attr('action');

          $form.addClass("loading");
          $('#btn-submit').addClass("loading disabled");
          
          var response = functionGlobal.ajaxGlobal(url, data);
        
          if(response.status){
            location.href=response.site;
          }else{
            $form.removeClass("loading");
            $('#btn-submit').removeClass("loading disabled");
             alert(response.information);
          }
          
      },

      fields: {

        email: {
          identifier: 'pes_email',
          rules: [
            { type: 'empty', prompt: 'Digite seu e-mail'}, 
            { type: 'email', prompt: 'E-mail Inválido'},
            { type: 'checkEmailLogin', prompt: 'O e-mail digitado não pertence a nenhuma conta.' }
          ]
        },

        password: {
          identifier: 'pes_senha',
          rules: [
            {type: 'empty', prompt: 'Digite sua senha'}, 
            {type: 'length[6]',prompt: 'Sua senha deve conter no mínimo {ruleValue}  caracteres'}
          ]
        }

      }
    });


});



