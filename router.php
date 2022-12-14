
<?php
require_once './libs/smarty-4.2.1/libs/Smarty.class.php';
require_once './app/controllers/book_controller.php';
require_once './app/controllers/author_controller.php';
require_once './app/controllers/genre_controller.php';
require_once './app/controllers/auth_controller.php';

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
        (new BookController)->listSome();
        break;
    case 'login':
        (new AuthController)->login();
        break;
    case 'logout':
        (new AuthController)->logout();
        break;
    case 'authors' :
        routeActionsController($params, new AuthorController());
        break;
    case 'books' :
        $bookController = new BookController();
        switch ($params[1] ?? "") {
            case 'by_author':
                $bookController->showByAuthor($params[2] ?? "");
                break;
            case 'by_genre':
                $bookController->showByGenre($params[2] ?? "");
                break;
            default:
            routeActionsController($params, $bookController);
            break;
        }
        break;
    case 'genres' :
        routeActionsController($params, new GenreController());
        break;
    case 'book' :
        (new BookController())->showBookCard($params[1] ?? "");
        break;
    case 'cover' :
        (new BookController())->showFullSizeCover($params[1] ?? "");
        break;
    default:        
        noRoute();
        break;
}

function noRoute() {
    $view=new GenreView;
    $view->showError("Página no encontrada", "Error - página no encontrada");
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
}

/**
 * Rutea el listar / editar / crear / eliminar
 * utilizando el controlador recibido por parámetro.
 */
function routeActionsController($params, $controller) {
    $action = "list";
    if (!empty($params[1])){
        $action = $params[1];
    }
    switch ($action) {
        case "list" :
            $controller->showAll();
            break;
        case "edit":
            $controller->edit($params[2] ?? "");
            break;
        case "edit_form":
            $controller->showEditForm($params[2] ?? "");
            break;
        case "add":
            $controller->add();
            break;
        case "add_form":
            $controller->showAddForm($params[2] ?? "");
            break;
        case "remove":
            $controller->remove($params[2] ?? "");
            break;
        default:
            noRoute();
            break;
    }
}