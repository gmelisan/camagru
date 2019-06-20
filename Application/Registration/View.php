<?php
namespace Camagru\Registration;

class View extends \Camagru\BaseView
{
    public function getPage($reg)
    {
        $status = $reg->getStatus();
        $record = $reg->getRecord();
        $errors = $reg->getErrors();

        $page = [];
        $page_prefix = "Application/Registration/pages";
        $page["title"] = "Регистрация";
        $page["login"] = $record["login"];
        $page["email"] = $record["email"];
        $page["errors"] = $errors;

        if ($status == \Camagru\Model\Registration::STATUS_REGISTERED) {
            $page["src"] = $page_prefix . "/registered.php";
        } else if ($status == \Camagru\Model\Registration::STATUS_EMAILSENT) {
            $page["src"] = $page_prefix . "/email_sent.php";
        } else {
            $page["src"] = $page_prefix . "/registration.php";
        }
        $page = $this->preparePage($page);
        return $page;
    }
}
