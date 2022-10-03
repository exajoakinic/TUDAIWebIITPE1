<?php

require_once "./views/generic_view.php";

class AuthorView extends GenericView {

    function showAll($authors, $isAdmin = true, $title = "Listado de autores", $linkToBooks=true) {
        $this->smarty->assign("title", $title);
        $this->smarty->assign("authors", $authors);
        $this->smarty->assign("linkToBooks", $linkToBooks);
        $this->smarty->display("author/list.tpl");
    }

    function showEditForm ($author) {
        $this->smarty->assign("title", "Editar autor");
        $this->smarty->assign("author", $author);
        $this->smarty->display("author/edit_form.tpl");
    }

    function showErrorCantRemove($author) {
        $this->smarty->assign("title", "ELIMINAR AUTOR");
        $this->smarty->assign("author", $author);
        $this->smarty->display("author/cant_remove.tpl");
    }
}