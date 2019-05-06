//Mascaras
$(document).ready(function () {

    $('.date').mask("00/00/0000", {clearIfNotMatch: true});
    $('.real').mask('000,000,000,000,000.00', {reverse: true});
    $('.cpf').mask("000.000.000-00", {clearIfNotMatch: true});
    $('.cep').mask("00000-000", {clearIfNotMatch: true});
    $('.cnpj').mask("00.000.000/0000-00", {clearIfNotMatch: true});
    $('.nota').mask('00.00', {clearIfNotMatch: true});
    $('.hour').mask('00:00', {clearIfNotMatch: true});
   
    //função da mascara de telefone com 8 ou 9 digitos
    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00)00000-0000' : '(00)0000-00009';
    },
    spOptions = {
        onKeyPress: function (val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };

    $('.fone').mask(SPMaskBehavior, {clearIfNotMatch: true});
    //função da mascara de telefone com 8 ou 9 digitos

    //valida o campo date
    $('.validaDate').change( function () {
        var RegExPattern = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)(?:0?2)\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;
        if (!((this.value.match(RegExPattern)) && (this.value!=''))) {
            this.value='';
            alert('Data inválida.');
        }
    });
    
    
    
    //Somente números
    $( '.onlyNumber' ).on( 'keydown', function(e) {
        var keyCode = e.keyCode || e.which,
        pattern = /\d/,
        // Permite somente Backspace, Delete e as setas direita e esquerda, números do teclado numérico - 96 a 105 - (além dos números)
        keys = [ 46, 8, 9, 37, 39, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105 ];
  
        if( ! pattern.test( String.fromCharCode( keyCode ) ) && $.inArray( keyCode, keys ) === -1 ) {
            return false;
        }
    });
    
   /*Utilizar em campo datas
    $(".date").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
    */
    
});
//Mascaras


