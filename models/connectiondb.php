<?php

class ConnectionDB {

    function getDB() {
        $HOST = 'localhost';
        $DBNAME = "db_books";
        $USER = 'root';
        $PASSWORD = '';

        $db = new PDO("mysql:host=" . $HOST .";dbname=" . $DBNAME . ";charset=utf8", $USER, $PASSWORD);
        return $db;
    }
}
