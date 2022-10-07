<?php
require_once "./app/views/generic_view.php";

class GenreView extends GenericView{
    function showAll($genres, $title = "Listado de Géneros", $isAdmin = true, $linkToBooks = true) {
        $this->smarty->assign("title", $title);
        $this->smarty->assign("genres", $genres);
        $this->smarty->assign("isAdmin", $isAdmin);
        $this->smarty->assign("linkToBooks", $linkToBooks);
        $this->smarty->display("genre/list.tpl");
    }

    function showEditForm ($genre) {
        $this->smarty->assign("title", "Editar Género");
        $this->smarty->assign("genre", $genre);
        $this->smarty->assign("action", "genres/edit/$genre->id");
        $this->smarty->display("genre/form.tpl");
    }

    function showAddForm () {
        $genre = new stdClass;
        $genre->genre="";
        $genre->note="";

        $this->smarty->assign("title", "Agregar autor");
        $this->smarty->assign("action", "genres/add/");
        $this->smarty->assign("genre", $genre);
        $this->smarty->display("genre/form.tpl");
    }

    function showErrorCantRemove($genre, $books) {
        $this->smarty->assign("title", "ELIMINAR GÉNERO");
        $this->smarty->assign("genre", $genre);
        $this->smarty->assign("books", $books);
        $this->smarty->display("genre/cant_remove.tpl");
    }

    function showErrorNotFinded(){
        $this->showError("No se encontró el género solicitado", "Error al buscar género");
    }
}