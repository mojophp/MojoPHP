<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Este arquivo é o helper que contém as funções que facilitam o tratamento
 * de código HTML dentro do Mojo*PHP.
 * 
 * - Inspirado/Derivado do CodeIgniter® (http://www.codeigniter.com)
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 */

/**
 * Esta função gera uma tag HEADER do html.]
 *
 * @access	public
 * @param	string
 * @param	integer
 * @return	string
 */
function heading($data = '', $h = '1', $attributes = '') {
    $attributes = ($attributes != '') ? ' ' . $attributes : $attributes;
    return "<h" . $h . $attributes . ">" . $data . "</h" . $h . ">";
}

/**
 * Gera uma lista <UL> a partir de um array simples ou multi-dimensional.
 *
 * @access	public
 * @param	array
 * @param	mixed
 * @return	string
 */
function ul($list, $attributes = '') {
    return _list('ul', $list, $attributes);
}

/**
 * Gera uma lista <OL> a partir de um array simples ou multi-dimensional.
 *
 * @access	public
 * @param	array
 * @param	mixed
 * @return	string
 */
function ol($list, $attributes = '') {
    return _list('ol', $list, $attributes);
}

/**
 * Gera uma lista HTML a partir de um array simples ou multi-dimensional.
 *
 * @access	private
 * @param	string
 * @param	mixed
 * @param	mixed
 * @param	integer
 * @return	string
 */
function _list($type = 'ul', $list, $attributes = '', $depth = 0) {
    // If an array wasn't submitted there's nothing to do...
    if (!is_array($list)) {
        return $list;
    }

    // Set the indentation based on the depth
    $out = str_repeat(" ", $depth);

    // Were any attributes submitted?  If so generate a string
    if (is_array($attributes)) {
        $atts = '';
        foreach ($attributes as $key => $val) {
            $atts .= ' ' . $key . '="' . $val . '"';
        }
        $attributes = $atts;
    } elseif (is_string($attributes) AND strlen($attributes) > 0) {
        $attributes = ' ' . $attributes;
    }

    // Write the opening list tag
    $out .= "<" . $type . $attributes . ">\n";

    // Cycle through the list elements.  If an array is
    // encountered we will recursively call _list()

    static $_last_list_item = '';
    foreach ($list as $key => $val) {
        $_last_list_item = $key;

        $out .= str_repeat(" ", $depth + 2);
        $out .= "<li>";

        if (!is_array($val)) {
            $out .= $val;
        } else {
            $out .= $_last_list_item . "\n";
            $out .= _list($type, $val, '', $depth + 4);
            $out .= str_repeat(" ", $depth + 2);
        }

        $out .= "</li>\n";
    }

    // Set the indentation for the closing tag
    $out .= str_repeat(" ", $depth);

    // Write the closing list tag
    $out .= "</" . $type . ">\n";

    return $out;
}

/**
 * Gera uma sequência de tags HTML <br> de acordo com a quantidade especificada.
 *
 * @access	public
 * @param	integer
 * @return	string
 */
function br($num = 1) {
    return str_repeat("<br />", $num);
}

/**
 * Gera um elemento <img />
 *
 * @access	public
 * @param	mixed
 * @return	string
 */
function img($src = '', $index_page = FALSE) {
    if (!is_array($src)) {
        $src = array('src' => $src);
    }

    // If there is no alt attribute defined, set it to an empty string
    if (!isset($src['alt'])) {
        $src['alt'] = '';
    }

    $img = '<img';

    foreach ($src as $k => $v) {

        if ($k == 'src' AND strpos($v, '://') === FALSE) {
            //TODO Resolver o erro de referencia da imagem.
            $CI = & get_instance();

            if ($index_page === TRUE) {
                $img .= ' src="' . $CI->config->site_url($v) . '"';
            } else {
                $img .= ' src="' . $CI->config->slash_item('base_url') . $v . '"';
            }
        } else {
            $img .= " $k=\"$v\"";
        }
    }

    $img .= '/>';

    return $img;
}

/**
 * Esta função gera um link para um arquivo CSS.
 *
 * @access	public
 * @param	mixed	stylesheet hrefs ou um array
 * @param	string	rel
 * @param	string	type
 * @param	string	title
 * @param	string	media
 * @param	boolean	should index_page be added to the css path
 * @return	string
 */
function link_tag($href = '', $rel = 'stylesheet', $type = 'text/css', $title = '', $media = '', $index_page = FALSE) {

    $module = MJ_Router::getModuleName();
    
    $link = '<link ';

    if (is_array($href)) {
        foreach ($href as $k => $v) {
            $link .= 'href="' . BASE_URL . '/app/views/' . $v . '" ';
        }

        $link .= "/>";
    } else {

        $link .= 'href="' . BASE_URL . '/app/modules/'.$module.'/views/' . $href . '" ';

        $link .= 'rel="' . $rel . '" type="' . $type . '" ';

        if ($media != '') {
            $link .= 'media="' . $media . '" ';
        }

        if ($title != '') {
            $link .= 'title="' . $title . '" ';
        }

        $link .= '/>';
    }


    return $link;
}

/**
 * Esta função gera as meta-tags a partir de um array com key/values.
 *
 * @access	public
 * @param	array
 * @return	string
 */
function meta($name = '', $content = '', $type = 'name', $newline = "\n") {
    // Since we allow the data to be passes as a string, a simple array
    // or a multidimensional one, we need to do a little prepping.
    if (!is_array($name)) {
        $name = array(array('name' => $name, 'content' => $content, 'type' => $type, 'newline' => $newline));
    } else {
        // Turn single array into multidimensional
        if (isset($name['name'])) {
            $name = array($name);
        }
    }

    $str = '';
    foreach ($name as $meta) {
        $type = (!isset($meta['type']) OR $meta['type'] == 'name') ? 'name' : 'http-equiv';
        $name = (!isset($meta['name'])) ? '' : $meta['name'];
        $content = (!isset($meta['content'])) ? '' : $meta['content'];
        $newline = (!isset($meta['newline'])) ? "\n" : $meta['newline'];

        $str .= '<meta ' . $type . '="' . $name . '" content="' . $content . '" />' . $newline;
    }

    return $str;
}

/**
 * Esta função gera os espaços na quantidade especificada.
 *
 * @access	public
 * @param	integer
 * @return	string
 */
function nbs($num = 1) {
    return str_repeat("&nbsp;", $num);
}
