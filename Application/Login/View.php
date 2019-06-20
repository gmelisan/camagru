<?php

namespace Camagru\Login;

class View extends \Camagru\BaseView
{
    public function getPage($login)
    {
        $errors = $login->getErrors();
        $page["title"] = "Логин";
        $page["src"] = "Application/Login/pages/login.php";
        $page["errors"] = $errors;
        if (empty($page["errors"]) && $login->isLogged()) {
            if (isset($_GET["redirect"])) { /* redirect after login */
                $page["redirect"] = $_GET["redirect"];
            } else {
                $page["redirect"] = "/gallery";
            }
        }
        $page = $this->preparePage($page);
        return $page;
    }
}