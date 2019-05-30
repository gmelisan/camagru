<?php
namespace Camagru;

class Login {
    private $pdo;
    private $errors = [];

    public function __construct($pdo, $errors = []) {
        $this->pdo = $pdo;
        $this->errors = $errors;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function isLogged() {
        if (isset($_SESSION["login"]) && !empty($_SESSION["login"]))
            return true;
        return false;
    }

    public function getUser() {
        if (isset($_SESSION["login"]) && $_SESSION !== "")
            return $_SESSION["login"];
        return false;
    }

    public function login($user, $password) {
        $errors = $this->validate($user, $password);
        if (empty($errors)) {
            session_start();
            $_SESSION["login"] = $user;
        }
        return new Login($this->pdo, $errors);
    }

    public function logout() {
        $_SESSION["login"] = "";
        return $this;
    }

    private function validate($user, $password) {
        $query = "SELECT * FROM users WHERE login = :login AND password = :password";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            "login" => $user,
            "password" => hash("whirlpool", $password)
        ]);
        $errors = [];
        if (empty($stmt->fetch())) {
            $errors["login"] = "Неверный логин или пароль";
        }
        return $errors;
    }
}
