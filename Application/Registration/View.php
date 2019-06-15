<?php
namespace Registration;

class View {
    public function getPage($reg) {
        $status = $reg->getStatus();
        $record = $reg->getRecord();
        $errors = $reg->getErrors();

        $page_prefix = "Application/Registration/pages";
        $page["title"] = "Регистрация";
        $page["login"] = $record["login"];
        $page["email"] = $record["email"];
        $page["errors"] = $errors;
        
        if ($status == \Camagru\Registration::STATUS_REGISTERED) {
            $page["src"] = $page_prefix . "/registered.php";
        }
        else if ($status == \Camagru\Registration::STATUS_EMAILSENT) {
            $page["src"] = $page_prefix . "/email_sent.php";
        }
        else {
            $page["src"] = $page_prefix . "/registration.php";
        }
        return $page;
    }
}