<?php
namespace Camagru\Account;

class View extends \Camagru\BaseView
{
    public function getPage($account)
    {
        $record = $account->getRecord();
        $page = $record;
        $page["title"] = "Профиль";
        $page["errors"] = $account->getErrors();
        $page["src"] = "Application/Account/pages/account.php";
        if (!$this->isLogged())
            $page["redirect"] = "/login?redirect=account";
        $page = $this->preparePage($page);
        return $page;
    }

    private function isLogged()
    {
        if ((isset($_SESSION["login"]) && !empty($_SESSION["login"])))
            return true;
        return false;
    }
}