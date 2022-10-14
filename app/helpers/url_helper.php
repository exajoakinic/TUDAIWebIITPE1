<?php

class UrlHelper {
    public static function toURL($str) {
        //Primero se hacía esto utilizando pipes en el template
        //{$genre->genre|lower|regex_replace:'/[^abcdefghijklmnopqrstuvwxyz1234567890\s]+/':''|regex_replace:'/[\s]+/':'-'|regex_replace:'/--/':'-'
        $res = strtolower($str);
        //reemplza expacios por guiones
        $res = preg_replace('/[\s]+/', '-', $res);
        //reemplza guiones dobles
        $res = preg_replace('/--/', '-', $res);
        //elimina caracteres que no sean letras, números o guiones
        $res = preg_replace('/[^abcdefghijklmnopqrstuvwxyz1234567890-]+/', '', $res);
        return $res;
    }
}