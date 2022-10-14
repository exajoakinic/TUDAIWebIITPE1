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
        //header("location:" . BASE_URL . "books");
        $this->listSome("Se ha eliminado correctamente el libro '$removedItem->title'");
    }
    
    /**
     * MUESTRA TODOS LOS ITEMS DE LA ENTIDAD
     */
    function showAll($message = null) {
        $items = $this-> model-> getAll();
        $this-> view-> showAll($items, "Listado de libros", $message);
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


    function showByGenre($id, $params = ["title"  => ""]) {
        //Verifico existencia del género
        $genre = (new GenreModel)->getById($id);
        if (!($genre)) {
            $this->view->showError("No se encontró el género", "Error al obtener género");
            header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
            die;
        }
        
        $books = $this->model->getByGenre($id);
        $title = "Libros con género &quot$genre->genre&quot";
        $this->view->showAll($books, $title);
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
        $this->view->showAll($books, "Libros con autor &quot$author->author&quot");
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

    /**
     * Lista algunos libros de forma aleatoria
     * Se utilizó para no sobrecargar de gusto el servidor
     * Lo ideal habría sido paginar.
     */
    public function listSome($message = null)  {
        $cant = 30;
        $books = $this->model->getAll();
        if (count($books) < $cant) {
            $cant = count($books);
        }
        $selectedKeys = array_rand($books, $cant);
        $booksToShow = [];
        foreach($selectedKeys as $key) {
            $booksToShow[] = $books[$key];
        }
        $this->view->showAll($booksToShow, "Algunos de nuestros libros...", $message);
    }
}