<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="head.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="form_bike.css">
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <?php require_once ("connection.php"); ?>
    <?php require_once ("auth_module.php");?>
    <title>New bike</title>    
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
    <h1>Новый велосипед</h1>
    <form name="form" method="post" action="new_bike.php" enctype="multipart/form-data">
        <table>
        <tr>
            <td>
                <label>Название:</label>
            </td>
            <td>
                <input type="text" name="name">
            </td>
        </tr>
        <tr>
            <td>
                <label>Изображение (4 МБ):</label>
            </td>
            <td>
            <input type="hidden" name="MAX_FILE_SIZE" value="4194304" />
		    <input type="file" name="file_upload" accept="image/*"/>
            </td>
        </tr>
        <tr>
            <td>
                <label>Тип:</label>
            </td>
            <td>
                <select name="type">
                    <?php
                    $stmt = $pdo->query('SELECT id, type FROM `types_of_bikes`');
                    while ($row = $stmt->fetch())
                    {
                        echo "<option value='" . $row['id'] . "'>" . $row['type'] . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label>Бренд:</label>
            </td>
            <td>
                <select name="brand">
                    <?php
                    $stmt = $pdo->query('SELECT id, name FROM `brands`');
                    while ($row = $stmt->fetch())
                    {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label>Фреймсет:</label>
            </td>
            <td>
                <select name="frameset">
                    <?php
                    $stmt = $pdo->query('SELECT `framesets`.`id`,
                                                `frames`.`name` AS frame,
                                                `front_shocks`.`name` AS front,
                                                `back_shocks`.`name` AS back,
                                                `m1`.`name` AS mf,
                                                `m2`.`name` AS mb
                                        FROM `framesets`
                                            LEFT JOIN `frames` ON `framesets`.`frame` = `frames`.`id`
                                            LEFT JOIN `front_shocks` ON `framesets`.`front_shock` = `front_shocks`.`id`
                                            LEFT JOIN `manufacturers` AS `m1` ON `m1`.`id` = `front_shocks`.`manufacturer`
                                            LEFT JOIN `back_shocks` ON `framesets`.`back_shock` = `back_shocks`.`id`
                                            LEFT JOIN `manufacturers` AS `m2` ON `m2`.`id` = `back_shocks`.`manufacturer`');
                    while ($row = $stmt->fetch())
                    {
                        echo "<option value='" . $row['id'] . "'>" . $row['frame'] . " (" . $row['mf'] . " " . $row['front'] . ", " . $row['mb'] . " " . $row['back'] . ")" . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label>Вилсет:</label>
            </td>
            <td>
                <select name="wheelset">
                    <?php
                    $stmt = $pdo->query('
                    SELECT `wheelsets`.`id`,
                        `rims`.`name` AS rim,
                        `tires`.`name` AS tire,
                        `mr`.`name` AS mr,
                        `mt`.`name` AS mt,
                        `diameters`.`diameter`
                    FROM `wheelsets`
                        LEFT JOIN `rims` ON `wheelsets`.`rims` = `rims`.`id`
                        LEFT JOIN `manufacturers` AS mr ON `rims`.`manufacturer` = `mr`.`id`
                        LEFT JOIN `tires` ON `wheelsets`.`tires` = `tires`.`id`
                        LEFT JOIN `manufacturers` AS mt ON `tires`.`manufacturer` = `mt`.`id`
                        LEFT JOIN `diameters` ON `tires`.`diameter` = `diameters`.`id`
                    ');
                    while ($row = $stmt->fetch())
                    {
                        echo "<option value='" . $row['id'] . "'>" . $row['diameter'] . " (" . $row['mr'] . " " . $row['rim'] . ", " . $row['mt'] . " " . $row['tire'] . ")" . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label>Трансмиссия:</label>
            </td>
            <td>
                <select name="transmission">
                    <?php
                    $stmt = $pdo->query('
                    SELECT `transmissions`.`id`,
                        `front_shifters`.`name` AS front,
                        `front_shifters`.`speeds` AS fspeeds,
                        `mf`.`name` AS mf,
                        `back_shifters`.`name` AS back,
                        `back_shifters`.`speeds` AS bspeeds,
                        `mb`.`name` AS mb,
                        `brakes`.`type` AS break,
                        `transmissions`.`rotor`
                    FROM `transmissions`
                        LEFT JOIN `front_shifters` ON `transmissions`.`front_shifter` = `front_shifters`.`id`
                        LEFT JOIN `manufacturers` AS mf ON `front_shifters`.`manufacturer` = `mf`.`id`
                        LEFT JOIN `back_shifters` ON `transmissions`.`back_shifter` = `back_shifters`.`id`
                        LEFT JOIN `manufacturers` AS mb ON `back_shifters`.`manufacturer` = `mb`.`id`
                        LEFT JOIN `brakes` ON `transmissions`.`break` = `brakes`.`id`
                    ');
                    while ($row = $stmt->fetch())
                    {
                        echo "<option value='" . $row['id'] . "'>" .
                        "F: " . $row['fspeeds'] . " - " . $row['mf'] . " " . $row['front'] .
                        " | B: " . $row['bspeeds'] . " - " . $row['mb'] . " " . $row['back'] .
                        " | Br: " . $row['break'] . " " . $row['rotor'] .
                        "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        </table>
        <p>
            <input type="submit"  value="Создать" >
            <input type="hidden" name="parent" value="main.php">
        </p>
    </form>
</body>
</html>