<?php
require_once('db-connect.php');

$start  = isset($_REQUEST['start'])  ? $_REQUEST['start']  :  0;
$count  = isset($_REQUEST['limit'])  ? $_REQUEST['limit']  : 10;
$sort   = isset($_REQUEST['sort'])   ? json_decode($_REQUEST['sort'])   : null;

$sortProperty = $sort[0]->property;
$sortDirection = $sort[0]->direction;

$q="SELECT id AS person_id, name AS person_name,
       (SELECT education_levels.name 
       FROM education_levels
       WHERE education_levels.id=users.education_level_id) AS education,
       (SELECT GROUP_CONCAT(citys.name SEPARATOR ',<br>')
       FROM users_to_citys, citys
       WHERE users_to_citys.user_id=users.id AND citys.id=users_to_citys.city_id) AS city FROM users
       WHERE users.education_level_id IN (1,2)";
$q.=" ORDER BY ".$sortProperty." ".$sortDirection;
$q.=" LIMIT ".$start.",".$count;

$query=mysqli_query($link, "SELECT COUNT(id) AS total FROM users;");
$data=mysqli_fetch_assoc($query);
$count=$data['total'];

$query=mysqli_query($link, $q);

$rows = Array();
while($row = mysqli_fetch_assoc($query)) {
    array_push($rows, $row);
}
echo json_encode(Array(
    "total"=>$count,
    "data"=>$rows
));
?>