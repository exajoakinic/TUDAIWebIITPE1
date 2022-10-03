<?php

require_once('./models/generic_model.php');

class GenreModel extends GenericModel {

    function __construct(){
        parent::__construct("genres");
    }

    public function edit ($genre) {
        $query = $this->db->prepare("UPDATE $this->table SET genre = ?, note = ? WHERE id = ?");
        $query->execute([$genre->genre, $genre->note, $genre->id]);
    }

    public function remove ($id) {
        $query = $this->db->prepare("DELETE FROM $this->table WHERE id = ?");
        $query->execute([$id]);
    }
}