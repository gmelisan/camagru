<form method="POST">
    Логин: <input type="text" value="<?php $page["login"] ?>" name="login"> <br>
    Email: <input type="text" value="<?php $page["email"] ?>" name="email"> <br>
    Пароль: <input type="password" value="" name="password"> <br>
    Повторите пароль: <input type="password" value="" name="password2"> <br>
    <input type="submit" value="Регистрация" name="submit"> <br>
</form>
<?php if (!empty($page["errors"])) { ?>
<ul>
<?php foreach ($page["errors"] as $error) { ?>
    <li> <?php echo $error ?> </li>
<?php } ?>
</ul>
<?php } ?>