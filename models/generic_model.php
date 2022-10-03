<?php

require_once('./models/connection_db.php');

class GenericModel extends ConnectionDB {
    protected $table;

    function __construct($nameTable){
        parent::__construct();
        $this->table = $nameTable;
    }

    public function getAll() {
        $query = $this->db->prepare("SELECT * FROM $this->table;");
        $query->execute();
        
        $items = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $items;
    }

    public function getById ($id) {
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE id=?;");
        $query->execute([$id]);
        
        $item = $query->fetch(PDO::FETCH_OBJ);
        
        return $item;
    }

    
    /**
     * FILTRO GENÉRICO
     * filter debe ser un 
     */
    /*
    public function filter($filters, $selects = ["*"]) {

    }
    */
}