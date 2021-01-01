<?php
include_once '../db.inc.php';

DBQuery("update {$_GET['table']}_cmts set bad = bad +  1 where num = {$_GET['num']} limit 1");


/*
$result = DBQuery("select bad from {$_GET['table']}_cmts where num = {$_GET['num']} limit 1");
$row = mysqli_fetch_row($result);
$bad = $row[0];
*/

$bad = mysqli_fetch_row(DBQuery("select bad from {$_GET['table']}_cmts where num = {$_GET['num']} limit 1"))[0];

DBClose();

echo $bad;
?>