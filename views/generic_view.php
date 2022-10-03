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
}