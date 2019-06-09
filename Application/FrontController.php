<?php

class FrontController {
    private $view;
    private $model;
    private $name;

    public function __construct($pdo) {
        $parts = parse_url($_SERVER["REQUEST_URI"]);
        $str = end(explode('/', $parts["path"]));
        $router = new Router($str);
        $this->name = $router->getName();
        $names = $router->route();
        if (empty($names))
            return ;
            
        $modelName = $names["model"];
        $viewName = $names["view"];
        $controllerName = $names["controller"];

        $model = new $modelName($pdo);
        $this->view = new $viewName();
        $controller = new $controllerName();

        $model = $this->action($model, $controller);
        $this->model = $model;
    }

    public function output() {
        if (!isset($this->model)) {
            http_response_code(404);
            require "Application/not_found.php";
            return ;
        }
        $page = $this->view->getPage($this->model);
        if (isset($page["redirect"])) {
            header("Location: " . $page["redirect"]);
        } else {
            require "Application/template.php";
        }
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
                    header("Location: /gallery");
                    return $controller->logout($model);
                }
                break;
        }
        return $model;
    }
}