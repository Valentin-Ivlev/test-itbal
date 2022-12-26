<?php
require_once('db-connect.php');

$q="SELECT id AS ed_id, name AS ed_name FROM education_levels";

$query=mysqli_query($link, $q);

$rows = Array();
while($row = mysqli_fetch_assoc($query)) {
    array_push($rows, $row);
}
echo json_encode(Array(
    "education_levels"=>$rows
));
?>