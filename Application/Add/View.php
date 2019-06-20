<?php
namespace Camagru\Add;

class View extends \Camagru\BaseView
{
    public function getPage($model)
    {
        $page["title"] = "Добавить";
        if (!(isset($_SESSION["login"]) && !empty($_SESSION["login"]))) {
            $page["src"] = "Application/add/pages/nologin.php";
            return $page;
        }
        $page["src"] = "Application/Add/pages/add.php";
        return $page;
    }
}

