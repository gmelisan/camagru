<?php
namespace Camagru;

class FrontController
{
    private $model;
    private $view;

    private $name;

    public function __construct($pdo)
    {
        $parts = parse_url($_SERVER["REQUEST_URI"]);
        $arr = explode('/', $parts["path"]);
        $str = end($arr);
        $router = new Router($str);
        $this->name = $router->getName();
        $names = $router->route();
        if (empty($names)) {
            return;
        }
        /* 404 */

        $modelName = $names["model"];
        $viewName = $names["view"];
        $controllerName = $names["controller"];

        $model = new $modelName($pdo);
        $this->view = new $viewName();
        $controller = new $controllerName();

        $this->model = $controller->action($model);
    }

    public function output()
    {
        if (!isset($this->model)) {
            http_response_code(404);
            require "Application/not_found.php";
            return;
        }
        $page = $this->view->getPage($this->model);
        $page["title"] = "Camagru" . (isset($page["title"]) ? (" - " . $page["title"]) : "");
        if (isset($page["redirect"])) {
            header("Location: " . $page["redirect"]);
        } else {
            require "Application/template.php";
        }
    }
}
