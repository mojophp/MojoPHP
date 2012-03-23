<?php

if ( ! defined('BASE_PATH')) exit('Acesso negado!');

/**
 * Aqui voc� deve definir suas configura��es de banco de dados  de acordo
 * com um determinado ambiente de desenvolvimento. Voc� pode definir quantos
 * ambientes forem necess�rios.
 * 
 */

Config::write("database", array(
    "desenvolvimento" => array(
        "driver" => "mysql",
        "host" => "seu_host",
        "user" => "seu_username",
        "password" => "sua_password",
        "database" => "seu_database"
    ),
    "teste" => array(
        "driver" => "",
        "host" => "",
        "user" => "",
        "password" => "",
        "database" => ""
    ),
    "producao" => array(
        "driver" => "",
        "host" => "",
        "user" => "",
        "password" => "",
        "database" => ""
    )
));