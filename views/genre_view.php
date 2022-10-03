<?php
require_once "./views/generic_view.php";

class GenreView extends GenericView{
    function showAll($genres, $isAdmin = true, $title = "Listado de géneros", $linkToBooks = true) {
        $this->smarty->assign("title", $title);
        $this->smarty->assign("genres", $genres);
        $this->smarty->assign("linkToBooks", $linkToBooks);
        $this->smarty->display("genre/list.tpl");
    }

    function showEditForm ($genre) {
        $this->smarty->assign("title", "Editar Género");
        $this->smarty->assign("genre", $genre);
        $this->smarty->display("genre/edit_form.tpl");
    }

    function showErrorCantRemove($genre) {
        $this->smarty->assign("title", "ELIMINAR GÉNERO");
        $this->smarty->assign("genre", $genre);
        $this->smarty->display("genre/cant_remove.tpl");
    }
}