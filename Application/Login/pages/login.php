<div class="container-registration">
    <div class="registration">
        <h1>Логин</h1>
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
                <input type="submit" value="Войти" name="submit">
                <a href="#" class="forget"> Забыли пароль?</a>
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
</div>