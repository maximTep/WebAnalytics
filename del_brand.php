<?php
require_once ("connection.php");

$id = $_POST['id'];
$parent = $_POST['parent'];

$stm = $pdo->prepare("DELETE FROM `brands` WHERE `id` = :id");
$stm->execute(array ('id' => $id));
?>
<script>document.location.replace("<?php echo $parent ?>");</script>