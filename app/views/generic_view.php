<?php

class GenericView {
    protected $smarty;

    function __construct(){
        $this->smarty = new Smarty(); 
    }

    function showError($message, $title) {
        $this->smarty->assign("title", $title);
        $this->smarty->assign("message", $message);
        $this->smarty->display("generic_error.tpl");
    }

    /**
     * MODIFICA LOS CARACTERES ESPECIALES POR CARACTERES 
     * SEGUROS EN HTML, PARA CADA ATRIBUTO DEL OBJETO
     */
    protected function sanitizeHTML($objetc) {
        foreach($objetc as $key => $value) {
            if (is_object($value)) {
                $this->sanitizeHTML($value);
            } else if (is_array($objetc)) {
                $objetc[$key] = htmlspecialchars($value);
            } else {
                $objetc->$key = htmlspecialchars($value);
            }
    }
        return $objetc;
    }
    protected function showHeader($title) {
        $this->smarty->assign("title", $title);
        $this->smarty->display("header.tpl");
    }
    protected function showFooter() {
        $this->smarty->display("footer.tpl");
    }
}