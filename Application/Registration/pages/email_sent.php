<div class="center">
    <div>
        <?php if (empty($page["errors"])) { ?>
        <p>Письмо было отправлено на почту <?php echo $page["email"] ?> </p> 
        <p>Пройдите по ссылке в письме для завершения регистрации.</p>
        <?php } else { ?>
        <ul>
        <?php foreach ($page["errors"] as $error) { ?>
            <li> <?php $error ?> </li>
        <?php } ?>
        </ul>
        <?php } ?>
    </div>
</div>