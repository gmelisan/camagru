<?php

class FrontController {
    private $view;
    private $model;
    private $name;

    public function __construct($pdo) {
        $parts = parse_url($_SERVER["REQUEST_URI"]);
        $name = end(explode('/', $parts["path"]));
        $router = new Router($name);
        $this->name = $router->getName();
        
        $modelName = $router->getModelName();
        $viewName = $router->getViewName();
        $controllerName = $router->getControllerName();

        $model = new $modelName($pdo);
        $this->view = new $viewName();
        $controller = new $controllerName();

        $model = $this->action($model, $controller);
        $this->model = $model;
    }

    public function output() {
        $page = $this->view->getPage($this->model);
        require "Application/template.php";
    }

    private function action($model, $controller) {
        switch ($this->name) {
            case "Registration":
                if (isset($_POST["submit"]))
                    return $controller->register($model);
                if (isset($_GET["link"]))
                    return $controller->confirmEmail($model);
                break;
            case "Login":
                if (isset($_POST["submit"]))
                    return $controller->login($model);
                if ($_GET["act"] == "logout") {
                    header("Location: login");
                    return $controller->logout($model);
                }
                break;
        }
        return $model;
    }
}