<?php
require_once 'controllers/UserController.php';
require_once 'controllers/NewsController.php';
require_once 'controllers/CategoryController.php';

$method = $_SERVER['REQUEST_METHOD'];
$segments = explode('/', $endpoint);
$input = json_decode(file_get_contents('php://input'), true);

switch ($segments[0]) {
    case 'user':
        $controller = new UserController();
        if ($method == 'POST') {
            $controller->create($input);
        } elseif ($method == 'GET') {
            if (isset($segments[1])) {
                $controller->readById($segments[1]);
            } else {
                $controller->read();
            }
        } elseif ($method == 'PUT') {
            $controller->update($input);
        } elseif ($method == 'DELETE') {
            $controller->delete($segments[1]);
        }
        break;

    case 'news':
        $controller = new NewsController();
        if ($method == 'POST') {
            $controller->create($input);
        } elseif ($method == 'GET') {
            if (isset($segments[1])) {
                $controller->readById($segments[1]);
            } else {
                $controller->read();
            }
        } elseif ($method == 'PUT') {
            $controller->update($input);
        } elseif ($method == 'DELETE') {
            $controller->delete($request[1]);
        }
        break;

    case 'category':
        $controller = new CategoryController();
        if ($method == 'POST') {
            $controller->create($input);
        } elseif ($method == 'GET') {
            if (isset($segments[1])) {
                $controller->readById($segments[1]);
            } else {
                $controller->read();
            }
        } elseif ($method == 'PUT') {
            $controller->update($input);
        } elseif ($method == 'DELETE') {
            $controller->delete($request[1]);
        }
        break;

    default:
        header("HTTP/1.1 404 Not Found");
        echo json_encode(["message" => "Invalid API endpoint."]);
        break;
}
