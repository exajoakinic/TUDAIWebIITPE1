<?php

class AuthHelper {
    /**
     * INICIA LA SESIÓN, EN CASO DE QUE NO ESTÉ YA ACTIVA
     */
    public static function openSession() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }  
    }

     /**
     * Verifica que el user este logueado y si no lo está
     * lo redirige al login.
     */
    public static function checkLoggedIn() {
        AuthHelper::openSession();
        if (!isset($_SESSION['USER_ID'])) {
            header("Location: " . BASE_URL . 'login');
            die();
        }
    }

    
}