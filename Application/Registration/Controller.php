<?php
namespace Camagru\Registration;

class Controller
{
    public function action($registration)
    {
        if (isset($_POST["submit"])) {
            return $this->register($registration);
        }

        if (isset($_GET["link"])) {
            return $this->confirmEmail($registration);
        }

        return $registration;
    }

    public function register($registration)
    {
        $record["login"] = $_POST["login"];
        $record["password"] = $_POST["password"];
        $record["password2"] = $_POST["password2"];
        $record["email"] = $_POST["email"];
        return $registration->register($record);
    }

    public function confirmEmail($registration)
    {
        $vercode = $_GET["link"];
        return $registration->confirmEmail($vercode);
    }
}
