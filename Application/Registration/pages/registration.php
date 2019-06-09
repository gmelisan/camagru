<div class="container-registration">
    <div class="registration">
        <h1>Регистрация</h1>
        <form method="POST">
            <div class="entry">
                <div class="name">Логин </div>
                <input type="text" value="<?php echo $page["login"] ?>" name="login">
            </div>
            <div class="entry">
                <div class="name">Email</div>
                <input type="text" value="<?php echo $page["email"] ?>" name="email">
            </div>
            <div class="entry">
                <div class="name">Пароль</div>
                <input type="password" value="" name="password">
            </div>
            <div class="entry">
                <div class="name">Повторите пароль</div>
                <input type="password" value="" name="password2">
            </div>
            <input type="submit" value="Регистрация" name="submit">
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
