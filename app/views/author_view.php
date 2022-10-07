<?php

require_once "./app/views/generic_view.php";

class AuthorView extends GenericView {

    function showAll($authors, $title = "Listado de Autores", $linkToBooks=true) {
        $this->smarty->assign("title", $title);
        $this->smarty->assign("authors", $authors);
        $this->smarty->assign("linkToBooks", $linkToBooks);
        $this->smarty->display("author/list.tpl");
    }

    function showEditForm ($author) {
        $this->smarty->assign("title", "Editar autor");
        $this->smarty->assign("action", "authors/edit/$author->id");
        $this->smarty->assign("author", $author);
        $this->smarty->display("author/form.tpl");
    }
    
    function showAddForm () {
        $author = new stdClass;
        $author->author="";
        $author->note="";

        $this->smarty->assign("title", "Agregar autor");
        $this->smarty->assign("action", "authors/add/");
        $this->smarty->assign("author", $author);
        $this->smarty->display("author/form.tpl");
    }

    function showErrorCantRemove($author, $books) {
        $this->smarty->assign("title", "ELIMINAR AUTOR");
        $this->smarty->assign("author", $author);
        $this->smarty->assign("books", $books);
        $this->smarty->display("author/cant_remove.tpl");
    }

    function showErrorNotFinded(){
        $this->showError("No se encontró el autor solicitado", "Error al buscar autor");
    }
}