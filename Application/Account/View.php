<?php
namespace Account;

class View {
    public function getPage($account) {
        $record = $account->getRecord();
        $page = $record;
        $page["title"] = "Профиль";
        $page["errors"] = $account->getErrors();
        $page["src"] = "Application/Account/pages/account.php";
        if (!$this->isLogged())
            $page["redirect"] = "/login?redirect=account";
        return $page;
    }

    private function isLogged() {
        if ((isset($_SESSION["login"]) && !empty($_SESSION["login"])))
            return true;
        return false;
    }
}