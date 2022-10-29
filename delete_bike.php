<?php
require_once ("connection.php");
$query='DELETE FROM `bike` WHERE id = '.$_GET['id'];
$pdo->query($query);
?>
<script>document.location.replace("main.php");</script>