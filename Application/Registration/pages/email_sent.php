<?php if (!empty($page["errors"])) { ?>
Письмо было отправлено на почту <?php $page["email"] ?> <br>
Пройдите по ссылке в письме для завершения регистрации.
<?php } else { ?>
<ul>
<?php foreach ($page["errors"] as $error) { ?>
    <li> <?php $error ?> </li>
<?php } ?>
</ul>
<?php } ?>
