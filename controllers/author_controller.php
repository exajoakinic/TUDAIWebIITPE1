<?php

require_once "./models/author_model.php";
require_once "./views/author_view.php";
require_once "./models/book_model.php";

class AuthorController {
    private $model;
    private $view;
    
    function __construct() {
        $this-> model = new AuthorModel();
        $this-> view = new AuthorView();
    }

    function showAll() {
        $items = $this-> model-> getAll();
        $this-> view-> showAll($items);
    }

    /**
     * EDITAR AUTOR
     * Si recibe datos por POST modifica el autor, sino muestra el formulario de edición
     */
    public function edit ($id) {
        if (empty($_POST)) {
            //MUESTRA FORMULARIO DE EDICIÓN
            $item = $this-> model-> getById($id);
            $this-> view-> showEditForm($item);
            return;
        }
        //EDITA CON LOS DATOS LO RECIBIDO POR POST
        $author = new stdClass();
        $author->id = $id;
        $author->author = $_POST['author'];
        $author->note = $_POST['note'];

        $this->model->edit($author);
        header("location:" . BASE_URL . "authors");
    }

    public function remove ($id) {
        //Verifico si hay autores cargados con ese id
        $modelBook = new BookModel();  
        if ($modelBook->countByAuthor($id) > 0) {
            $author = $this->model->getById($id);
            $this->view->showErrorCantRemove($author);
            return;
        }
        
        //Como no hay autores cargados, elimina sin problemas
        $this->model->remove($id);
        header("location:" . BASE_URL . "authors");
    }
}