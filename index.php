<?php

/**
 * Este � o arquivo inicial do Mojo*PHP, altere as defini��es iniciais
 * para come�ar a desenvolver.
 * 
 * Defina corretamente:
 * - O diret�rio de instala��o.
 * - Ambiente da instala��o.
 * 
 * Saiba mais sobre estas configura��es no site:
 * http://www.mojophp.net/guia/ver/instalando
 * 
 */

/**
 * Ativa o uso de sess�es caso n�o esteja ativado.
 */
if(!$_SESSION)session_start();
/**
 * Diret�rio de instala��o.
 */
define('DIR_INSTALACAO', 'DEV-MojoPHP');
/**
 * Ambiente da instala��o.
 */
define('ENVIROMENT', 'desenvolvimento');

/**
 * ****************************************************************************
 * ATEN��O!                                                                   *
 * --------                                                                   *
 *                                                                            *
 * N�o altere a partir deste ponto se n�o tiver certeza do que est� fazendo.  *
 *                                                                            *
 * ****************************************************************************
 */
if (defined('ENVIROMENT')) {
    switch (ENVIROMENT) {
        case 'desenvolvimento':
            error_reporting(E_ALL);
            break;

        case 'teste':
        case 'producao':
            error_reporting(0);
            break;

        default:
            exit('O ambiente (enviroment) da aplica��o n�o est� configurado corretamente.');
    }
}
/**
 * Separador de diret�rios.
 */
define('DS', '/');
/**
 * Caminho f�sico completo da instala��o.
 */
define('BASE_PATH', dirname(__FILE__));
/**
 * Url completa da instala��o.
 * 
 * Defini um valor dferente caso DIR_INSTALACAO nao seja vazio.
 */
if (DIR_INSTALACAO == ''):
    define('BASE_URL', "http" . (isset($_SERVER["HTTPS"]) ? "s" : "") . "://" . $_SERVER["HTTP_HOST"]);
else:
    define('BASE_URL', "http" . (isset($_SERVER["HTTPS"]) ? "s" : "") . "://" . $_SERVER["HTTP_HOST"] . DS . DIR_INSTALACAO);
endif;
/**
 * Caminho f�sico da pasta 'app'.
 */
define('APP', BASE_PATH . DS . 'app');
/**
 * Caminho f�sico da pasta 'sys'.
 */
define('SYS', BASE_PATH . DS . 'sys');
/**
 * Caminho f�sico da pasta 'core'.
 */
define('CORE', SYS . DS . 'core');

require_once CORE . DS . 'bootstrap.php';