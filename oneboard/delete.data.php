<?php
include_once '../db.inc.php';

$result = DBQuery("select passwd, file from {$_GET['table']} where num = {$_GET['num']} limit 1");
$row = mysqli_fetch_array($result);
$orgPW = $row['passwd'];
$file = $row['file'];

if (! isset($_COOKIE['adminLogin']) || ($_COOKIE['adminLogin'] != md5('_yes_'))) {
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

DBQuery("delete from {$_GET['table']}_cmts where b_num =  {$_GET['num']}");
DBQuery("delete from {$_GET['table']} where num = {$_GET['num']} limit 1");
DBClose($result);

echo 'OK';
?>