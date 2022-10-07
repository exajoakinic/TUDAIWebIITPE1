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