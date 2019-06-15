<?php
namespace Add;

class View {
    public function getPage() {
        $page["title"] = "Добавить";
        $page["src"] = "Application/Add/pages/add.php";

        return $page;
    }
}

