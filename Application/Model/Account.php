<?php
namespace Camagru;
require "Application/Model/Validator.php";

class Account {
    private $pdo;
    private $record = [];
    private $errors = [];

    public function __construct($pdo, $record = [], $errors = []) {
        $this->pdo = $pdo;
        $this->record = $record;
        $this->errors = $errors;
    }

    public function getRecord() {
        return $this->record;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function init($login) {
        $record = $this->dbGetRecord($login);
        $errors = [];
        if (empty($record)) {
            $errors[] = "Логин '$old_login' отсутствует в базе.";
        }
        return new Account($this->pdo, $record, $errors);
    }

    public function updateRecord($new_record, $old_password) {
        $errors = [];

        if ($this->record["password"] !== hash("whirlpool", $old_password)) {
            $errors[] = "Старый пароль указан неверно";
            return new Account($this->pdo, $this->record, $errors);
        }
        $errors = $this->validate($new_record);
        if (!empty($errors))
            return new Account($this->pdo, $this->record, $errors);
        return $this->dbUpdateRecord($new_record);
    }

    private function validate($new_record) {
        $errors = [];
        $validator = new Validator();

        if (!empty($new_record["login"]))
            $errors[] = $validator->validateLogin($new_record["login"]);
        if (!empty($new_record["password"]))
            $errors[] = $validator->validatePassword($new_record["password"]);
        if (!empty($new_record["email"]))
            $errors[] = $validator->validateEmail($new_record["email"]);
        return array_filter($errors);
    }

    private function dbGetRecord($login) {
        $query = "SELECT * FROM users WHERE login = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$login]);
        $res = $stmt->fetch();
        return $res;
    }

    private function dbUpdateRecord($new_record) {
        $query = "UPDATE users SET ";
        $query .= !empty($new_record["login"]) ? "login = :login, " : "";
        $query .= !empty($new_record["email"]) ? "email = :email, " : "";
        $query .= !empty($new_record["password"]) ? "password = :password, " : "";
        $query .= "send_email = " . ($new_record["send_email"] ? "1" : "0") . " ";
        $query .= "WHERE login = :old_login";

        $stmt = $this->pdo->prepare($query);
        $data = array(
            ":login" => $new_record["login"],
            ":email" => $new_record["email"],
            ":password" => $new_record["password"],
            ":old_login" => $this->record["login"]);
        $data = array_filter($data);
        if (isset($data[":password"]))
            $data[":password"] = hash("whirlpool", $new_record["password"]);
        $res = $stmt->execute($data);
        $errors = [];
        if (!$res) {
            $errors[] = "Ошибка при обновлении информации в базе. " . 
            "(code: ".$stmt->errorCode().", \"".$stmt->errorInfo()."\")";
        }
        if (!empty($new_record["login"]))
            $_SESSION["login"] = $new_record["login"];
        return new Account($this->pdo, $new_record, $errors);
    }
}