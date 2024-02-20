<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * description
 *
 * @param
 * @return
 */
function AccountId()
{
    $account = session('account');
    if (isset($account->id)) {
        return $account->id;
    }
}

function hasConfig(\App\Models\Module $module)
{
    return \App\Models\ModulesAccount::query()->where(['account_id' => AccountId(), 'module_id' => $module->id])->exists();
}

function mesExtenso(){
    switch (date("m")) {
        case "01":    $mes = 'Janeiro';     break;
        case "02":    $mes = 'Fevereiro';   break;
        case "03":    $mes = 'Março';       break;
        case "04":    $mes = 'Abril';       break;
        case "05":    $mes = 'Maio';        break;
        case "06":    $mes = 'Junho';       break;
        case "07":    $mes = 'Julho';       break;
        case "08":    $mes = 'Agosto';      break;
        case "09":    $mes = 'Setembro';    break;
        case "10":    $mes = 'Outubro';     break;
        case "11":    $mes = 'Novembro';    break;
        case "12":    $mes = 'Dezembro';    break;
    }

    return $mes;
}

function pingAddress($ip) {
    exec('ping '.$ip, $saida, $retorno);
    if ($retorno == 0) {
        return true;
    } else {
        return false;
    }
}

function limpaNumeros($numeros){
    $novo_numero = str_replace("(", "", $numeros);
    $novo_numero = str_replace(")", "", $novo_numero);
    $novo_numero = str_replace("-", "", $novo_numero);
    $novo_numero = str_replace(" ", "", $novo_numero);
    $novo_numero = str_replace("_", "", $novo_numero);
    $novo_numero = str_replace(".", "", $novo_numero);
    $novo_numero = str_replace("/", "", $novo_numero);
    $novo_numero = str_replace("\/", "", $novo_numero);

    return $novo_numero;
}

function AccountId_byDomain()
{
    return 1;
}

function dateEUA($data)
{
    if(!empty($data))
    {
        $data = explode('/', $data);
        $hora = null;

        $dia = $data[0];
        $mes = $data[1];

        $time = explode(" ", $data[2]);
        $ano = $time[0];
        $data = $ano.'-'.$mes.'-'.$dia;

        if(isset($time[1]))
            $hora = $time[1];

        return $data.' '.$hora;
    }
}

function Mask($mask,$str)
{
    $str = str_replace(" ","",$str);
    for($i=0;$i<strlen($str);$i++){
        $mask[strpos($mask,"#")] = $str[$i];
    }
    return $mask;
}

function randomDigit($digits){
    return rand(pow(10, $digits - 1) - 1, pow(10, $digits) - 1);
}

function randomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}

function dateFormat($data, $formato = "d/m/Y H:i") {
    $nova_data = new DateTime($data);
    return $nova_data->format($formato);
}

function limpaChars($string){
    $string = str_replace(" ", "_", $string);
    $string = str_replace(".", "_", $string);
    $string = str_replace("/", "-", $string);
    $string = str_replace("Á", "A", $string);
    $string = str_replace("á", "a", $string);
    $string = str_replace("ã", "a", $string);
    $string = str_replace("É", "E", $string);
    $string = str_replace("é", "e", $string);
    $string = str_replace("Í", "I", $string);
    $string = str_replace("í", "i", $string);
    $string = str_replace("Ó", "O", $string);
    $string = str_replace("ó", "o", $string);
    $string = str_replace("õ", "o", $string);
    $string = str_replace("Ú", "U", $string);
    $string = str_replace("ú", "u", $string);
    $string = str_replace("ç", "c", $string);
    $string = str_replace("Ç", "c", $string);

    return $string;
}

function niceTime($input) {
    $minute = 60; // seconds
    $hour = 3600; // seconds
    $day = 86400; // seconds
    $week = 604800; // seconds
    $month = 2629743; // seconds
    $year = 31556926; // seconds

    $localtime = time();
    $time = strtotime($input); // transform input to timestamp
    $diff = $localtime - $time; // get difference in seconds

    switch (true) {

        // seconds
        case ($diff < $minute); // if difference less them a minute
            $count = $diff; // hold the value
            if ($count == 0) {
                $count = 1;
                $suffix = "segundo";
            } elseif ($count == 1) {
                $suffix = "segundo";
            } else {
                $suffix = "segundos";
            }
            break;

        // minute
        case ($diff > $minute && $diff < $hour); /* if difference greater them a minute and if diff less them an hour */
            $count = floor($diff / $minute); // here i divided by minute in order to get 1
            if ($count == 1) {
                $suffix = "minuto";
            } else {
                $suffix = "minutos";
            }
            break;

        // hour
        case ($diff > $hour && $diff < $day); /* if difference greater them an hour and if diff less them a day */
            $count = floor($diff / $hour); // here i divided by hour in order to get 1
            if ($count == 1) {
                $suffix = "hora";
            } else {
                $suffix = "horas";
            }
            break;

        // day
        case ($diff > $day && $diff < $week); /* if difference greater them a day and if diff less them a week */
            $count = floor($diff / $day); // here i divided by day in order to get 1
            if ($count == 1) {
                $suffix = "dia";
            } else {
                $suffix = "dias";
            }
            break;

        // week
        case ($diff > $week && $diff < $month); /* if difference greater them a week and if diff less them a month */
            $count = floor($diff / $week); // here i divided by week in order to get 1
            if ($count == 1) {
                $suffix = "semana";
            } else {
                $suffix = "semanas";
            }
            break;

        // month
        case ($diff > $month && $diff < $year); /* if difference greater them a month and if diff less them a year */
            $count = floor($diff / $month); // here i divided by month in order to get 1
            if ($count == 1) {
                $suffix = "mês";
            } else {
                $suffix = "mêses";
            }
            break;

        // year
        case ($diff > $year); /* if difference greater them a year */
            $count = floor($diff / $year); // here i divided by year in order to get 1
            if ($count == 1) {
                $suffix = "ano";
            } else {
                $suffix = "anos";
            }
            break;
    }
    return $count." ".$suffix." atrás";
}

function numFormat($number){
    //$number = str_replace("-", "", $number);
    return number_format(doubleval($number), 2, ',', '.');
}

function lucroNum($v_ant, $v_nov){
    $p_lucro = 0; // porcentagem de lucro

    if($v_ant != 0){
        $p_lucro = round((($v_nov / $v_ant) - 1) * 100, 2);
    }
    return @$p_lucro . "%";

}

function numFormat_US($number){
    if(!empty($number)){
        $number = str_replace(".", "", $number);
        return str_replace(",", ".", $number);
    }else{
        return 0.00;
    }
}

function s3_asset($file){
    return "https://s3-sa-east-1.amazonaws.com/gerentep/".$file;
}