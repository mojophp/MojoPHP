<?php

if ( ! defined('BASE_PATH')) exit('Proibido o acesso direto ao script.');

/**
 * -----------------------------------------------------------------------------
 *                  CLASSE DE UPLOAD DO SISTEMA
 * -----------------------------------------------------------------------------
 * 
 * Esta classe reúne os métodos necessários para o funcionamento dos
 * uploads realizados no sistema.
 *
 * @author Eliel de Paula <elieldepaula@gmail.com>
 * @since 29/10/2010
 * @version 0.0.2
 * 
 */

class upload {

    private $destino;
    private $tmpNome;
    private $nome;
    private $tipo;

    function __construct() {
        
    }

    /**
     * -------------------------------------------------------------------------
     *                  setArquivo()
     * -------------------------------------------------------------------------
     * 
     * Este método prepara o arquivo para ser carregado, o parâmetro 'File' deve
     * ser setado com o receptor do formulário $_FILES['campo'];
     *
     * @param File $FileName
     * @return void
     * 
     */
    public function setArquivo($FileName) {
        
        $Arq = $FileName;
        $this->tmpNome = $Arq['tmp_name'];
        $this->nome = $Arq['name'];
        $this->tipo = $Arq['type'];
        
    }

    /**
     * -------------------------------------------------------------------------
     *                  setDestino()
     * -------------------------------------------------------------------------
     * 
     * Este método defini qual será o caminho em que o arquivo será salvo.
     *
     * <b>Nota: </b> Sempre verifique as permissões da pasta destino.
     *
     * @param String $var
     * @return void
     * 
     */
    public function setDestino($var) { 
        
        $this->destino = $var;
        
    }

    /**
     * -------------------------------------------------------------------------
     *                  getDestino()
     * -------------------------------------------------------------------------
     * 
     * Este método retorna o destino onde o arquivo será salvo.
     * 
     * @return String
     * 
     */
    public function getDestino() {
        
        return $this->destino;
        
    }

    /**
     * -------------------------------------------------------------------------
     *                  setNome()
     * -------------------------------------------------------------------------
     * 
     * Este método defini qual será o novo nome do arquivo a ser salvo, se não 
     * for usado o arquivo será salvo com o nome atual.
     * 
     * @param String $var
     * @return void
     * 
     */
    public function setNome($var) {
        
        $this->nome = $var;
        
    }

    /**
     * -------------------------------------------------------------------------
     *                  getNome()
     * -------------------------------------------------------------------------
     * 
     * Este método retorna o nome do arquivo que está sendo carregado.
     * 
     * @return String
     * 
     */
    public function getNome() {
        
        return $this->clear_name($this->nome, '_', true);
        
    }

    /**
     * -------------------------------------------------------------------------
     *                  upArquivo()
     * -------------------------------------------------------------------------
     * 
     * Este método carrega o arquivo para o destino indicado.
     * 
     * @return boolean
     * 
     */
    public function upArquivo() {
        
        return $this->uploadArquivo();
        
    }

    /**
     * -------------------------------------------------------------------------
     *                  uploadArquivo()
     * -------------------------------------------------------------------------
     * 
     * Este método efetua o real carregamento do arquivo para o destino 
     * informado com o método setDestino().
     *
     * @return boolean
     * 
     */
    private function uploadArquivo() {
        
        $caminhoFinal = $this->getDestino().$this->getNome();
        
        if(move_uploaded_file($this->tmpNome, $caminhoFinal)):
            
            return true;
        
        else:
            
            return false;
        
        endif;
        
    }
    
    private function clear_name($str, $separator = 'dash', $lowercase = FALSE) {

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
}

?>