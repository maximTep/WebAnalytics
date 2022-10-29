<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="head.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <?php require_once ("connection.php"); ?>
    <?php require_once ("auth_module.php");?>
    <title>Country</title>    
</head>
<body>
    <header>
    <a href='main.php'>
    <div class='left'>
        <img src='logo.png'>
        <span>VeloChoice</span>
    </div>
    </a>
    <div class='right'>
        <img src='avatar.png'>
        <span>
        <?php
            auth(explode('?', $_SERVER['REQUEST_URI'])[0]);
        ?>
        </span>
    </div>
    </header>
    <hr>  
    <form name="f" method="post" action="new_country.php">
        <p>
        <label>Страна: <input type="text" name="country" value=""></label><br>
        <input type="hidden" name="parent" value="country.php" >
        </p>
        <p><input type="submit"  value="Создать" ></p>
    </form>
</body>
</html>