<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Este arquivo efetua o carregamento dos arquivos e configura��es
 * mais b�sicas para o funcionamento do Mojo*PHP.
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 */
/**
 * Importa o arquivo mojo.php
 */
require_once CORE . DS . 'mojo.php';

/**
 * Importa as configura��es do sistema.
 */
App::import('config', array('common',
    'constants',
    'database')
);

/**
 * Importa as bibliotecas principais.
 */
App::import('core', array('common',
    'registry',
    'loader',
    'datasource',
    'controller',
    'model',
    'router')
);

/**
 * Inicia uma inst�ncia do Roteador do Mojo*PHP.
 */
MJ_Router::getInstance();