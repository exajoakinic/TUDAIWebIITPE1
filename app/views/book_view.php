<?php
require_once "./app/views/generic_view.php";

class BookView extends GenericView{
    
    function showBookCard($book, $title = "Ficha de libro") {
        $this->smarty->assign("title", $title);
        $this->smarty->assign("book", $this->sanitizeHTML($book));
        $this->smarty->display("book/book_card.tpl");
    }

    function showFullSizeCover($book, $title) {
        $this->smarty->assign("book", $this->sanitizeHTML($book));
        $this->smarty->assign("title", $title);
        $this->smarty->display("book/book_show_cover_full_size.tpl");
    }

    function showAll($books, $title = "Listado de Libros", $message=null) {
        $this->smarty->assign("title", $title);
        $this->smarty->assign("message", $message);
        $this->smarty->assign("books", $this->sanitizeHTML($books));
        $this->smarty->display("book/list.tpl");
    }    

    function list($books) {
        $this->smarty->assign("books", $this->sanitizeHTML($books));
        $this->smarty->display("book/only_list.tpl");
    }

    function showEditForm ($book, $authors, $genres) {
        $this->smarty->assign("title", "Editar Libro");
        $this->smarty->assign("action", "books/edit/$book->id");
        $this->smarty->assign("authors", $authors);
        $this->smarty->assign("genres", $genres);
        $this->smarty->assign("book", $book);
        $this->smarty->display("book/form.tpl");
    }

    function showAddForm ($authors, $genres) {
        $book = new stdClass();
        $book->isbn = "";
        $book->title = "";
        $book->id_author = "";
        $book->id_genre = "";
        $book->price = "";
        $book->url_cover = "";

        $this->smarty->assign("authors", $authors);
        $this->smarty->assign("genres", $genres);
        $this->smarty->assign("title", "Agregar Libro");
        $this->smarty->assign("action", "books/add/");
        $this->smarty->assign("book", $book);
        $this->smarty->display("book/form.tpl");
    }

    function showErrorCantRemove($book) {
        $this->smarty->assign("title", "ELIMINAR GÉNERO");
        $this->smarty->assign("book", $book);
        $this->smarty->display("book/cant_remove.tpl");
    }

    function showErrorNotFinded(){
        $this->showError("No se encontró el libro solicitado", "Error al buscar libro");
    }
}