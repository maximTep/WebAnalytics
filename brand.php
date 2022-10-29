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
    <title>Brand</title>    
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
    <input id='new' type="button" value="Создать">
    <input id='mod' type="button" value="Редактироать">
    <input id='del' type="button" value="Удалить">
    <hr>
    <form id='n' name="fn" method="post" action="new_brand.php" hidden>
        <p>
        <label>Страна:
            <select name="country">
                    <?php
                    $stmt = $pdo->query('SELECT id, country FROM coutres');
                    while ($row = $stmt->fetch())
                    {
                        echo "<option value='" . $row['id'] . "'>" . $row['country'] . "</option>";
                    }
                    ?>
            </select><br>        
        </label><br>
        <label>Бренд: <input type="text" name="brand" value=""></label><br>
        <input type="hidden" name="parent" value="brand.php" >
        </p>
        <p><input type="submit"  value="Создать" ></p>
    </form>
    <form id='m' name="fm" method="post" action="change_brand.php" hidden>
        <p>
        <label>Объект для измененния:
            <select name="id">
                    <?php
                    $stmt = $pdo->query('SELECT * FROM `brands`');
                    
                    while ($row = $stmt->fetch())
                    {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                    ?>
            </select><br>        
        </label><br>
        <label>Страна новое значение:
            <select name="country">
                    <?php
                    $stmt = $pdo->query('SELECT id, country FROM coutres');
                    while ($row = $stmt->fetch())
                    {
                        echo "<option value='" . $row['id'] . "'>" . $row['country'] . "</option>";
                    }
                    ?>
            </select><br>        
        </label><br>
        <label>Бренд новое значение: <input type="text" name="brand" value=""></label><br>
        <input type="hidden" name="parent" value="brand.php" >
        </p>
        <p><input type="submit"  value="Изменить" ></p>
    </form>
    <form id='d' name="fd" method="post" action="del_brand.php" hidden>
        <p>
        <label>Объект для удаления:
            <select name="id">
                    <?php
                    $stmt = $pdo->query('SELECT * FROM brands');
                    while ($row = $stmt->fetch())
                    {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                    ?>
            </select><br>        
        </label><br>
        <input type="hidden" name="parent" value="brand.php" >
        <p><input type="submit"  value="Удалить" ></p>
    </form>
</body>
<script>
    document.getElementById("new").addEventListener("click", n);
    document.getElementById("mod").addEventListener("click", m);
    document.getElementById("del").addEventListener("click", d);
    function n() {
        document.getElementById("n").hidden=false;
        document.getElementById("m").hidden=true;
        document.getElementById("d").hidden=true;
    }
    function m() {
        document.getElementById("n").hidden=true;
        document.getElementById("m").hidden=false;
        document.getElementById("d").hidden=true;
    }
    function d() {
        document.getElementById("n").hidden=true;
        document.getElementById("m").hidden=true;
        document.getElementById("d").hidden=false;
    }
</script>
</html>