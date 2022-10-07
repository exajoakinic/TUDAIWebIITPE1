<?php

class GenericView {
    protected $smarty;

    function __construct(){
        $this->smarty = new Smarty();
        echo session_status();
        if (session_status() != 2) {
            session_start();
        }   
    }

    function showError($message, $title) {
        $this->smarty->assign("title", $title);
        $this->smarty->assign("message", $message);
        $this->smarty->display("generic_error.tpl");
    }
}