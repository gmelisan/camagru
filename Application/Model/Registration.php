<?php
namespace Camagru\Model;

require "Application/Model/Validator.php";

class Registration
{
    const STATUS_VALIDATE = 0;
    const STATUS_EMAILSENT = 1;
    const STATUS_REGISTERED = 2;

    private $status = self::STATUS_VALIDATE;
    private $pdo;
    private $record = [];
    private $errors = [];

    public function __construct(
        $pdo,
        $record = [],
        $errors = [],
        $status = self::STATUS_VALIDATE
    ) {
        $this->pdo = $pdo;
        $this->record = $record;
        $this->errors = $errors;
        $this->status = $status;
    }

    public function getRecord()
    {
        return $this->record;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function register($record)
    {
        $errors = $this->validate($record);
        if (!empty($errors)) {
            return new Registration($this->pdo, $record, $errors);
        }

        $inserted = $this->insert($record);
        $sended = $this->sendMail($inserted->getRecord());
        if (!empty($sended->getErrors())) {
            return $sended;
        }

        return new Registration($this->pdo, $record, $errors, self::STATUS_EMAILSENT);
    }

    public function confirmEmail($vercode)
    {
        $query = "SELECT * FROM users WHERE verification_code = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$vercode]);
        $res = $stmt->fetch();
        if (empty($res)) {
            $errors["confirmEmail"] = "Неверный код подтверждения.";
            return new Registration($this->pdo, [], $errors, self::STATUS_EMAILSENT);
        }

        $this->deleteFakes($res);

        $record["login"] = $res["login"];
        $record["email"] = $res["email"];
        $query = "UPDATE users SET verification_code = '' WHERE verification_code = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$vercode]);
        return new Registration($this->pdo, $record, [], self::STATUS_REGISTERED);
    }

    private function validate($record)
    {
        $errors = [];
        $validator = new Validator();

        if ($record["password"] !== $record["password2"]) {
            $errors["password"] = "Пароли не совпадают";
        }

        if ($this->checkLoginExist($record["login"])) {
            $errors["login"] = "Такой логин уже существует";
        }

        if ($this->checkEmailExist($record["email"])) {
            $errors["email"] = "Пользователь с такой почтой уже зарегистрирован.";
        }

        if (!empty($errors)) {
            return $errors;
        }

        $errors["login"] = $validator->validateLogin($record["login"]);
        $errors["password"] = $validator->validatePassword($record["password"]);
        $errors["email"] = $validator->validateEmail($record["email"]);
        $errors = array_filter($errors);

        /* $errors = array_merge($this->validateLogin($record["login"]),
        $this->validatePassword($record["password"], $record["password2"]),
        $this->validateEmail($record["email"])); */
        return $errors;
    }

    private function insert($record)
    {
        $query =
            "INSERT INTO `users` " .
            "(`login`, `password`, `email`, `reg_date`, `verification_code`) VALUES " .
            "(:login, :password, :email, :date, :vercode)";

        $vercode = md5("camagru" . rand(10000, 99999) . $record["login"]);

        $stmt = $this->pdo->prepare($query);
        $res = $stmt->execute(["login" => $record["login"],
            "password" => hash("whirlpool", $record["password"]),
            "email" => $record["email"],
            "date" => date("Y-m-d H:i:s"),
            "vercode" => $vercode]);
        if (!$res) {
            $errors[] = "Ошибка при добавлении информации в базу. " .
            "(code: " . $stmt->errorCode() . ", \"" . $stmt->errorInfo() . "\")";
            return new Registration($this->pdo, $record, $errors);
        }
        $record["id"] = $this->pdo->lastInsertId();
        $record["vercode"] = $vercode;
        return new Registration($this->pdo, $record);
    }

    private function sendMail($record)
    {
        $to = $record["email"];
        $subject = "Camagru account activation";
        $message = "Dear " . $record["login"] . ",<br>";
        $message .= "Please click the link below to activate your account.<br>";
        $link = "http://" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] .
            $_SERVER["REQUEST_URI"] . '?link=' . $record["vercode"];

        $message .= '<a href="' . $link . '">' . $link . '</a>';
        $headers = "Content-type: text/html;\r\n";
        $errors = [];
        if (!mail($to, $subject, $message, $headers)) {
            $errors["sendMail"] = "Ошибка при отправке email.";
        }

        return new Registration($this->pdo, $record, $errors);
    }

    private function checkLoginExist($login)
    {
        $stmt = $this->pdo->prepare("SELECT * from users WHERE login = ?");
        $stmt->execute([$login]);
        $res = $stmt->fetch();
        if (!empty($res) && $res["verification_code"] === "") {
            return true;
        }

        return false;
    }

    private function checkEmailExist($email)
    {
        $stmt = $this->pdo->prepare("SELECT * from users WHERE email = ?");
        $stmt->execute([$email]);
        $res = $stmt->fetch();
        if (!empty($res) && $res["verification_code"] === "") {
            return true;
        }
        return false;
    }

    private function deleteFakes($res)
    {
        return; /* todo: temp user table */
        $validLogin = $res["login"];
        $validEmail = $res["email"];

        "DELETE FROM users WHERE " .
            "(verification_code != :vercode AND " .
            "(login = :login OR email = :email)";
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE ");
        $stmt->execute();
    }

    /* private function validateLogin($login) {
    $errors = [];
    $rule = "/^[a-zA-Z][a-zA-Z0-9]{1,}/";

    if (preg_match($rule, $login) == 0) {
    $description = "Логин должен состоять минимум из " .
    "двух символов и может содержать " .
    "только буквы и цифры.";
    $errors["login"] = $description;
    return $errors;
    }

    $stmt = $this->pdo->prepare("SELECT * from users WHERE login = ?");
    $stmt->execute([$login]);
    $res = $stmt->fetch();
    if (!empty($res) && $res["verification_code"] === "") {
    $errors["login"] = "Такой логин уже существует.";
    }
    return $errors;
    } */

    /* private function validatePassword($password, $password2) {
    $errors = [];
    $rule = "/(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{6,}/";

    if ($password !== $password2)
    $errors["password"] = "Пароли не совпадают";
    if (preg_match($rule, $password) == 0) {
    $description = "Пароль должен быть не менее 6 знаков " .
    "и содержать не менее одной строчной, " .
    "заглавной буквы и цифры.";
    $errors["password"] = $description;
    }
    return $errors;
    } */

    /* private function validateEmail($email) {
    $errors = [];
    $rule = "/.+@.+\..+/";

    if (preg_match($rule, $email, $matches) == 0) {
    $description = "Неверно указана почта.";
    $errors["email"] = $description;
    return $errors;
    }
    $stmt = $this->pdo->prepare("SELECT * from users WHERE email = ?");
    $stmt->execute([$email]);
    $res = $stmt->fetch();
    if (! empty($res)) {
    if ($res["verification_code"])
    $this->deleteByEmail($email);
    else
    $errors["email"] = "Пользователь с такой почтой уже зарегистрирован.";
    }
    return $errors;
    } */

    private function deleteByEmail($email)
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE email = ?");
        $stmt->execute([$email]);
    }
}
