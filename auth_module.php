<?php
    if ($_POST['user']){
        require_once ("connection.php");
        $q = "SELECT * FROM `User` WHERE `User`.`name` = '".$_POST['user']."' AND `User`.`password` = '".$_POST['pass']."'";
        if ($pdo->query($q)->fetch()){            
            setcookie ( "user" , $_POST['user'], time()+3600);
            setcookie ( "pass" , $_POST['pass'], time()+3600);
            echo '<script>document.location.replace("main.php");</script>';
        } else {
            echo '<script>document.location.replace("auth.php/?prompt=Не%20верное%20имя%20пользователя%20или%20пароль");</script>';
        }
    } 
    function auth($url){
        $q = "SELECT  `roles`.`role` FROM `User` 
        JOIN `users_roles` ON `User`.`id` = `users_roles`.`user` 
        JOIN `roles` ON `users_roles`.`role` = `roles`.`id` 
        JOIN `role_perm` ON `roles`.`id` = `role_perm`.`role` 
        JOIN `permissions` ON `role_perm`.`perm` = `permissions`.`id` 
        WHERE `User`.`name` = '".$_COOKIE['user']."' AND `User`.`password` = '".$_COOKIE['pass']."' AND `permissions`.`url` = '".$url."'";
        
        $q2 = "SELECT  `roles`.`role` FROM `User` 
        JOIN `users_roles` ON `User`.`id` = `users_roles`.`user` 
        JOIN `roles` ON `users_roles`.`role` = `roles`.`id`
        WHERE `User`.`name` = '".$_COOKIE['user']."' AND `User`.`password` = '".$_COOKIE['pass']."'";
        
        $b = $GLOBALS['pdo']->query($q2);    
        while ($row = $b->fetch())
        {
            if ($row['role'] == "ADMIN"){ $admin = "<a href='admin.php'>[Админ панель]</a>";}
        }
        if (($url != '/main.php')){
            if (($url != '/bike.php')){
                if ($GLOBALS['pdo']->query($q)->fetch()){
                    if ($admin){
                        echo $admin.' <a href="exit.php"> [ВЫЙТИ]</a>';
                    } else {
                        echo "Пользователь: ".$_COOKIE['user'].' <a href="exit.php"> [ВЫЙТИ]</a>';
                    }
                } else {
                    echo '<script>document.location.replace("auth.php/?prompt=У вас нет доступа к этой странице, авторизуйтесь (<a href=http://prbd.std-1548.ist.mospolytech.ru/main.php>на главную</a>)");</script>';
                }
            } else {
                if ($_COOKIE['user']){
                    if ($GLOBALS['pdo']->query($q)->fetch()){
                        if ($admin){
                            echo $admin.' <a href="exit.php"> [ВЫЙТИ]</a>';
                        } else {
                            echo "Пользователь: ".$_COOKIE['user'].' <a href="exit.php"> [ВЫЙТИ]</a>';
                        }
                    } else {
                        echo '<script>document.location.replace("auth.php/?prompt=У вас нет доступа к этой странице, авторизуйтесь (<a href=http://prbd.std-1548.ist.mospolytech.ru/main.php>на главную</a>)");</script>';
                    }
                } else {
                    echo "<a href='auth.php/'> [ВХОД] </a>";
                }
            }
        } else {
            if ($_COOKIE['user']){
                if ($GLOBALS['pdo']->query($q)->fetch()){
                    if ($admin){
                        echo $admin.' <a href="exit.php"> [ВЫЙТИ]</a>';
                    } else {
                        echo "Пользователь: ".$_COOKIE['user'].' <a href="exit.php"> [ВЫЙТИ]</a>';
                    }
                } else {
                    echo '<script>document.location.replace("auth.php/?prompt=У вас нет доступа к этой странице, авторизуйтесь (<a href=http://prbd.std-1548.ist.mospolytech.ru/main.php>на главную</a>)");</script>';
                }
            } else {
                echo "<a href='auth.php/'> [ВХОД] </a>";
            }
        }
    }
?>