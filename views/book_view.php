<?php
require_once "./views/generic_view.php";

class BookView extends GenericView{
    
    function showAll($books, $isAdmin = true, $title = "Listado de libros") {
        $this->smarty->assign("title", $title);
        $this->smarty->assign("books", $books);
        $this->smarty->display("book/list.tpl");
    }

    function showEditForm ($book) {
        $this->smarty->assign("title", "Editar Libro");
        $this->smarty->assign("book", $book);
        $this->smarty->display("book/edit_form.tpl");
    }

    function showErrorCantRemove($book) {
        $this->smarty->assign("title", "ELIMINAR GÉNERO");
        $this->smarty->assign("book", $book);
        $this->smarty->display("book/cant_remove.tpl");
    }
}