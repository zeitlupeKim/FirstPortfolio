<?php
include_once '../db.inc.php';
$isTableName = $_GET['table'];
$isNum = $_GET['num'];

if(! $isNum){
    echo 'FAIL';
    exit;
}

DBQuery("delete from $isTableName where num = $isNum;");
DBClose();

echo 'OK';
?>