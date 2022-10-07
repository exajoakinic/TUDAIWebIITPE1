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