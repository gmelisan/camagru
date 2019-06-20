<?php
namespace Camagru;

class Router
{
    private $name;
    private $modelName;
    private $viewName;
    private $controllerName;

    public function __construct($name)
    {
        if (empty($name)) {
            $name = "gallery";
        }
        /* default path */
        $this->name = $this->convertName($name);
    }

    public function route()
    {
        $names["model"] = "Camagru\\" . $this->name;
        $names["view"] = $this->name . '\\' . "View";
        $names["controller"] = $this->name . '\\' . "Controller";

        $pre = "Camagru\\";
        $names["model"] = $pre . "Model\\" . $this->name;
        $names["view"] = $pre . $this->name . '\\' . "View";
        $names["controller"] = $pre . $this->name . '\\' . "Controller";

        $a = class_exists($names["model"]);
        if (!class_exists($names["model"]) ||
            !class_exists($names["view"]) ||
            !class_exists($names["controller"])) {
            return array();
        }

        return $names;
    }

    public function getName()
    {
        return $this->name;
    }

    private function convertName($name)
    {
        $name = strtolower($name);
        $name = ucfirst($name);
        return $name;
    }
}
