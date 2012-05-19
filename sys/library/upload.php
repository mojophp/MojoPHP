<?php

if ( ! defined('BASE_PATH')) exit('Proibido o acesso direto ao script.');

/**
 * -----------------------------------------------------------------------------
 *                  CLASSE DE UPLOAD DO SISTEMA
 * -----------------------------------------------------------------------------
 * 
 * Esta classe re�ne os m�todos necess�rios para o funcionamento dos
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
     * Este m�todo prepara o arquivo para ser carregado, o par�metro 'File' deve
     * ser setado com o receptor do formul�rio $_FILES['campo'];
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
     * Este m�todo defini qual ser� o caminho em que o arquivo ser� salvo.
     *
     * <b>Nota: </b> Sempre verifique as permiss�es da pasta destino.
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
     * Este m�todo retorna o destino onde o arquivo ser� salvo.
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
     * Este m�todo defini qual ser� o novo nome do arquivo a ser salvo, se n�o 
     * for usado o arquivo ser� salvo com o nome atual.
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
     * Este m�todo retorna o nome do arquivo que est� sendo carregado.
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
     * Este m�todo carrega o arquivo para o destino indicado.
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
     * Este m�todo efetua o real carregamento do arquivo para o destino 
     * informado com o m�todo setDestino().
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