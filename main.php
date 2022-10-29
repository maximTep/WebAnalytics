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
    <title>Main</title>
    <?php
    $brand = $_GET['brand'];
    $brandSTMT = !(($brand == NULL) || ($brand == 0));
    
    $type = $_GET['type'];
    $typeSTMT = !(($type == NULL) || ($type == 0));

    $diameter = $_GET['diameter'];
    $diameterSTMT = !(($diameter == NULL) || ($diameter == 0));

    $arr = array();
    if ($brandSTMT){
        $arr[] = " `bike`.`brand` = " . $brand;
    }
    if ($typeSTMT){
        $arr[] = " `bike`.`type` = " . $type;
    }
    if ($diameterSTMT){
        $arr[] = " `rims`.`diameter` = " . $diameter;
    }
    $query = join(" AND ", $arr);
    if (!($query == "")){
        $query = 'SELECT `bike`.`id`, `bike`.`name`, `bike`.`img`, `diameters`.`diameter`, `brands`.`name` AS `brand`, `types_of_bikes`.`type` FROM `bike`
        JOIN `wheelsets`
        ON `bike`.`wheelset` = `wheelsets`.`id`
        JOIN `rims`
        ON `wheelsets`.`rims` = `rims`.`id`
        JOIN `diameters`
        ON `rims`.`diameter` = `diameters`.`id`
        JOIN `types_of_bikes`
        ON `bike`.`type` = `types_of_bikes`.`id`
        JOIN `brands`
        ON `bike`.`brand` = `brands`.`id`' . " WHERE " . $query;
    } else {
        $query = 'SELECT `bike`.`id`, `bike`.`name`, `bike`.`img`, `diameters`.`diameter`, `brands`.`name` AS `brand`, `types_of_bikes`.`type` FROM `bike`
        JOIN `wheelsets`
        ON `bike`.`wheelset` = `wheelsets`.`id`
        JOIN `rims`
        ON `wheelsets`.`rims` = `rims`.`id`
        JOIN `diameters`
        ON `rims`.`diameter` = `diameters`.`id`
        JOIN `types_of_bikes`
        ON `bike`.`type` = `types_of_bikes`.`id`
        JOIN `brands`
        ON `bike`.`brand` = `brands`.`id`';
    }
    ?>
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
    <form name="f" method="GET" action="" enctype="multipart/form-data">        
        <label>Бренд:
        <select name="brand">
            <option value='0'>не выбран</option>
            <?php
            $stmt = $pdo->query('SELECT id, `name` FROM brands');
            while ($row = $stmt->fetch())
            {
                if ($row['id'] == $brand){
                    echo "<option selected value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                } else {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
            }
            ?>
        </select>
        </label>
        <label>Тип велосипеда:
        <select name="type">
            <option value='0'>не выбран</option>
            <?php
            $stmt = $pdo->query('SELECT `id`, `type` FROM `types_of_bikes`');
            while ($row = $stmt->fetch())
            {
                if ($row['id'] == $type){
                    echo "<option selected value='" . $row['id'] . "'>" . $row['type'] . "</option>";
                } else {
                    echo "<option value='" . $row['id'] . "'>" . $row['type'] . "</option>";
                }
            }
            ?>
        </select>
        </label>
        <label>Диметр колеса:
        <select name="diameter">
            <option value='0'>не выбран</option>
            <?php
            $stmt = $pdo->query('SELECT id, diameter FROM diameters');
            while ($row = $stmt->fetch())
            {
                if ($row['id'] == $diameter){
                    echo "<option selected value='" . $row['id'] . "'>" . $row['diameter'] . "</option>";
                } else {
                    echo "<option value='" . $row['id'] . "'>" . $row['diameter'] . "</option>";
                }
            }
            ?>
        </select>
        </label>
        <label><input type="submit"  value="Показать" ></label>
    </form>
    <hr>
    <div class='bike_container'>
    <?php
    $bike = $pdo->query($query);    
    while ($row = $bike->fetch())
    {
        echo "
        <div class='bike'>
            <div class='bike_img'>
            <img src='img/".$row['img']."'>
            </div>
            <spam>
            ".$row['type']." велосипед<br><a href='/bike.php?id=".$row['id']."'>".$row['brand']." ".$row['name']."</a>
            </spam>
        </div>";
    }
    ?>
    </div>
</body>
</html>