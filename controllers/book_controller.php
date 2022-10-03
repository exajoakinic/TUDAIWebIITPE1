<?php
require_once "./views/book_view.php";
require_once "./models/book_model.php";
require_once "./models/genre_model.php";
require_once "./models/author_model.php";

class BookController {
    private $model;
    private $view;
    
    function __construct() {
        $this-> model = new BookModel();
        $this-> view = new BookView();
    }

    function showAll() {
        $books = $this->model->getAll();
        $this->completeFieldsFromTables($books);
        $this->view->showAll($books, true);
    }
    
    function showByAuthor($id) {
        $books = $this->model->getByAuthor($id);
        $this->completeFieldsFromTables($books);
        $this->view->showAll($books, true);
    }
    function showByGenre($id) {
        $books = $this->model->getByGenre($id);
        $this->completeFieldsFromTables($books);
        $this->view->showAll($books, true);
    }

    private function completeFieldsFromTables($books) {
        $genreModel = new GenreModel();
        $authorModel = new AuthorModel();
        foreach($books as $book) {
            $book->genre = $genreModel->getById($book->id_genre)->genre;
            $book->author = $authorModel->getById($book->id_author)->author;
        }
    }
}