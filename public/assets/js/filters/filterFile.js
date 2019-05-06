//Função que valida tipo e tamanho do arquivo
$(document).ready(function () {

    $('.fileValidate').change(function () {

        var label = $(this).val();
        var fileExtentionRange = $(this).attr("data-type");
        var MAX_SIZE = $(this).attr("data-size");

        var label = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');
        var numFiles = $(this).get(0).files ? $(this).get(0).files.length : 1;
        var size = $(this).get(0).files[0].size;

        var postfix = label.substr(label.lastIndexOf('.'));


        if (fileExtentionRange.indexOf(postfix.toLowerCase()) > -1) {
            if (size > 1024 * 1024 * MAX_SIZE) {
                $(this).val('');
                alert('Tamanho máximo permitido é de ' + MAX_SIZE + ' MB.');
                return false;

            } else {
                return true;
                //$(this).val(label);
            }
        } else {
            $(this).val('');
            alert('Somente é aceito os formatos: (' + fileExtentionRange + ')');
            return false;
        }

    });
    
    /*Valida somente o tamanho do arquivo*/
    $('.fileValidateSize').change(function () {

        var MAX_SIZE = $(this).attr("data-size");
        var size = $(this).get(0).files[0].size;

        if (size > 1024 * 1024 * MAX_SIZE) {
            $(this).val('');
            alert('Tamanho máximo permitido é de ' + MAX_SIZE + ' MB.');
            return false;
        } else {
            return true;
            //$(this).val(label);
        }
    });
    
});
//Função que valida tipo e tamanho do arquivo