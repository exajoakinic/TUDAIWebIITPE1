<?php

require_once('./app/models/connection_db.php');

class GenericModel extends ConnectionDB {
    protected $table;
    private $fields;
    private $fieldsOnSelect;
    private $joinSentence;
    private $orderByField;
    private $orderBySentence;

    function __construct($nameTable, $fields, 
            $params = [ "fieldsOnSelect" => "*",
                        "joinSentence" => "",
                        "orderByField" => ""]){
        parent::__construct();
        $this->table = $nameTable;
        $this->fields = $fields;
        $this->fieldsOnSelect = $params["fieldsOnSelect"] ?? "*";
        $this->joinSentence = $params["joinSentence"] ?? "";

        $this->setOrderBy($params["orderByField"] ?? "");
    }

    private function setOrderBy($field) {
        if (empty($field)) {
            $this->orderBySentence = "";
        }

        $this->orderBySentence = "ORDER BY $field";
    }

    public function getAll() {
        $query = $this->db->prepare("SELECT $this->fieldsOnSelect FROM $this->table $this->joinSentence $this->orderBySentence;");
        $query->execute();
        
        $items = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $items;
    }
    
    /**
     * getAllBy($field, $value)
     * DEVUELVE TODOS LOS REGISTROS CON $field = $value
     */
    function getAllBy($field, $value) {
        $query = $this->db->prepare("SELECT $this->fieldsOnSelect FROM $this->table $this->joinSentence WHERE $field=? $this->orderBySentence;");
        $query->execute([$value]);
        
        $items = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $items;
    }

    /**
     * getBy($field, $value)
     * DEVUELVE PRIMER OCURRENCIA CON $field = $value
     * $field debe ser un campo de la tabla correspondiente al modelo.
     */
    public function getBy($localField, $value) {
        // Se intentó reemplazar $field por ? pero la $query devolvía siempre false
        // entiendo esto no supone un problema de seguridad dado que no es el 
        // usuario quien completa el campo field.

        $query = $this->db->prepare("SELECT $this->fieldsOnSelect FROM $this->table $this->joinSentence WHERE  $this->table.$localField = ?;");
        $query->execute([$value]);
        
        $item = $query->fetch(PDO::FETCH_OBJ);

        return $item;
    }
    
    public function getById ($id) {
        return $this->getBy("id", $id);
        
    }

    public function remove ($id) {
        $query = $this->db->prepare("DELETE FROM $this->table WHERE id = ?");
        $query->execute([$id]);
    }
    

    public function edit ($item) {
        $sql = "";
        $values = [];
        foreach ($item as $field => $value) {
            //Verifica que exista el campo para prevenir inyección de un
            //controlador malicioso, o tonto que pase un field escrito por el usuario
            if (in_array($field, $this->fields) && $field != "id"){
                if ($sql) {
                    $sql = "$sql, ";
                }
                $sql = "$sql$field = ?";
                $values[] = $value;
            }
        }

        $sql = "UPDATE $this->table SET $sql WHERE id = ?";
        $values[] = $item->id;

        $query = $this->db->prepare("$sql");
        
        $query->execute($values);
    }

    public final function add ($item) {
        $listFields = "";
        $questionMarks ="";
        $values = [];
        foreach ($item as $field => $value) {
            //Verifica exista el campo para prevenir inyección sql
            //de un controlador malicioso:
            if (!in_array($field, $this->fields)) {
                return false;
            }
            if (in_array($field, $this->fields) && $field != "id"){
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

        $query = $this->db->prepare($sql);
        $query->execute($values);

        return $this->db->lastInsertId();
    }

    function countBy($localField, $id){
        $query = $this->db->prepare("SELECT COUNT(*) AS result FROM $this->table WHERE $this->table.$localField = ?");
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ)->result;
    }
}