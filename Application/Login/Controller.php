<?php
namespace Login;

class Controller {
    public function login($login) {
        $user = $_POST["login"];
        $password = $_POST["password"];
        return $login->login($user, $password);
    }
    
    public function logout($login) {
        return $login->logout();
    }
}