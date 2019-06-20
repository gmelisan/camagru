<div class="container-form">
    <h1>Профиль</h1>
    <form method="POST">
        <div class="entry">
            <div class="name">Логин </div>
            <input type="text" name="login"
                value="<?php echo $page["login"] ?>">
        </div>
        <div class="entry">
            <div class="name">Email</div>
            <input type="text" name="email" 
                value="<?php echo $page["email"] ?>">
        </div>
        <div class="entry">
            <div class="name">Новый пароль</div>
            <input type="password" value="" name="password">
        </div>
        <div class="entry">
            <div class="name">Уведомления на email</div>
            <input type="checkbox" name="send_email" 
                value="on" <?php echo $page["send_email"] ? "checked" : "" ?>>
        </div>
        <div class="entry">
            <div class="name">Старый пароль</div>
            <input type="password" value="" name="old_password">
        </div>
        <input class="button" type="submit" name="submit" value="Обновить">
    </form>
    <?php if (!empty($page["errors"])) { ?>
    <ul>
    <?php foreach ($page["errors"] as $error) { ?>
        <li> <?php echo $error ?> </li>
    <?php } ?>
    </ul>
    <?php } ?> 
</div>