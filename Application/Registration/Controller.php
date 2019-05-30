<?php
namespace Registration;

class Controller {
    public function register($registration) {
        $record["login"] = $_POST["login"];
        $record["password"] = $_POST["password"];
        $record["password2"] = $_POST["password2"];
        $record["email"] = $_POST["email"];
        return $registration->register($record);
    }

    public function confirmEmail($registration) {
        $vercode = $_GET["link"];
        return $registration->confirmEmail($vercode);
    }
}