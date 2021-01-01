<?php
include_once '../db.inc.php';

$org_pw = mysqli_fetch_row(DBQuery("select pw from {$_GET['table']} where num = {$_GET['num']} limit 1"))[0];

$user_pw = mysqli_fetch_row(DBQuery("select password('{$_GET['password']}')"))[0];

if($org_pw == $user_pw){
    echo 'OK';
}

DBClose();
?>