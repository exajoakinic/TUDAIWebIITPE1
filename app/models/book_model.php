<?php

require_once('./app/models/generic_model.php');

class BookModel extends GenericModel {

    function __construct(){
        parent::__construct("books",
                ['isbn', 'title', 'id_author', 'id_genre', 'price', 'url_cover'],
                ["fieldsOnSelect" => "books.*, authors.author, genres.genre",
                 "joinSentence" => "INNER JOIN authors ON authors.id = books.id_author INNER JOIN genres ON genres.id = books.id_genre",
                "orderByField" => "author,title"]);
    }

    function countByAuthor($id){
        return $this->countBy("id_author", $id);

        $query = $this->db->prepare("SELECT COUNT(*) AS result FROM $this->table WHERE id_author = ?");
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ)->result;
    }

    function countByGenre($id){
        return $this->countBy("id_genre", $id);

        $query = $this->db->prepare("SELECT COUNT(*) AS result FROM $this->table WHERE id_genre = ?");
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ)->result;
    }

    function getByAuthor($id) {
        return $this->getAllBy("id_author", $id);
    }
    function getByGenre($id) {
        return $this->getAllBy("id_genre", $id);
    }

}