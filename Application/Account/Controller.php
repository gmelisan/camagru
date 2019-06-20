<?php
namespace Camagru\Account;

class Controller
{
    public function action($account)
    {
        $account = $account->init($_SESSION["login"]);
        if (isset($_POST["submit"]))
            return $this->update($account);
        return $account;
    }

    private function update($account)
    {
        $record["login"] = $_POST["login"];
        $record["email"] = $_POST["email"];
        $record["password"] = $_POST["password"];
        $old_password = $_POST["old_password"];
        if (empty($_POST["send_email"]))
            $record["send_email"] = false;
        else
            $record["send_email"] = true;
        return $account->updateRecord($record, $old_password);
    }
}