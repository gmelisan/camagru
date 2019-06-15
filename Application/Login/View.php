<?php

namespace Login;

class View {
    public function getPage($login) {
        $errors = $login->getErrors();
        $page["title"] = "Логин";
        $page["src"] = "Application/Login/pages/login.php";
        $page["errors"] = $errors;
        if (empty($page["errors"]) && $login->isLogged()) {
            if (isset($_GET["redirect"])) /* redirect after login */
                $page["redirect"] = $_GET["redirect"];
            else
                $page["redirect"] = "/gallery";
        }
        return $page;
    }
}