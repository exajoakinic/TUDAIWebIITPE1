<?php

class ConnectionDB {
    protected $db;
    private const typeDb = 'mysql';
    private const host = 'localhost';
    private const dbname = 'id19679558_db_books';
    private const user = 'id19679558_root';
    private const password = '_g)mp9G@/VGhp7mx';
    
    function __construct() {
        $this->db = new PDO(ConnectionDB::typeDb . ":host=" . ConnectionDB::host . ";dbname=" . ConnectionDB::dbname . ";charset=utf8", ConnectionDB::user, ConnectionDB::password);
    }
}
