<?php
require_once "./app/controllers/generic_controller.php";
require_once "./app/models/genre_model.php";
require_once "./app/views/genre_view.php";
require_once "./app/models/book_model.php";

class GenreController extends GenericController {
 
    function __construct() {
        parent::__construct(new GenreModel(),
                            new GenreView(),
                            ["genre", "note"]);
    }

    protected function redirectionAfterEdit($id) {
        header("location:" . BASE_URL . "genres");
    }
    protected function redirectionAfterAdd($id) {
        header("location:" . BASE_URL . "genres");
    }
    protected function redirectionAfterRemove($removedItem) {
        header("location:" . BASE_URL . "genres");
    }
    
    protected function getAndValidateBeforeRemove($id) {
        //Traigo el elemento utilizando la clase padre y su primera validación de existencia
        $genre = parent::getAndValidateBeforeRemove($id);
        $bookModel = new BookModel();  

        if ($bookModel->countByGenre($id) > 0) {
            //MUESTRO PÁGINA DE ERROR PORQUE NO SE PUEDE BORRAR EL AUTOR
            $referencedBooks = (new BookController())->getByGenre($id);
            $this->view->showErrorCantRemove($genre, $referencedBooks);
            die;
        }
        return $genre;
    }

}

/*
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


    
    public function edit ($id) {
        if (empty($_POST)) {
            //MUESTRA FORMULARIO DE EDICIÓN SI EXISTE EL GÉNERO
            $item = $this-> model-> getById($id);
            if (empty($item)) {
                $this->view->showErrorNotFinded();
                header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
                die;
            }
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

    
    public function add () {
        if (empty($_POST)) {
            //MUESTRA FORMULARIO
            $this-> view-> showAddForm();
            return;
        }
        //AGREGA AUTOR CON LOS DATOS LO RECIBIDO POR POST
        $genre = new stdClass();
        $genre->genre = $_POST['genre'];
        $genre->note = $_POST['note'];

        $this->model->add($genre);
        header("location:" . BASE_URL . "genres");
    }

    public function remove ($id) {
        //Verifico si hay autores cargados con ese id
        $modelBook = new BookModel();  
        if ($modelBook->countByGenre($id) > 0) {
            //MUESTRO PÁGINA DE ERROR PORQUE NO SE PUEDE BORRAR EL AUTOR
            $genre = $this->model->getById($id);
            $referencedBooks = (new BookController())->getByGenre($id);
            $this->view->showErrorCantRemove($genre, $referencedBooks);
            return;
        }
        
        //Como no hay autores cargados, elimina sin problemas
        $this->model->remove($id);
        header("location:" . BASE_URL . "genres");
    }
}
*/