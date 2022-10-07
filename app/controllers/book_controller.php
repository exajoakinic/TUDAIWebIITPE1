<?php
require_once "./app/controllers/generic_controller.php";
require_once "./app/views/book_view.php";
require_once "./app/models/book_model.php";
require_once "./app/models/genre_model.php";
require_once "./app/models/author_model.php";


class BookController extends GenericController {
    function __construct() {
        parent::__construct(new BookModel(),
                            new BookView(),
                ['isbn', 'title', 'id_author', 'id_genre', 'price', 'url_cover']);
    }

    protected function redirectionAfterEdit($id) {
        header("location:" . BASE_URL . "book/$id");
    }
    protected function redirectionAfterAdd($id) {
        header("location:" . BASE_URL . "book/$id");
    }
    protected function redirectionAfterRemove($removedItem) {
        header("location:" . BASE_URL . "books");
    }

    //CON ESTOS MÉTODOS ESTOY ROMPIENDO EL MODELO MVC, 
    //PORQUE LLAMO A ESTE CONTROLLER DESDE OTROS CONTROLLERS
    //PENSÉ HACER UN HELPER, PERO TAMBIÉN LO ESTARÍA ROMPIENDO PORQUE
    //EL HELPER NO DEBERÍA LLAMAR AL MODEL.
    //SÓLO ME QUEDARÍA LA OPCIÓN DE REPETIR CÓDIGO, PERO NO QUIERO HACER ESO
    //LA SOLUCIÓN SERÍA UTILIZAR EL INNER JOIN Y QUE ESTAS FUNCIONES ESTÉN 
    //EN EL MODEL
    //
    /**
     * TRAE LOS LIBROS POR GENERO y completa los datos
     * desde tablas secundarias por php
     */
    function getByGenre($id) {
        $books = $this->model->getByGenre($id);
        $this->completeFields($books);
        return $books;
    }
    /**
     * TRAE LOS LIBROS POR AUTOR y completa los datos
     * desde tablas secundarias por php
     */
    function getByAuthor($id) {
        $books = $this->model->getByAuthor($id);
        $this->completeFields($books);
        return $books;
    }

    /**
     * MUESTRA FICHA DE LIBRO LUEGO DE VALIDAR SU EXISTENCIA
     */
    function showBookCard($id) {
        $book = empty($id) ? null : $this->model->getById($id);
        if (!($book)) {
            $this->view->showErrorNotFinded();
            header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
            die;
        }

        $this->completeFields([$book]);

        $this->view->showBookCard($book, $book->title);
    }

    /**
     * MUESTRA VISTA CON TAPA LUEGO DE VALIDAR EXISTENCIA DEL LIBRO
     */
    function showFullSizeCover($id) {
        $book = empty($id) ? null : $this->model->getById($id);
        if (!($book)) {
            $this->view->showErrorNotFinded();
            header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
            die;
        }
        
        $this->view->showFullSizeCover($book, "$book->title (tapa)");
    }


    /**
     * MUESTRA FORMULARIO EDICIÓN
     * (sobreescrive función padre porque tiene requerimientos adicionales)
     */
    function showEditForm ($id) {
        //VERIFICA QUE ESTÉ LOGUEADO
        AuthHelper::checkLoggedIn();

        //VERIFICA SI EXISTE EL LIBRO A EDITAR
        $item = $this-> model-> getById($id);
        if (!($item)) {
            $this->view->showErrorNotFinded();
            header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
            die;
        }

        $authors = (new AuthorModel)->getAll();
        $genres = (new GenreModel)->getAll();
        
        $this->view->showEditForm($item, $authors, $genres);
    }

    /**
     * MUESTRA FORMULARIO AGREGAR
     * (sobreescrive función padre porque tiene requerimientos adicionales)
     */
    function showAddForm () {
        //VERIFICA QUE ESTÉ LOGUEADO
        AuthHelper::checkLoggedIn();

        $authors = (new AuthorModel)->getAll();
        $genres = (new GenreModel)->getAll();
        
        $this->view->showAddForm($authors, $genres);
    }


    function showByGenre($id) {
        //Verifico existencia del género
        $genre = (new GenreModel)->getById($id);
        if (!($genre)) {
            $this->view->showError("No se encontró el género", "Error al obtener género");
            header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
            die;
        }
        
        $books = $this->model->getByGenre($id);
        $this->completeFields($books);
        $this->view->showAll($books, "Libros con género &quot$genre->genre&quot");
    }
        
    function showByAuthor($id) {
        //Verifico existencia del autor
        $author = (new AuthorModel)->getById($id);
        if (!($author)) {
            $this->view->showError("No se encontró el autor", "Error al obtener autor");
            header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
            die;
        }

        $books = $this->model->getByAuthor($id);
        $this->completeFields($books);
        $this->view->showAll($books, "Libros con autor &quot$author->author&quot");
    }

    /**
     * Completa datos de cada elemento de un arreglo con libros
     */
    protected function completeFields($books) {
        $genreModel = new GenreModel();
        $authorModel = new AuthorModel();
        foreach($books as $book) {
            $book->genre = $genreModel->getById($book->id_genre)->genre;
            $book->author = $authorModel->getById($book->id_author)->author;
        }
    }

    /**
     * Sobreescrive función de validación de post por necesitar más validaciones
     */
    protected function getAndValidateFromPost() {
        $book = parent::getAndValidateFromPost();
        if (!(new AuthorModel)->getById($book->id_author)) {
            $this->view->showError("No se encontró el autor", "Error al obtener autor");
            header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
            die;
        }
        if (!(new GenreModel)->getById($book->id_genre)) {
            $this->view->showError("No se encontró el género", "Error al obtener género");
            header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
            die;
            }
        return $book;
    }

    public function listSome($cant = 50)  {
        $books = $this->model->getAll();
        $keysToShow = array_rand($books, $cant);
        $booksToShow = [];
        foreach($keysToShow as $key) {
            $booksToShow[] = $books[$key];
        }
        $this->completeFields($booksToShow);
        $this->view->showAll($booksToShow, "Algunos de nuestros libros...");
    }
}