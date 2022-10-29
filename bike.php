<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="head.css">
    <link rel="stylesheet" type="text/css" href="bike.css">
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <?php require_once ("connection.php"); ?>
    <?php require_once ("auth_module.php");?>
    <title>Bike</title>    
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
    <?php
    $q33 = "SELECT  `roles`.`role` FROM `User` 
        JOIN `users_roles` ON `User`.`id` = `users_roles`.`user` 
        JOIN `roles` ON `users_roles`.`role` = `roles`.`id`
        WHERE `User`.`name` = '".$_COOKIE['user']."' AND `User`.`password` = '".$_COOKIE['pass']."'";
        
        $cc = $GLOBALS['pdo']->query($q33);    
        while ($row = $cc->fetch())
        {
            if ($row['role'] == "ADMIN"){
                echo "
                <a href='form_bike_change.php?id=".$_GET['id']."'>Изменить</a>
                <a href='delete_bike.php?id=".$_GET['id']."'>Удалить</a>
                <hr>";
            }
        }
    ?>
    <div class='bike_container'>
    <?php
    $query = "
    SELECT `bike`.`id`,
	`bike`.`name`,
    `bike`.`img`,
    `brands`.`name` AS brand,
    
    `frames`.`name` AS frame,
    `front_shocks`.`name` AS front_shock,
    `back_shocks`.`name` AS back_shock,
    `mf_shock`.`name` AS mf_shock,
	`mb_shock`.`name` AS mb_shock,
    
    `rims`.`name` AS rim,
	`tires`.`name` AS tire,
	`mr`.`name` AS mr,
	`mt`.`name` AS mt,
	`diameters`.`diameter`,
    
    `front_shifters`.`name` AS front_shifter,
	`front_shifters`.`speeds` AS fspeeds,
	`mf_shift`.`name` AS mf_shift,
	`back_shifters`.`name` AS back_shifter,
	`back_shifters`.`speeds` AS bspeeds,
	`mb_shift`.`name` AS mb_shift,
	`brakes`.`type` AS break,
	`transmissions`.`rotor`
FROM `bike`
	LEFT JOIN `brands` ON `bike`.`brand` = `brands`.`id`

	LEFT JOIN `framesets` ON `bike`.`frameset` = `framesets`.`id`
    LEFT JOIN `frames` ON `framesets`.`frame` = `frames`.`id`
    LEFT JOIN `front_shocks` ON `framesets`.`front_shock` = `front_shocks`.`id`
    LEFT JOIN `manufacturers` AS `mf_shock` ON `mf_shock`.`id` = `front_shocks`.`manufacturer`
    LEFT JOIN `back_shocks` ON `framesets`.`back_shock` = `back_shocks`.`id`
    LEFT JOIN `manufacturers` AS `mb_shock` ON `mb_shock`.`id` = `back_shocks`.`manufacturer`
    
    LEFT JOIN `wheelsets` ON `bike`.`wheelset` = `wheelsets`.`id`
    LEFT JOIN `rims` ON `wheelsets`.`rims` = `rims`.`id`
    LEFT JOIN `manufacturers` AS `mr` ON `rims`.`manufacturer` = `mr`.`id`
    LEFT JOIN `tires` ON `wheelsets`.`tires` = `tires`.`id`
    LEFT JOIN `manufacturers` AS `mt` ON `tires`.`manufacturer` = `mt`.`id`
    LEFT JOIN `diameters` ON `tires`.`diameter` = `diameters`.`id`
    
    LEFT JOIN `transmissions` ON `bike`.`transmission` = `transmissions`.`id`
    LEFT JOIN `front_shifters` ON `transmissions`.`front_shifter` = `front_shifters`.`id`
    LEFT JOIN `manufacturers` AS `mf_shift` ON `front_shifters`.`manufacturer` = `mf_shift`.`id`
    LEFT JOIN `back_shifters` ON `transmissions`.`back_shifter` = `back_shifters`.`id`
    LEFT JOIN `manufacturers` AS `mb_shift` ON `back_shifters`.`manufacturer` = `mb_shift`.`id`
    LEFT JOIN `brakes` ON `transmissions`.`break` = `brakes`.`id`
WHERE `bike`.`id` = ".$_GET['id'];

    $bike = $pdo->query($query);   
    while ($row = $bike->fetch())
    {         
        echo "
        <div class='img_conteiner'>
        <img src='img/".$row['img']."'>
    </div>
    <div>
        <h2>Бренд:</h2>
        <h1>&nbsp;&nbsp;&nbsp;".$row['brand']."</h1>
        <h2>Модель:</h2>
        <h1>&nbsp;&nbsp;&nbsp;".$row['name']."</h1>
    </div>

    <table>
        <tr>
            <th colspan='2'>
                Фреймсет
            </th>
        </tr>
        <tr>
            <td>
                Название рамы
            </td>
            <td>
                ".$row['frame']."
            </td>
        </tr>
        <tr>
            <td>
                Передний амортизатор
            </td>
            <td>
                ".$row['mf_shock']." ".$row['front_shock']."
            </td>
        </tr>
        <tr>
            <td>
                Задний амортизатор
            </td>
            <td>
                ".$row['mb_shock']." ".$row['back_shock']."
            </td>
        </tr>
        <tr>
            <th colspan='2'>
                Вилсет
            </th>
        </tr>
        <tr>
            <td>
                Диаметр колеса
            </td>
            <td>
                ".$row['diameter']."
            </td>
        </tr>
        <tr>
            <td>
                Обод
            </td>
            <td>
                ".$row['mr']." ".$row['rim']."
            </td>
        </tr>
        <tr>
            <td>
                Покрышка
            </td>
            <td>
                ".$row['mt']." ".$row['tire']."
            </td>
        </tr>
        <tr>
            <th colspan='2'>
                Трансмиссия
            </th>
        </tr>
        <tr>
            <td>
                Передний переключатель
            </td>
            <td>
                ".$row['mf_shift']." ".$row['front_shifter']."
            </td>
        </tr>
        <tr>
            <td>
                Кол-во звезд спереди
            </td>
            <td>
                ".$row['fspeeds']."
            </td>
        </tr>
        <tr>
            <td>
                Задний переключатель
            </td>
            <td>
                ".$row['mb_shift']." ".$row['back_shifter']."
            </td>
        </tr>
        <tr>
            <td>
                Кол-во звезд сзади
            </td>
            <td>
                ".$row['bspeeds']."
            </td>
        </tr>
        <tr>
            <td>
                Тип тормоза
            </td>
            <td>
                ".$row['break']."
            </td>
        </tr>
        <tr>
            <td>
                Ротор
            </td>
            <td>
                ".$row['rotor']."
            </td>
        </tr>
    </table>";
    }
    ?>
</div>
</body>
</html>