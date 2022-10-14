<?php
require_once "./app/views/generic_view.php";

class GenreView extends GenericView{
    function showAll($genres, $title = "Listado de Géneros", $message=null) {
        $this->smarty->assign("title", $title);
        $this->smarty->assign("message", $message);
        $this->smarty->assign("genres", $this->sanitizeHTML($genres));
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