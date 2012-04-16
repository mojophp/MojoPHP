<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Este arquivo é o helper que reúne as funções para manipulação
 * de datas no Mojo*PHP.
 * 
 * - Inspirado/Derivado do CodeIgniter® (http://www.codeigniter.com)
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 */

function date_for_mysql($date){
    $desmonta = explode("/",$date);
    $dia =  $desmonta[0];
    $mes =  $desmonta[1];
    $ano =  $desmonta[2];
    $saida = $ano."-".$mes."-".$dia;
    return $saida;
}

function date_for_user($date){
    $desmonta = explode("-",$date);
    $ano =  $desmonta[0];
    $mes =  $desmonta[1];
    $dia =  $desmonta[2];
    $saida = $dia."/".$mes."/".$ano;
    return $saida;
}

/**
 * Retorna time() ou seu equivalente GMT baseado nas configurações da aplicação.
 * 
 * @return integer
 */
function now() {
    if (strtolower(Config::read('time_ref')) == 'gmt') {
        $now = time();
        $system_time = mktime(gmdate("H", $now), gmdate("i", $now), gmdate("s", $now), gmdate("m", $now), gmdate("d", $now), gmdate("Y", $now));

        if (strlen($system_time) < 10) {
            $system_time = time();
            log_message('erro', 'A classe Date não conseguiu configurar seu próprio código GMT, portanto o time() foi usado.');
        }

        return $system_time;
    } else {
        return time();
    }
}

/**
 * Converte o formatod de datas do MySql
 *
 * Esta função é idêntica à função date() do PHP, exceto que ela aceita
 * códigos de formato usando o estilo do MySql, onde cada código vem
 * precedido por um símbolo de porcentagem: %d/%m/%Y etc...
 *
 * @access	public
 * @param	string
 * @param	integer
 * @return	integer
 */
function mdate($datestr = '', $time = '') {
    if ($datestr == '')
        return '';

    if ($time == '')
        $time = now();

    $datestr = str_replace('%\\', '', preg_replace("/([a-z]+?){1}/i", "\\\\\\1", $datestr));
    return date($datestr, $time);
}

/**
 * Retorna uma data no formato indicado como padrão.
 *
 * @access	public
 * @param	string	the chosen format
 * @param	integer	Unix timestamp
 * @return	string
 */
function standard_date($fmt = 'DATE_BR', $time = '') {
    $formats = array(
        'DATE_BR1' => '%d/%m/%Y',
        'DATE_BR' => '%d/%m/%YT%H:%i:%s%Q',
        'DATE_MYSQL' => '%Y-%m-%d',
        'DATE_ATOM' => '%Y-%m-%dT%H:%i:%s%Q',
        'DATE_COOKIE' => '%l, %d-%M-%y %H:%i:%s UTC',
        'DATE_ISO8601' => '%Y-%m-%dT%H:%i:%s%Q',
        'DATE_RFC822' => '%D, %d %M %y %H:%i:%s %O',
        'DATE_RFC850' => '%l, %d-%M-%y %H:%i:%s UTC',
        'DATE_RFC1036' => '%D, %d %M %y %H:%i:%s %O',
        'DATE_RFC1123' => '%D, %d %M %Y %H:%i:%s %O',
        'DATE_RSS' => '%D, %d %M %Y %H:%i:%s %O',
        'DATE_W3C' => '%Y-%m-%dT%H:%i:%s%Q'
    );

    if (!isset($formats[$fmt])) {
        return FALSE;
    }

    return mdate($formats[$fmt], $time);
}

/**
 * Número de dias no mês.
 *
 * Retorna o número de dias de um mês/ano indicados nos parâmetros. Também
 * considera os anos bisextos.
 *
 * @access	public
 * @param	integer Mês em forma numérica.
 * @param	integer	Ano em forma numérica.
 * @return	integer
 */
function days_in_month($month = 0, $year = '') {
    if ($month < 1 OR $month > 12) {
        return 0;
    }

    if (!is_numeric($year) OR strlen($year) != 4) {
        $year = date('Y');
    }

    if ($month == 2) {
        if ($year % 400 == 0 OR ($year % 4 == 0 AND $year % 100 != 0)) {
            return 29;
        }
    }

    $days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    return $days_in_month[$month - 1];
}

/**
 * Converte um timestamp local do Unix para GMT.
 *
 * @access	public
 * @param	integer timestamp Unix
 * @return	integer
 */
function local_to_gmt($time = '') {
    if ($time == '')
        $time = time();

    return mktime(gmdate("H", $time), gmdate("i", $time), gmdate("s", $time), gmdate("m", $time), gmdate("d", $time), gmdate("Y", $time));
}

/**
 * Converte um GMT para timestamp do Unix.
 * 
 * @param integer $time
 * @param string $timezone
 * @param bool $dst
 * @return int 
 */
function gmt_to_local($time = '', $timezone = 'UTC', $dst = FALSE) {
    if ($time == '') {
        return now();
    }

    $time += timezones($timezone) * 3600;

    if ($dst == TRUE) {
        $time += 3600;
    }

    return $time;
}

/**
 * Converte um timestamp do MySql para o formato do Unix.
 *
 * @access	public
 * @param	integer timestamp do Unix
 * @return	integer
 */
function mysql_to_unix($time = '') {
    $time = str_replace('-', '', $time);
    $time = str_replace(':', '', $time);
    $time = str_replace(' ', '', $time);

    // YYYYMMDDHHMMSS
    return mktime(
                    substr($time, 8, 2), substr($time, 10, 2), substr($time, 12, 2), substr($time, 4, 2), substr($time, 6, 2), substr($time, 0, 4)
    );
}

/**
 * Formata uma data Unix para Humanos seguindo o modelo: 2006-08-21 11:35 PM
 * 
 * @access	public
 * @param	integer Unix timestamp
 * @param	bool	whether to show seconds
 * @param	string	format: us or euro
 * @return	string
 */
function unix_to_human($time = '', $seconds = FALSE, $fmt = 'us') {
    $r = date('Y', $time) . '-' . date('m', $time) . '-' . date('d', $time) . ' ';

    if ($fmt == 'us') {
        $r .= date('h', $time) . ':' . date('i', $time);
    } else {
        $r .= date('H', $time) . ':' . date('i', $time);
    }

    if ($seconds) {
        $r .= ':' . date('s', $time);
    }

    if ($fmt == 'us') {
        $r .= ' ' . date('A', $time);
    }

    return $r;
}

/**
 * Converte uma data "Umana" para GMT, revertendo o processo
 * da função anterior.
 *
 * @access	public
 * @param	string	format: us or euro
 * @return	integer
 */
function human_to_unix($datestr = '') {
    if ($datestr == '') {
        return FALSE;
    }

    $datestr = trim($datestr);
    $datestr = preg_replace("/\040+/", ' ', $datestr);

    if (!preg_match('/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}\s[0-9]{1,2}:[0-9]{1,2}(?::[0-9]{1,2})?(?:\s[AP]M)?$/i', $datestr)) {
        return FALSE;
    }

    $split = explode(' ', $datestr);

    $ex = explode("-", $split['0']);

    $year = (strlen($ex['0']) == 2) ? '20' . $ex['0'] : $ex['0'];
    $month = (strlen($ex['1']) == 1) ? '0' . $ex['1'] : $ex['1'];
    $day = (strlen($ex['2']) == 1) ? '0' . $ex['2'] : $ex['2'];

    $ex = explode(":", $split['1']);

    $hour = (strlen($ex['0']) == 1) ? '0' . $ex['0'] : $ex['0'];
    $min = (strlen($ex['1']) == 1) ? '0' . $ex['1'] : $ex['1'];

    if (isset($ex['2']) && preg_match('/[0-9]{1,2}/', $ex['2'])) {
        $sec = (strlen($ex['2']) == 1) ? '0' . $ex['2'] : $ex['2'];
    } else {
        // Unless specified, seconds get set to zero.
        $sec = '00';
    }

    if (isset($split['2'])) {
        $ampm = strtolower($split['2']);

        if (substr($ampm, 0, 1) == 'p' AND $hour < 12)
            $hour = $hour + 12;

        if (substr($ampm, 0, 1) == 'a' AND $hour == 12)
            $hour = '00';

        if (strlen($hour) == 1)
            $hour = '0' . $hour;
    }

    return mktime($hour, $min, $sec, $month, $day, $year);
}

/**
 * Retorna um array com as timezones. Esta função é utilizada em
 * muitas outras funções neste helper.
 * 
 * @access	public
 * @param	string	timezone
 * @return	string
 */
function timezones($tz = '') {
    // Note: Don't change the order of these even though
    // some items appear to be in the wrong order

    $zones = array(
        'UM12' => -12,
        'UM11' => -11,
        'UM10' => -10,
        'UM95' => -9.5,
        'UM9' => -9,
        'UM8' => -8,
        'UM7' => -7,
        'UM6' => -6,
        'UM5' => -5,
        'UM45' => -4.5,
        'UM4' => -4,
        'UM35' => -3.5,
        'UM3' => -3,
        'UM2' => -2,
        'UM1' => -1,
        'UTC' => 0,
        'UP1' => +1,
        'UP2' => +2,
        'UP3' => +3,
        'UP35' => +3.5,
        'UP4' => +4,
        'UP45' => +4.5,
        'UP5' => +5,
        'UP55' => +5.5,
        'UP575' => +5.75,
        'UP6' => +6,
        'UP65' => +6.5,
        'UP7' => +7,
        'UP8' => +8,
        'UP875' => +8.75,
        'UP9' => +9,
        'UP95' => +9.5,
        'UP10' => +10,
        'UP105' => +10.5,
        'UP11' => +11,
        'UP115' => +11.5,
        'UP12' => +12,
        'UP1275' => +12.75,
        'UP13' => +13,
        'UP14' => +14
    );

    if ($tz == '') {
        return $zones;
    }

    if ($tz == 'GMT')
        $tz = 'UTC';

    return (!isset($zones[$tz])) ? 0 : $zones[$tz];
}