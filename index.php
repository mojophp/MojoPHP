<?php

/**
 * Ativa o uso de sessões caso não esteja ativado.
 */
if(!$_SESSION)session_start();

/**
 * Ambiente da instalação.
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
            exit('O ambiente (enviroment) da aplicação não está configurado corretamente.');
    }
}

/**
 * Separador de diretórios.
 */
define('DS', '/');
/**
 * Diretório de instalação.
 */
define('DIR_INSTALACAO', 'DEV-MojoPHP');
/**
 * Caminho físico completo da instalação.
 */
define('BASE_PATH', dirname(__FILE__));

/**
 * Url completa da instalação.
 * 
 * Defini um valor dferente caso DIR_INSTALACAO nao seja vazio.
 */
if (DIR_INSTALACAO == ''):
    define('BASE_URL', "http" . (isset($_SERVER["HTTPS"]) ? "s" : "") . "://" . $_SERVER["HTTP_HOST"]);
else:
    define('BASE_URL', "http" . (isset($_SERVER["HTTPS"]) ? "s" : "") . "://" . $_SERVER["HTTP_HOST"] . DS . DIR_INSTALACAO);
endif;

/**
 * Caminho físico da pasta 'app'.
 */
define('APP', BASE_PATH . DS . 'app');
/**
 * Caminho físico da pasta 'sys'.
 */
define('SYS', BASE_PATH . DS . 'sys');
/**
 * Caminho físico da pasta 'core'.
 */
define('CORE', SYS . DS . 'core');

require_once CORE . DS . 'bootstrap.php';
