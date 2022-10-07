<?php

class AuthView{
    protected $smarty;

    function __construct(){
        $this->smarty = new Smarty();
    }

    function showLoginForm($error = "") {
        $this->smarty->assign("error", $error);
        $this->smarty->display("loginForm.tpl");
    }
}