
<?php
require_once './libs/smarty-4.2.1/libs/Smarty.class.php';
require_once './controllers/book_controller.php';
require_once './controllers/author_controller.php';
require_once './controllers/genre_controller.php';

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
    case 'authors' :
        $controller = new AuthorController();
        routeActionsController($params, $controller);
        break;
    case 'books' :
        $controller = new BookController();
        switch ($params[1] ?? "") {
            case 'by_author':
                $controller->showByAuthor($params[2] ?? "");
                break;
            case 'by_genre':
                $controller->showByGenre($params[2] ?? "");
                break;
                default:
                routeActionsController($params, $controller);
                break;
        }
        break;
    case 'genres' :
        $controller = new GenreController();
        routeActionsController($params, $controller);
        break;
    
    default:        
        noRoute();
        break;
}

function noRoute() {
    echo('error 404 Page not found');
}

function routeAuthors($params) {
    $authorController = new AuthorController();
    routeActionsController($params, $authorController);
}
function routeBooks($params) {
    $authorController = new BookController();
    routeActionsController($params, $authorController);
}

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
        case "remove":
            $controller->remove($params[2] ?? "");
            break;
        case "new":
            $controller->add();
            break;
        default:
            noRoute();
            break;
    }
}
/*
function routerList($params) {
    switch ($params[1]) {
        case 'authors': $authorController = new AuthorController();
                        $authorController->showAll();
            break;
        default;
            noRoute();
            break;
        }
}
*/