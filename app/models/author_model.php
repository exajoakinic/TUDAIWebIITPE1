<?php

require_once('./app/models/generic_model.php');

class AuthorModel extends GenericModel {

    function __construct(){
        parent::__construct("authors",
                            ["genre", "note"]);
    }
}

    //SE ABSTRAJERON EN GenericModel
    /*
    public function edit ($author) {
        $query = $this->db->prepare("UPDATE $this->table SET author = ?, note = ? WHERE id = ?");
        $query->execute([$author->author, $author->note, $author->id]);
    }
    */
    /*
    public function add ($author) {
        $query = $this->db->prepare("INSERT INTO  $this->table (author, note) VALUES(?, ?)");
        $query->execute([$author->author, $author->note]);

        return $this->db->lastInsertId();
    }
    */