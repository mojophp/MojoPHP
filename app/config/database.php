<?php

if ( ! defined('BASE_PATH')) exit('Acesso negado!');

/**
 * Aqui você deve definir suas configurações de banco de dados  de acordo
 * com um determinado ambiente de desenvolvimento. Você pode definir quantos
 * ambientes forem necessários.
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