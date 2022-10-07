<?php

require_once('./app/models/generic_model.php');

class GenreModel extends GenericModel {

    function __construct(){
        parent::__construct("genres",
                            ["genre", "note"]);
    }
}