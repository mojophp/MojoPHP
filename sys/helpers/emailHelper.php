<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Este arquivo é o helper que reúne as funções de email dentro do Mojo*PHP
 * 
 * - Inspirado/Derivado do CodeIgniter® (http://www.codeigniter.com)
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 */

/**
 * Esta função valida um e-mail.
 * 
 * @param string $address
 * @return bool 
 */
function val_email($address) {
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $address)) ? FALSE : TRUE;
}

/**
 * Esta função envia um e-mail usando mail() do PHP.
 * 
 * @param string $recipient
 * @param string $subject
 * @param string $message
 * @param mixed $param
 * @return bool 
 */
function send_mail($recipient, $subject = 'Test email', $message = 'Hello World', $param = NULL) {
    return mail($recipient, $subject, $message, $param);
}