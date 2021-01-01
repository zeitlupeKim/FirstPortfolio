<?php
include_once '../db.inc.php';

$result = DBQuery("select passwd, file from {$_GET['table']} where num = {$_GET['num']} limit 1");
$row = mysqli_fetch_array($result);
$orgPW = $row['passwd'];
$file = $row['file'];

if (!isset($_COOKIE['admin']) || ($_COOKIE['admin'] != md5($_GET['table']))) {
	$passwd = $_GET['passwd'];
	$result = DBQuery("select password('$passwd')");
	$row = mysqli_fetch_row($result);
	$currPW = $row[0];

	if ($orgPW != $currPW) {
		DBClose($result);
		echo 'PW_ERROR';
		exit;
	}
}

if ($file) {
	unlink('./files/' . $_GET['table'] . '/' . $file);
}

//댓글이 있으면 댓글 지우고... 내일 쯤 가능?
DBQuery("delete from {$_GET['table']} where num = {$_GET['num']} limit 1");
DBClose($result);

echo 'OK';
?>