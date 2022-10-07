<?php

class ConnectionDB {
    protected $db;
    private const host = 'localhost';
    private const dbname = 'db_books';
    private const user = 'root';
    private const password = '';
    
    function __construct() {
        $this->db = new PDO("mysql:host=" . ConnectionDB::host . ";dbname=" . ConnectionDB::dbname . ";charset=utf8", ConnectionDB::user, ConnectionDB::password);
    }
}
