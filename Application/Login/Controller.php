<?php
namespace Camagru\Login;

class Controller
{
    public function action($login)
    {
        if (isset($_POST["submit"]))
            return $this->login($login);
        if ($_GET["act"] == "logout") {
            header("Location: /gallery");
            return $this->logout($login);
        }
        if ($_GET["act"] == "forget")
            return $this->forget($login);
        return $login;
    }
    private function login($login)
    {
        $user = $_POST["login"];
        $password = $_POST["password"];
        return $login->login($user, $password);
    }
    
    private function logout($login)
    {
        return $login->logout();
    }

    private function forget($login)
    {
        return $login;
    }
}