<?php
namespace Registration;

class View {
    public function getPage($reg) {
        $status = $reg->getStatus();
        $record = $reg->getRecord();
        $errors = $reg->getErrors();

        $page_prefix = "Application/Registration/pages";
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

    /* public function output($reg) {
        $status = $reg->getStatus();
        $record = $reg->getRecord();
        $errors = $reg->getErrors();

        if ($status == \Camagru\Registration::STATUS_REGISTERED) {
            $html = 'Пользователь '.$record["login"].' зарегистрирован.';
            return $html;
        }
        if ($status == \Camagru\Registration::STATUS_EMAILSENT) {
            if (!empty($errors))
                return $this->htmlErrors($errors);
            $html =
            'Письмо было отправлено на почту ' . $record["email"] . '<br>' .
            'Пройдите по ссылке  в письме для завершения регистрации.';
            return $html;
        }
        $html = $this->htmlForm($record["login"], $record["password"], $record["email"]);
        if (!empty($errors))
            $html .= $this->htmlErrors($errors);
        return $html;
    }

    private function htmlForm($login, $password, $email) {
        $html =
        '<form method="POST">' .
        'Логин: <input type="text" value="'.$login.'" name="login"> <br>' .
        'Email: <input type="text" value="'.$email.'" name="email"> <br>' .
        'Пароль: <input type="password" value="'.$password.'" name="password"> <br>' .
        'Повторите пароль: <input type="password" value="" name="password2"> <br>' .
        '<input type="submit" value="Регистрация" name="submit"> <br>' .
        '</form>';
        return $html;
    }

    private function htmlErrors($errors) {
        $html = '<ul>';
        foreach ($errors as $error) {
            $html .= '<li>' . $error . '</li>';
        }
        $html .= '</ul>';
        return $html;
    } */
}