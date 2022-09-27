<?php

require_once('models/connectiondb.php');

class AuthorModel {
    private $db;

    function __construct() {
        //$connection = new ConnectionDB();
        $this->db = (new ConnectionDB())->getDB();
    }

    public function getAll() {
        $query = $this->db->prepare("SELECT * FROM authors");
        $query->execute();
    
        
        $authors = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $authors;
    }

    public function getById ($id) {
        $query = $this->db->prepare("SELECT * FROM authors WHERE id=?;");
        $query->execute([$id]);
        
        $author = $query->fetch(PDO::FETCH_OBJ);
        
        return $author;
    }
}