var servicesGlobal = (function () {
    

    //Verifica se o e-mail consultado existe no banco de dados e retorna True ou False
    var _validEmail = function (value) {
        var url = URLBASE + "app/services/services-global.php";
        var data = {
            "form": "checkEmail",
            "pes_email": value
        };
        var response = functionGlobal.ajaxGlobal(url, data);
        return response.status;
    };

    /**
     * Valida CNPJ
     * @return Boolean
     * */
    var _checkCnpj = function (value) {
        var url = URLBASE + "app/services/services-global.php";
        var data = {
            "form": "checkCNPJ",
            "pes_cnpj": value
        };
        var response = functionGlobal.ajaxGlobal(url, data);
        return response.status;
    };

    return {
        validEmail: _validEmail,
        checkCnpj: _checkCnpj
    };


})();