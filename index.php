<?php

/**
 * Ambiente da instalaзгo.
 */
define('ENVIROMENT', 'desenvolvimento');

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
            exit('O ambiente (enviroment) da aplicaзгo nгo estб configurado corretamente.');
    }
}

/**
 * Separador de diretуrios.
 */
define('DS', DIRECTORY_SEPARATOR);
/**
 * Diretуrio de instalaзгo.
 */
define('DIR_INSTALACAO', '');
/**
 * Caminho fнsico completo da instalaзгo.
 */
define('BASE_PATH', dirname(__FILE__));

/**
 * Url completa da instalaзгo.
 * 
 * Defini um valor dferente caso DIR_INSTALACAO nao seja vazio.
 */
if (DIR_INSTALACAO == ''):
    define('BASE_URL', "http" . (isset($_SERVER["HTTPS"]) ? "s" : "") . "://" . $_SERVER["HTTP_HOST"]);
else:
    define('BASE_URL', "http" . (isset($_SERVER["HTTPS"]) ? "s" : "") . "://" . $_SERVER["HTTP_HOST"] . DS . DIR_INSTALACAO);
endif;

/**
 * Caminho fнsico da pasta 'app'.
 */
define('APP', BASE_PATH . DS . 'app');
/**
 * Caminho fнsico da pasta 'sys'.
 */
define('SYS', BASE_PATH . DS . 'sys');
/**
 * Caminho fнsico da pasta 'core'.
 */
define('CORE', SYS . DS . 'core');

require_once CORE . DS . 'bootstrap.php';
