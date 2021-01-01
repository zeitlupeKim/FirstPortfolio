<?php
include_once '../db.inc.php';

DBQuery("update {$_GET['table']}_cmts set good = good +  1 where num = {$_GET['num']} limit 1");


$result = DBQuery("select good from {$_GET['table']}_cmts where num = {$_GET['num']} limit 1");
$row = mysqli_fetch_row($result);
$good = $row[0];


//축약
//$good = mysqli_fetch_row(DBQuery("select good from {$_GET['table']}_cmts where num = {$_GET['num']} limit 1"))[0];

DBClose();

echo $good;
?>