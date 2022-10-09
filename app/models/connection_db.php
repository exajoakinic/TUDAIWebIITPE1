<?php

class ConnectionDB {
    protected $db;
    private const typeDb = 'mysql';
    private const host = 'localhost';
    private const dbname = 'id19685369_db_books';
    private const user = 'id19685369_root';
    private const password = 'h+SBRn$Yjto8{/+W';
    
    function __construct() {
        $this->db = new PDO(ConnectionDB::typeDb . ":host=" . ConnectionDB::host . ";dbname=" . ConnectionDB::dbname . ";charset=utf8", ConnectionDB::user, ConnectionDB::password);
    }
}
