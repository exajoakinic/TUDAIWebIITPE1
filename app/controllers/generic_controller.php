<?php

abstract class GenericController {
    protected $model;
    protected $view;
    private $fields;
    
    function __construct($model, $view, $fields) {
        $this->model = $model;
        $this->view = $view;
        $this->fields = $fields; 
    }

    //abstract protected function getAndValidateBeforeRemove()
    //abstract protected function getAndValidateBeforeAdd()
    //abstract protected function getAndValidateBeforeEdit()
    //abstract protected function getAndValidateFromPost();
    abstract protected function redirectionAfterEdit($id);
    abstract protected function redirectionAfterAdd($id);
    abstract protected function redirectionAfterRemove($removedItem);

    /**
     * COMPLETAR CAMPOS DESDE OTRAS TABLAS
     * La función queda vacía en el controlador genérico,
     * sólo la reescriben controladores que lo necesiten.
     */
    protected function completeFields($items) {   
    }

    /**
     * MUESTRA TODOS LOS ITEMS DE LA ENTIDAD
     */
    function showAll() {
        $items = $this-> model-> getAll();
        $this->completeFields($items);
        $this-> view-> showAll($items);
    }

    /**
     * MUESTRA FORMULARIO EDICIÓN
     */
    public function showEditForm ($id) {
        //VERIFICA SI EXISTE LA ENTIDAD A EDITAR
        $item = $this-> model-> getById($id);
        if (!($item)) {
            $this->view->showErrorNotFinded();
            header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
            die;
        }
        $this->view->showEditForm($item);
    }

    /**
     * MUESTRA FORMULARIO AGREGAR
     */
    public function showAddForm () {
        $this->view->showAddForm();
    }

    /**
     * EDITAR
     * Responsabilidad de validación: getAndValidateBeforeEdit($id)
     * Responsabilidad de redirección: redirectionAfterEdit())
     */
    function edit ($id) {
        $item = $this->getAndValidateBeforeEdit($id);

        $this->model->edit($item);
        
        // Redirecciona (responsabilidad redirectionAfterEdit)
        $this->redirectionAfterEdit($id);
    }

    /**
     * VALIDACIÓN ANTES DE EDITAR
     */
    protected function getAndValidateBeforeEdit($id) {
        if (!$this->model->getById($id)) {
            $this->view->showErrorNotFinded();
            header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
            die;
        }
        $item = $this->getAndValidateFromPost();
        $item->id = $id;
        return $item;
    }

    /**
     * AGREGAR
     * Responsabilidad validación POST: getAndValidateFromPost()
     * Responsabilidad de redirección: redirectionAfterAdd()
     */
    function add () {
        $item = $this->getAndValidateFromPost();
        $id = $this->model->add($item);
        $this->redirectionAfterAdd($id);
    }

    /**
     * VALIDACIÓN ANTES DE AGREGAR
     */
    protected function getAndValidateBeforeAdd() {
        return $this->getAndValidateFromPost();
    }

    /**
     * ELIMINAR
     * 1 Corre función getAndValidateBeforeRemove($id) -> debe frenar ejecución si no hay que eliminar
     * 2 Ejecuta redirectionAfterRemove si pudo eliminar
     * 2 Muestra mensaje error si no debió eliminar
     */
    public function remove ($id) {
        $item = $this->getAndValidateBeforeRemove($id);
        if ($item) {
            $this->model->remove($id);
            $this->redirectionAfterRemove($item);
        }
    }
    /**
     * VALIDACIÓN ANTES DE ELIMINAR
     */
    protected function getAndValidateBeforeRemove($id) {
        $item = $this->model->getById($id);
        if ($item) {
            return $item;
        } else {
            $this->view->showErrorNotFinded();
            header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
            die;
        }
    }

    /**
     * Genera objeto Book con los datos esperados por POST,
     * previa verificación de que estén todos los datos seteados.
     * 
     * Inicialmente esta función era abstracta en GenericController y
     * se definía en cada controlador específico.
     * Luego se abstrajo mediante el foreach, previo recibir los campos
     * a través del constructor.
     */
    protected function getAndValidateFromPost() {
        $item = new stdClass();
        foreach ($this->fields as $field) {
            if (!isset($_POST[$field])) {
                $this->view->showError("Se ha cancelado la operación. El campo '$field' debe estar seteado", "Error en datos recibidos");
                die;
            }
            $item->$field = $_POST[$field];
        }
        return $item;
    }
    
}