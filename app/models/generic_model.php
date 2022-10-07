<?php

require_once('./app/models/connection_db.php');

class GenericModel extends ConnectionDB {
    protected $table;
    private $fields;

    function __construct($nameTable, $fields){
        parent::__construct();
        $this->table = $nameTable;
        $this->fields = $fields;
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

    public function remove ($id) {
        $query = $this->db->prepare("DELETE FROM $this->table WHERE id = ?");
        $query->execute([$id]);
    }
    

    public function edit ($item) {
        $sql = "";
        $values = [];
        foreach ($item as $field => $value) {
            if ($field != "id"){
                if ($sql) {
                    $sql = "$sql, ";
                }
                $sql = "$sql$field = ?";
                $values[] = $value;
            }
        }
        $sql = "UPDATE $this->table SET $sql WHERE id = ?";
        $values[] = $item->id;
        var_dump($sql, "<br>", $values);
        echo "<br>" . count($values);
        $query = $this->db->prepare("$sql");
        
        $query->execute($values);
    }

    public function add ($item) {
        $listFields = "";
        $questionMarks ="";
        $values = [];
        foreach ($item as $field => $value) {
            if ($field != "id"){
                if ($listFields) {
                    $listFields = "$listFields, ";
                    $questionMarks = "$questionMarks, ";
                }
                $listFields = $listFields . $field;
                $questionMarks = $questionMarks . "?";
                $values[] = $value;
            }
        }
        $sql = "INSERT INTO  $this->table ($listFields) VALUES ($questionMarks)";
        echo $sql;
        $query = $this->db->prepare($sql);
        $query->execute($values);

        return $this->db->lastInsertId();
    }
}