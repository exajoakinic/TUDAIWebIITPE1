<?php

require_once "models/author_model.php";
require_once "views/author_view.php";

class AuthorController {
    private $model;
    private $view;
    
    function __construct() {
        $this->model = new AuthorModel();
        $this->view = new AuthorView();
    }

    function getAll() {
        echo 'get all authors';
        $author = $this->model->getById(8);
        $authors = $this->model->getAll();
        var_dump($author);
    }

}