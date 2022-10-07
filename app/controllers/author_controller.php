<?php
require_once "./app/controllers/generic_controller.php";
require_once "./app/models/author_model.php";
require_once "./app/views/author_view.php";
require_once "./app/models/book_model.php";

class AuthorController extends GenericController {
 
    function __construct() {
        parent::__construct(new AuthorModel(),
                            new AuthorView(),
                            ["author", "note"]);
    }

    protected function redirectionAfterEdit($id) {
        header("location:" . BASE_URL . "authors");
    }
    protected function redirectionAfterAdd($id) {
        header("location:" . BASE_URL . "authors");
    }
    protected function redirectionAfterRemove($removedItem) {
        header("location:" . BASE_URL . "authors");
    }
    
    protected function getAndValidateBeforeRemove($id) {
        //Traigo el elemento utilizando la clase padre y su primera validación de existencia
        $author = parent::getAndValidateBeforeRemove($id);
        $bookModel = new BookModel();  

        if ($bookModel->countByAuthor($id) > 0) {
            //MUESTRO PÁGINA DE ERROR PORQUE NO SE PUEDE BORRAR EL AUTOR
            $referencedBooks = (new BookController())->getByAuthor($id);
            $this->view->showErrorCantRemove($author, $referencedBooks);
            die;
        }
        return $author;
    }

}


    /* SE PASÓ A CLASE PADRE
    protected function getAndValidateFromPost() {
        $author = new stdClass();
        $author->author = $_POST['author'];
        $author->note = $_POST['note'];
        return $author;
    }
    */

    /* SE PASÓ A LA CLASE PADRE
    /**
     * AGREGAR AUTOR
     * Si recibe datos por POST modifica el autor,
     * sino muestra el formulario de agregardo
     */
    /*
    public function add () {
        //AGREGA AUTOR CON LOS DATOS LO RECIBIDO POR POST
        $author = $this->getFromPost(0);

        $this->model->add($author);
        header("location:" . BASE_URL . "authors");
    }
    */

    
    /* SE PASÓ A LA CLASE PADRE
    public function remove ($id) {
        //Verifico si hay autores cargados con ese id
        $bookModel = new BookModel();  
        if ($bookModel->countByAuthor($id) > 0) {
            //MUESTRO PÁGINA DE ERROR PORQUE NO SE PUEDE BORRAR EL AUTOR
            $author = $this->model->getById($id);
            
            $referencedBooks = (new BookController())->getByAuthor($id);
            $this->view->showErrorCantRemove($author, $referencedBooks);
            return;
        }
        
        //Como no hay autores cargados, elimina sin problemas
        $this->model->remove($id);
        header("location:" . BASE_URL . "authors");
    }
    */