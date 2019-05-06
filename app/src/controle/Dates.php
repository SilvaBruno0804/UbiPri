<?php

namespace app\controle;

class Dates {

    /**
     * retorna data do relogio sequida de Ano-Mes-Dia
     * utilizada geralmente para salvar no banco de dados 
     */
    public function returnDateToday() {
        date_default_timezone_set('America/Sao_Paulo');
        return date('Y-m-d');
    }

    /**
     * retorna data e hora atual do relogio sequida de Ano-Mes-Dia Hora-Minuto-Segundo
     * utilizada geralmente para salvar no banco de dados
     */
    public function returnDateTimeNow() {
        date_default_timezone_set('America/Sao_Paulo');
        return date('Y-m-d H:i:s');
    }

    /**
     * retorna hora do relogio sequida de Hora:Minutos:Segundos
     */
    public function returnTimeNow() {
        date_default_timezone_set('America/Sao_Paulo');
        return date('H:i:s');
    }

    /**
     * Retorna a hora formatada vindo por parametro
     * @param $hour Description hora vindo por paramentro Ex.. 08:00:00
     */
    public function returnDateTimeFormated($hour) {
        $hourConverted = $this->returnDateConvertedSecond($hour);
        return date("H:i", $hourConverted);
    }

    /**
     * retorna data e hora atual do relogio sequida de  Dia/Mes/Ano Hora:Minuto:Segundo
     */
    public function returnDateTimeNowBrazil() {
        date_default_timezone_set('America/Sao_Paulo');
        return date('d/m/Y H:i:s');
    }

    /**
     * Converte a data em milisegundos
     */
    public function returnDateConvertedSecond($data) {
        return $dataConverted = strtotime($data);
    }

    /**
     * retorna data atual do relogio, Ex.: Terça Feira, 23 de Agosto de 2016
     */
    public function returnDateTimeNowBrazilWeekGetMesText() {
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $dateFormated = $this->returnDateConvertedSecond(date('Y-m-d H:i:s'));
        return utf8_encode(strftime('%A, %d de %B de %Y %H:%M:%S', $dateFormated));
    }

    /**
     * Formata a data vindo por parametro, Ex.: Terça Feira, 23 de Agosto de 2016
     */
    public function formatedDateTimeBrazilWeekGetMesText($data) {
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $dateFormated = $this->returnDateConvertedSecond($data);
        return utf8_encode(strftime('%A, %d de %B de %Y', $dateFormated));
    }

    /**
     * Formata a data vindo por parametro, Ex.: Terça Feira, 23 de Agosto de 2016 08:00
     */
    public function formatedDateTimeHourBrazilWeekGetMesText($data) {
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $dateFormated = $this->returnDateConvertedSecond($data);
        return utf8_encode(strftime('%A, %d de %B de %Y %H:%M:%S', $dateFormated));
    }

    /**
     * converte a data que veio por parametro e retorna a data e hora no formato brasileiro Dia/Mes/Ano Hora:Minuto:Segundo
     * geralmente utilizada quando a data vem do banco de dados para mostrar para o usuário
     */
    public function returnDateTimeBrazil($data) {
        date_default_timezone_set('America/Sao_Paulo');
        $dataConverted = $this->returnDateConvertedSecond($data);
        return date("d/m/Y H:i:s", $dataConverted);
    }

    /**
     * recebe a data no formato brasileiro e retorna a data no formato date para salvar no banco de dados Ano-Mes-Dia
     */
    public function returnDataSaveDataBase($data) {
        $ex_data = explode("/", $data);
        return $data = $ex_data[2] . "-" . $ex_data[1] . "-" . $ex_data[0];
    }

    /**
     * Retorna a data no formato date para mostrar para o usuário no formato brasileiro Dia/Mes/Ano
     */
    public function returnDataShow($data) {
        date_default_timezone_set('America/Sao_Paulo');
        $dataConverted = $this->returnDateConvertedSecond($data);
        return date("d/m/Y", $dataConverted);
    }

    /**
     * Verifica se a data vindo por parametro é Menor e iqual
     */
    public function checkDateLessEqual($date) {

        date_default_timezone_set('America/Sao_Paulo');

        $dtInitial = strtotime(date('Y-m-d'));
        $dtFinal = strtotime($date);

        if ($dtInitial <= $dtFinal) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Verifica se a data vindo por parametro é Menor
     */
    public function checkDateLess($date) {

        date_default_timezone_set('America/Sao_Paulo');

        $dtInitial = strtotime(date('Y-m-d'));
        $dtFinal = strtotime($date);

        if ($dtInitial < $dtFinal) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Verifica se a data vindo por parametro é Maior e iqual
     */
    public function checkDateMostIqual($date) {

        date_default_timezone_set('America/Sao_Paulo');

        $dtInitial = strtotime(date('Y-m-d'));
        $dtFinal = strtotime($date);

        if ($dtInitial >= $dtFinal) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Verifica se a data vindo por parametro é Maior
     */
    public function checkDateMost($date) {

        date_default_timezone_set('America/Sao_Paulo');

        $dtInitial = strtotime(date('Y-m-d'));
        $dtFinal = strtotime($date);

        if ($dtInitial > $dtFinal) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Retorna a data formatada para visualizar nas paginas
     * @param $dateInitials Description Data inicial. Exemplo de Data: 2016-12-01
     * @param $dateFinal Description Data final Exemplo de Data: 2016-12-01
     * @param $type Description Tipo 1 (20 a 24 novembro de 2016) e Tipo 2 20 a 24/10/2016
     */
    public function returnDateHourFormatedWiew($dateInitials, $dateFinal, $type = 1) {

        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $secondDateInitials = $this->returnDateConvertedSecond($dateInitials); //Segundos
        $secondDateFinal = $this->returnDateConvertedSecond($dateFinal); // Segundos

        $vdi[0] = date("d", $secondDateInitials); // dia
        $vdi[1] = date("m", $secondDateInitials); // mes
        $vdi[2] = date("Y", $secondDateInitials); // ano

        $vdf[0] = date("d", $secondDateFinal); //dia 
        $vdf[1] = date("m", $secondDateFinal); // mes
        $vdf[2] = date("Y", $secondDateFinal); // ano

        if ($type == 1) {
            if ($vdi[2] == $vdf[2]) {

                if ($vdi[1] == $vdf[1]) {
                    if ($secondDateInitials == $secondDateFinal) {
                        $dataFormated = strftime('%A, %d de %B de %Y', $secondDateInitials);
                    } else {
                        $dataFormated = $vdi[0] . " a " . $vdf[0] . " de " . strftime(' %B de %Y', $secondDateInitials);
                    }
                } else {
                    $dataFormated = strftime('%d de %B ', $secondDateInitials) . " a " . strftime('%d de %B de %Y', $secondDateFinal);
                }
            } else {
                $dataFormated = strftime('%d de %B de %Y', $secondDateInitials) . " a " . strftime('%d de %B de %Y', $secondDateFinal);
            }
        } else if ($type == 2) {
            if ($vdi[2] == $vdf[2]) {

                if ($vdi[1] == $vdf[1]) {
                    if ($secondDateInitials == $secondDateFinal) {
                        $dataFormated = $vdi[0] . "/" . $vdi[1] . "/" . $vdi[2];
                    } else {
                        $dataFormated = $vdi[0] . " a " . $vdf[0] . "/" . $vdi[1] . "/" . $vdi[2];
                    }
                } else {
                    $dataFormated = $vdi[0] . "/" . $vdi[1] . " a " . $vdf[0] . "/" . $vdf[1] . "/" . $vdf[2];
                }
            } else {
                $dataFormated = $vdi[0] . "/" . $vdi[1] . "/" . $vdi[2] . " a " . $vdf[0] . "/" . $vdf[1] . "/" . $vdf[2];
            }
        }

        return utf8_encode($dataFormated);
    }

    /* Datas */
    
    /**
     * Valida data formato Brasil
     * @param $data verifica se a data vindo por parametro no formato brasileiro é válido 
     */
    function validDateBrazil($data) {
        // data é menor que 8
        if (strlen($data) < 8) {
            return false;
        } else {
            // verifica se a data possui
            // a barra (/) de separação
            if (strpos($data, "/") !== FALSE) {
                //
                $partes = explode("/", $data);
                // pega o dia da data
                $dia = $partes[0];
                // pega o mês da data
                $mes = $partes[1];
                // prevenindo Notice: Undefined offset: 2
                // caso informe data com uma única barra (/)
                $ano = isset($partes[2]) ? $partes[2] : 0;

                if (strlen($ano) < 4) {
                    return false;
                } else {
                    // verifica se a data é válida
                    if (checkdate($mes, $dia, $ano)) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }
    }
    
    
    

}
