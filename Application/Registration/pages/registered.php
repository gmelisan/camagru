<div class="center">
    <div>
        <p>Пользователь <?php echo $page["login"] ?> зарегистрирован.</p>
        <?php if (!empty($page["errors"])) { ?>
        <ul>
            <?php foreach ($page["errors"] as $error) { ?>
            <li> <?php echo $error ?> </li>
            <?php } ?>
        </ul>
        <?php } ?>
    </div>
</div>