<?php

namespace Login;

class View {
    public function getPage($login) {
        $errors = $login->getErrors();
        $page["src"] = "Application/Login/pages/login.php";
        $page["errors"] = $errors;
        if (empty($page["errors"]) && $login->isLogged())
            $page["redirect"] = "/gallery";
        return $page;
    }
}