<form method="POST">
    Логин: <input type="text" value="" name="login"> <br>
    Пароль: <input type="password" value="" name="password"> <br>
    <input type="submit" value="Вход" name="submit"> <br>
</form>
<a href="#"> Забыли пароль?</a>
<?php if (!empty($page["errors"])) { ?>
<ul>
<?php foreach ($page["errors"] as $error) { ?>
    <li> <?php echo $error ?> </li>
<?php } ?>
</ul>
<?php } ?>