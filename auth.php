<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="http://prbd.std-1548.ist.mospolytech.ru/auth.css">
    <title>Authorization</title>
</head>
<body>
    <form name="f" method="post" action="http://prbd.std-1548.ist.mospolytech.ru/auth_module.php">
        <label style="color: red;"><?php print_r( $_GET['prompt'] )?></label><br>
        <label>Имя пользователя:<br> <input type="text" name="user" value=""></label><br>
        <label>Пароль:<br> <input type="text" name="pass" value=""></label><br>        
        <label><input type="submit"  value="Войти" ></label>
    </form>
</body>
</html>