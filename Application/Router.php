<?php

class Router {
    private $name;

    public function __construct($name) {
        $this->name = $this->convertName($name);
    }

    public function getName() {
        return $this->name;
    }

    public function getModelName() {
        return "Camagru\\" . $this->name;
    }

    public function getViewName() {
        return $this->name . '\\' . "View";
    }

    public function getControllerName() {
        return $this->name . '\\' . "Controller";
    }

    private function convertName($name) {
        $name = strtolower($name);
        $name = ucfirst($name);
        return $name;
    }
}
