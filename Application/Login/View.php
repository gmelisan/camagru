<?php

namespace Login;

class View {
    public function getPage($login) {
        $errors = $login->getErrors();
        $page["src"] = "Application/Login/pages/login.php";
        $page["errors"] = $errors;
        return $page;
    }/* 
    public function output($login) {
        $errors = $login->getErrors();
        if (!empty($errors))
            return $errors["login"];
        if ($login->isLogged())
            $html = $this->outputLoggedIn($login->getUser());
        else
            $html = $this->outputAskLogin();
        return $html;
    }

    private function outputLoggedIn($user) {
        $html =
        'Вы залогинены как ' . $user . '<br>' .
        '<a href=login?act=logout> Выйти </a>';
        return $html;
    }

    private function outputAskLogin() {
        $html = 
        '<form method="POST">' .
        'Логин: <input type="text" value="" name="login"> <br>' .
        'Пароль: <input type="password" value="" name="password"> <br>' .
        '<input type="submit" value="Вход" name="submit"> <br>' .
        '</form>';
        return $html;
    } */
}