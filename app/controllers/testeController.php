<?php

if ( ! defined('BASE_PATH')) exit('Acesso negado!');

class testeController extends MJ_Controller {

    function __construct() {
        parent::__construct();
        $this->loadHelper('url');
    }

    public function index() {
        // Aqui já testo o helper URL criando uma lista de menus para os outros métodos de teste.
        $out = '<ul>
                    <li>' . anchor('teste', 'Página inicial dos testes.') . '</li>
                    <li>' . anchor('teste/db', 'Teste de banco de dados.') . '</li>
                    <li>' . anchor('teste/views', 'Views') . '</li>
                    <li>' . anchor('#', 'Link 1') . '</li>
                </ul>';

        $dados['resultados'] = $out;
        $dados['mensagem'] = 'Esta página foi desenvolvida para testar os recursos do Mojo*PHP durante o desenvolvimento.';
        $this->loadView('teste', $dados);
    }

    /**
     * Este método foi criado para os testes durante o desenvolvimento das
     * classes de gerenciamento do banco de dados, além de outros recursos
     * do Mojo*PHP
     * 
     * @access public
     * @return void
     */
    public function views() {

        $this->loadHelper('url');
        $this->loadHelper('text');
        $this->loadHelper('encrypt');
        
        $menu = '<ul>
                    <li>' . anchor('teste', 'Página inicial dos testes.') . '</li>
                    <li>' . anchor('teste/db', 'Teste de banco de dados.') . '</li>
                    <li>' . anchor('teste/views', 'Views') . '</li>
                    <li>' . anchor('#', 'Link 1') . '</li>
                </ul>';
        
        $texto = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In elit ligula, tincidunt vel blandit vel, sollicitudin quis nibh.';
        $texto2 = '<?php echo "Olá mundo!"; ?>';
        
        $saida = $menu;
        $saida .= '<p><b>Original: </b>'.$texto.'</p>';
        $saida .= '<p><b>Word limit: </b>'.  word_limiter($texto, '7',' [mais...]').'</p>';
        $saida .= '<p><b>Character limit: </b>'.  character_limiter($texto, '80',' [mais...]').'</p>';
        $saida .= '<p><b>Word censor: </b>'.  word_censor($texto, array('ipsum', 'elit', 'vel'),' [beeeep!]').'</p>';
        $saida .= '<p><b>Hilight code: </b>'.  highlight_code($texto2).'</p>';
        $saida .= '<p><b>Hilight pharse: </b>'.  highlight_phrase($texto, 'In elit ligula, tincidunt vel blandit vel','<em>','</em>').'</p>';
        $saida .= '<p><b>Word wrap: </b>'.  word_wrap($texto).'</p>';
        $saida .= '<p><b>encode5(): MojoPHP = </b>'. encode5('MojoPHP').'</p>';
        $saida .= '<p><b>set_crypt(): MojoPHP = </b>'. set_crypt('MojoPHP').'</p>';
        $saida .= '<p><b>set_crypt(whirlpool): MojoPHP = </b>'. set_crypt('MojoPHP', 'whirlpool').'</p>';
        $saida .= '';
        $saida .= '';

        $view_interna = $this->loadView('interno', null, true);

        $dados['resultados'] = $saida;
        $dados['mensagem'] = 'Esta página foi desenvolvida para testar os recursos do Mojo*PHP durante o desenvolvimento.';

        $this->loadView('teste', $dados);
    }

    /**
     * Este método foi criado para testes durante o desenvolvimento das
     * classes da camada de dados do Mojo*PHP.
     * 
     * @access public
     * @return void
     */
    public function db() {

        $menu = '<ul>
                     <li>' . anchor('teste', 'Página inicial dos testes.') . '</li>
                     <li>' . anchor('teste/db', 'Teste de banco de dados.') . '</li>
                     <li>' . anchor('teste/views', 'Views') . '</li>
                     <li>' . anchor('#', 'Link 1') . '</li>
                 </ul>';

        $this->loadHelper('url');
        $this->loadModel('usuarios');

        /* ----- Testes do datasource ----- */

        //$saida = $this->load('usuarios')->get_lista_usuarios();

        /* ----- Fim dos testes do datasource ----- */

        $dados_internos['titulo_pagina'] = 'Teste do banco de dados.';
        $dados_internos['teste_db'] = $menu . $saida;
        
        $view_interna = $this->loadView('teste_db',$dados_internos,true);
        
        $dados['resultados'] = $view_interna;
        $dados['mensagem'] = 'Esta página foi desenvolvida para testar os recursos do Mojo*PHP durante o desenvolvimento.';

        $this->loadView('teste', $dados);
    }
    
    public function testemodel(){
        $this->loadModel('usuarios');
        echo $this->load('usuarios')->testando();
    }
}