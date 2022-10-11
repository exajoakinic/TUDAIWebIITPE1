<?php

class ConnectionDB {
    protected $db;
    private const typeDb = 'mysql';
    private const host = 'localhost';
    private const dbname = 'id19689598_db_books';
    private const user = 'id19689598_root';
    private const password = '%CBPkw>P9>v(8PRi';
    
    function __construct() {
        $this->db = new PDO(ConnectionDB::typeDb . ":host=" . ConnectionDB::host . ";dbname=" . ConnectionDB::dbname . ";charset=utf8", ConnectionDB::user, ConnectionDB::password);
    }
}
