<?php

require_once('./models/generic_model.php');

class AuthorModel extends GenericModel {

    function __construct(){
        parent::__construct("authors");
    }

    public function edit ($author) {
        $query = $this->db->prepare("UPDATE $this->table SET author = ?, note = ? WHERE id = ?");
        $query->execute([$author->author, $author->note, $author->id]);
    }

    public function remove ($id) {
        $query = $this->db->prepare("DELETE FROM $this->table WHERE id = ?");
        $query->execute([$id]);
    }

}