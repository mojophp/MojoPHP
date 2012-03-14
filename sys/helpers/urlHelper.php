<?php
if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Este arquivo é o helper para trabalhar com URLs dentro do Mojo*PHP.
 * 
 * - Inspirado/Derivado do CodeIgniter® (http://www.codeigniter.com)
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 * @since 26/12/2012
 * 
 */

/**
 * Converte uma string em um link legível, concatenando os espaços com
 * 'dash' ou 'underscore' e retirando os caracteres especiais.
 * 
 * Ex: Título do artigo -> Titulo-do-artigo
 * 
 * @access public
 * @param string $str - Título
 * @param string $separator - separador: dash ou underscore
 * @param boolean $lowercase - Deixa ou não o texto minúsculo
 * @return string
 *  
 */
function url_title($str, $separator = 'dash', $lowercase = FALSE) {

    if ($separator == 'dash') {
        $search = '_';
        $replace = '-';
    } else {
        $search = '-';
        $replace = '_';
    }

    $trans = array(
        '&\#\d+?;' => '',
        '&\S+?;' => '',
        '\s+' => $replace,
        '[^a-z0-9\-\._]' => '',
        $replace . '+' => $replace,
        $replace . '$' => $replace,
        '^' . $replace => $replace,
        '\.+$' => ''
    );

    $str = strip_tags($str);

    foreach ($trans as $key => $val) {
        $str = preg_replace("#" . $key . "#i", $val, $str);
    }

    if ($lowercase === TRUE) {
        $str = strtolower($str);
    }

    return trim(stripslashes($str));
}

/**
 * Esta função retorna o valor passado pela URL de acordo com
 * o elemento informado.
 * 
 * Ex: get_route(4) retorna o quarto elemento da URL /1/2/3/4
 * 
 * @access public
 * @param int $pos - Posição na URL
 * @return string
 *  
 */
function get_route($pos) {
    $route = (empty($_GET['rt'])) ? '' : $_GET['rt'];
    $parts = explode('/', $route);
    return $parts[$pos];
}

/**
 * Esta função retorna um endereço da aplicação informando apenas a estrutura
 * do controller, método e parâmetro.
 * 
 * @param string $uri
 * @return string 
 */
function site_url($uri) {
    if (ENVIROMENT == 'desenvolvimento'):
        return BASE_URL . DS . 'index.php?rt=' . $uri;
    else:
        return BASE_URL . DS . $uri;
    endif;
}

/**
 * Esta função gera o código HTML de um link completo para impressão, já 
 * contextualizado à aplicação evitando problemas de navegação com as
 * URLs amigáveis.
 * 
 * @access	public
 * @param	string	URL
 * @param	string	Titulo
 * @param	mixed	Atributos passados em array()
 * @return	string
 */
function anchor($uri = '', $title = '', $attributes = '') {
    $title = (string) $title;

    if (!is_array($uri)) {
        $site_url = (!preg_match('!^\w+://! i', $uri)) ? site_url($uri) : $uri;
    } else {
        $site_url = site_url($uri);
    }

    if ($title == '') {
        $title = $site_url;
    }

    if ($attributes != '') {
        $attributes = _passa_atributos($attributes);
    }

    return '<a href="' . $site_url . '"' . $attributes . '>' . $title . '</a>';
}

/**
 * Esta função gera o código HTML de um link pou-up completo para impressão, já 
 * contextualizado à aplicação evitando problemas de navegação com as
 * URLs amigáveis.
 * 
 * @access public
 * @param string $uri URL
 * @param string $title Título do link
 * @param array $attributes Atributos passados em array()
 * @return string 
 */
function anchor_popup($uri = '', $title = '', $attributes = FALSE) {
    $title = (string) $title;

    $site_url = (!preg_match('!^\w+://! i', $uri)) ? site_url($uri) : $uri;

    if ($title == '') {
        $title = $site_url;
    }

    if ($attributes === FALSE) {
        return "<a href='javascript:void(0);' onclick=\"window.open('" . $site_url . "', '_blank');\">" . $title . "</a>";
    }

    if (!is_array($attributes)) {
        $attributes = array();
    }

    foreach (array('width' => '800', 'height' => '600', 'scrollbars' => 'yes', 'status' => 'yes', 'resizable' => 'yes', 'screenx' => '0', 'screeny' => '0',) as $key => $val) {
        $atts[$key] = (!isset($attributes[$key])) ? $val : $attributes[$key];
        unset($attributes[$key]);
    }

    if ($attributes != '') {
        $attributes = _passa_atributos($attributes);
    }

    return "<a href='javascript:void(0);' onclick=\"window.open('" . $site_url . "', '_blank', '" . _passa_atributos($atts, TRUE) . "');\"$attributes>" . $title . "</a>";
}

/**
 * Esta função gera o código HTML de um link do tipo MAILTO para impressão, já 
 * contextualizado à aplicação evitando problemas de navegação com as
 * URLs amigáveis.
 * 
 * @param string $email Email de destino
 * @param string $title Título do link
 * @param array $attributes Atributos passados em array()
 * @return string 
 */
function mailto($email, $title = '', $attributes = '') {
    $title = (string) $title;

    if ($title == "") {
        $title = $email;
    }

    $attributes = _passa_atributos($attributes);

    return '<a href="mailto:' . $email . '"' . $attributes . '>' . $title . '</a>';
}

/**
 * Esta função gera o código HTML de um link do tipo MAILTO para impressão,
 * usando Javascript.
 * 
 * @param string $email Email de destino
 * @param string $title Título do link
 * @param array $attributes Atributos passados em array()
 * @return string 
 */
function safe_mailto($email, $title = '', $attributes = '') {
    $title = (string) $title;

    if ($title == "") {
        $title = $email;
    }

    for ($i = 0; $i < 16; $i++) {
        $x[] = substr('<a href="mailto:', $i, 1);
    }

    for ($i = 0; $i < strlen($email); $i++) {
        $x[] = "|" . ord(substr($email, $i, 1));
    }

    $x[] = '"';

    if ($attributes != '') {
        if (is_array($attributes)) {
            foreach ($attributes as $key => $val) {
                $x[] = ' ' . $key . '="';
                for ($i = 0; $i < strlen($val); $i++) {
                    $x[] = "|" . ord(substr($val, $i, 1));
                }
                $x[] = '"';
            }
        } else {
            for ($i = 0; $i < strlen($attributes); $i++) {
                $x[] = substr($attributes, $i, 1);
            }
        }
    }

    $x[] = '>';

    $temp = array();
    for ($i = 0; $i < strlen($title); $i++) {
        $ordinal = ord($title[$i]);

        if ($ordinal < 128) {
            $x[] = "|" . $ordinal;
        } else {
            if (count($temp) == 0) {
                $count = ($ordinal < 224) ? 2 : 3;
            }

            $temp[] = $ordinal;
            if (count($temp) == $count) {
                $number = ($count == 3) ? (($temp['0'] % 16) * 4096) + (($temp['1'] % 64) * 64) + ($temp['2'] % 64) : (($temp['0'] % 32) * 64) + ($temp['1'] % 64);
                $x[] = "|" . $number;
                $count = 1;
                $temp = array();
            }
        }
    }

    $x[] = '<';
    $x[] = '/';
    $x[] = 'a';
    $x[] = '>';

    $x = array_reverse($x);
    ob_start();
    ?><script type="text/javascript">
            //<![CDATA[
            var l=new Array();
    <?php
    $i = 0;
    foreach ($x as $val) {
        ?>l[<?php echo $i++; ?>]='<?php echo $val; ?>';<?php } ?>

            for (var i = l.length-1; i >= 0; i=i-1){
                if (l[i].substring(0, 1) == '|') document.write("&#"+unescape(l[i].substring(1))+";");
                else document.write(unescape(l[i]));}
            //]]>
    </script><?php
    $buffer = ob_get_contents();
    ob_end_clean();
    return $buffer;
}

/**
 * Esta função processa os atributos enviados em array para as funções
 * anteriores.
 * 
 * @param mixed $attributes
 * @param bool $javascript
 * @return mixed 
 */
function _passa_atributos($attributes, $javascript = FALSE) {
    if (is_string($attributes)) {
        return ($attributes != '') ? ' ' . $attributes : '';
    }

    $att = '';
    foreach ($attributes as $key => $val) {
        if ($javascript == TRUE) {
            $att .= $key . '=' . $val . ',';
        } else {
            $att .= ' ' . $key . '="' . $val . '"';
        }
    }

    if ($javascript == TRUE AND $att != '') {
        $att = substr($att, 0, -1);
    }

    return $att;
}

/**
 * Esta função redireciona o usuário para o link especificado.
 * 
 * @param string $uri 
 */
function redirect($uri) {
    print '<script>document.location="' . site_url($uri) . '";</script>';
}