<?php

require_once "./models/genre_model.php";
require_once "./views/genre_view.php";
require_once "./models/book_model.php";

class GenreController {
    private $model;
    private $view;
    
    function __construct() {
        $this-> model = new GenreModel();
        $this-> view = new GenreView();
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

        //VALIDA QUE SE RECIBIERON LOS DATOS QUE SE NECESITAN
        if (!isset($_POST['genre']) || !isset($_POST['note'])) {
            $this->view->showError("No se pudo editar porque no se recibieron todos los datos necesarios para realizar la operación. La operación solicitada ha sido cancelada", "Error al editar, respuesta inválida");
            return;
        }

        //EDITA CON LOS DATOS LO RECIBIDO POR POST
        $genre = new stdClass();
        $genre->id = $id;
        $genre->genre = $_POST['genre'];
        $genre->note = $_POST['note'];

        $this->model->edit($genre);
        header("location:" . BASE_URL . "genres");
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