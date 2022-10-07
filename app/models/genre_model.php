<?php

require_once('./app/models/generic_model.php');

class GenreModel extends GenericModel {

    function __construct(){
        parent::__construct("genres",
                            ["genre", "note"]);
    }
}

    //SE ABSTRAJERON EN GenericModel
    /*
    public function edit ($genre) {
        $query = $this->db->prepare("UPDATE $this->table SET genre = ?, note = ? WHERE id = ?");
        $query->execute([$genre->genre, $genre->note, $genre->id]);
    }
    */
    /*
    public function add ($genre) {
        $query = $this->db->prepare("INSERT INTO  $this->table (genre, note) VALUES(?, ?)");
        $query->execute([$genre->genre, $genre->note]);

        return $this->db->lastInsertId();
    }
    */