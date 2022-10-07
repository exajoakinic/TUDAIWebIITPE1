<?php

require_once('./app/models/generic_model.php');

class AuthorModel extends GenericModel {

    function __construct(){
        parent::__construct("authors",
                            ["author", "note"]);
    }
}