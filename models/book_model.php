<?php

require_once('./models/generic_model.php');

class BookModel extends GenericModel {

    function __construct(){
        parent::__construct("books");
    }

    function countByAuthor($id){
        $query = $this->db->prepare("SELECT COUNT(*) AS result FROM $this->table WHERE id_author = ?");
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ)->result;
    }

    function countByGenre($id){
        $query = $this->db->prepare("SELECT COUNT(*) AS result FROM $this->table WHERE id_genre = ?");
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ)->result;
    }

    function getByAuthor($id) {
        return $this->getBy($id, "id_author");
    }
    function getByGenre($id) {
        return $this->getBy($id, "id_genre");
    }
    private function getBy($id, $field) {
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE $field=?;");
        $query->execute([$id]);
        
        $items = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $items;
    }
    private function getByLike($id, $field) {
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE id_author=?;");
        $query->execute([$id]);
        
        $items = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $items;
    }
    /*
    public function edit ($author) {
        $query = $this->db->prepare("UPDATE $this->table SET author = ?, note = ? WHERE id = ?");
        $query->execute([$author->author, $author->note, $author->id]);
    }

    public function remove ($id) {
        $query = $this->db->prepare("DELETE FROM $this->table WHERE id = ?");
        $query->execute([$id]);
    }
    */
}