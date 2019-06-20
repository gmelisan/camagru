<?php
namespace Camagru\Add;

class View extends \Camagru\BaseView
{
    public function getPage($model)
    {
        $page["title"] = "Добавить";
        $page["src"] = "Application/Add/pages/add.php";
        return $page;
    }
}

