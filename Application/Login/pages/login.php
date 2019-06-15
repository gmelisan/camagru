<div class="container-form">
    <h1>Вход</h1>
    <form method="POST">
        <div class="entry">
            <div class="name">Логин</div>
            <input type="text" value="" name="login">
        </div>
        <div class="entry">
            <div class="name">Пароль</div>
            <input type="password" value="" name="password">
        </div>
        <div class="entry end">
            <input type="submit" class="button" value="Войти" name="submit">
            <a href="login?forget" class="forget"> Забыли пароль?</a>
        </div>
    </form>
    <?php if (!empty($page["errors"])) { ?>
    <ul>
        <?php foreach ($page["errors"] as $error) { ?>
        <li> <?php echo $error ?> </li>
        <?php } ?>
    </ul>
    <?php } ?>
</div>