<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Camagru</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
            <div class="title">
                <a href="/gallery">
                    <b>Camagru</b>
                </a>
            </div>
            <div class="space">
            </div>
            <div class="account">
                <?php if (isset($_SESSION["login"]) && !empty($_SESSION["login"])) { ?>
                    <a href="#" class="button"><?php echo $_SESSION["login"] ?> </a>
                    <a href="login?act=logout" class="link">Выход</a>
                <?php } else { ?>
                    <a href="registration" class="button"> Регистрация </a>
                    <a href="login" class="button"> Логин </a>
                <?php } ?>
            </div>
        </header>
    <section class="main">
        <?php require $page["src"]; ?>
    </section>
    <footer>
        <i>&copy;gmelisan 2019</i>
    </footer>
</body>
</html>
