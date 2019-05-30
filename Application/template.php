<!DOCTYPE html>
<html>
    <head>
        <title>Camagru</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
    </head>
    <body>
        <div class="section">
            <div class="container">
                <h1> Camagru </h1>
                <hr>
                <?php if (isset($_SESSION["login"]) && !empty($_SESSION["login"])) { ?>
                    Вы залогинены как <?php echo $_SESSION["login"] ?>. 
                    <a href="login?act=logout">Выход</a>
                <?php } else { ?>
                    <a href="registration"> Регистрация </a> |
                    <a href="login"> Логин </a>
                <?php } ?>
                <hr>
                <?php require $page["src"]; ?>
            </div> 
        </div>
        <h2> footer </h2>
    </body>
</html>