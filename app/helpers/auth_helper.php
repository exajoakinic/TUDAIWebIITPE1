<?php

class AuthHelper {

     /**
     * Verifica que el user este logueado y si no lo está
     * lo redirige al login.
     */
    public static function checkLoggedIn() {
        session_start();
        if (!isset($_SESSION['USER_ID'])) {
            header("Location: " . BASE_URL . 'login');
            die();
        }
    } 
}