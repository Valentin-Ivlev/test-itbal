<?php
require_once('db-connect.php');

$uid=str_replace('Person-', '', $_GET['user_id']);
$ed_value=$_GET['ed_value'];
$q="UPDATE users SET education_level_id=(SELECT id FROM education_levels WHERE education_levels.name='".$ed_value."') WHERE users.id=".$uid;

$query=mysqli_query($link, $q);

echo json_encode(Array(
    "res"=>'Уровень образования изменен.'
));
?>