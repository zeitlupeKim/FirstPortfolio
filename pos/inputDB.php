<?php
include_once '../db.inc.php';

$ISBN = $_GET['ISBN'];
$title = $_GET['title'];
$author = $_GET['author'];
$publisch = $_GET['publisch'];
$quantity = $_GET['quantity'];
$price = $_GET['price'];
$table = $_GET['table'];

if(!$ISBN){
    echo 'NULL_VALUE';
    exit;
}
$result = DBQuery("insert into {$_GET['table']} values(null, '$ISBN','$title','$author', '$publisch','$quantity','$price')");
echo 'OK';
?>