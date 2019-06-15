<?php
namespace Camagru;

class Validator {
    public function validateLogin($login) {
        $error = "";
        $rule = "/^[a-zA-Z][a-zA-Z0-9]{1,}/";

        if (preg_match($rule, $login) == 0) {
            $error = "Логин должен состоять минимум из " .
                     "двух символов и может содержать " .
                     "только буквы и цифры.";
        }
        return $error;
    }

    public function validatePassword($password) {
        $error = "";
        $rule = "/(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{6,}/";

        if (preg_match($rule, $password) == 0) {
            $error = "Пароль должен быть не менее 6 знаков " .
                     "и содержать не менее одной строчной, " .
                     "заглавной буквы и цифры.";
        }
        return $error;
    }

    public function validateEmail($email) {
        $error = "";
        $rule = "/.+@.+\..+/";

        if (preg_match($rule, $email) == 0) {
            $error = "Неверно указана почта.";
        }
        return $error;
    }
}