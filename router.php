
<?php

include_once 'controllers/author_controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

//leo el parametro accion, pero antes le doy un valor default
$action = 'home';

if (!empty ($_GET['action'])){
    $action = $_GET['action'];
}
// con este comando explode parseo el get separando en un array las palabras entre barras
$params = explode('/', $action);

switch ($params[0]){
    case 'home' :   
        echo "home";
        break;

    case 'list' :   
        switch ($params[1]) {
            case 'authors': $authorController = new AuthorController();
                            $authorController->getAll();
                break;
            }
        break;

    default:        
        echo('error 404 Page not found');
        break;
}


function routerList() {
    echo '<p>routerList</p>';

}