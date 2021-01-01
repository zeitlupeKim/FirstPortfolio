<?php
if (!isset($_COOKIE['_view_list_repository0_']) || $_COOKIE['_view_list_repository0_'] != md5('yes')) {
	header('Location: http://goto.hell');
	exit;
}
include_once '../db.inc.php';

if (! isset($_COOKIE['_view_list_repository0_']) || ($_COOKIE['_view_list_repository0_'] != md5('_yes_'))) {
	$result = DBQuery("select pw from {$_GET['table']} where num = {$_GET['num']} limit 1");
	$row = mysqli_fetch_row($result);
	$orgPW = $row[0];
	
	$passwd = $_POST['passwd'];
	$result = DBQuery("select password('$passwd')");
	$row = mysqli_fetch_row($result);
	$currPW = $row[0];

	if ($orgPW != $currPW){
		DBClose($result);
		echo 'PW_ERROR';
		exit;
	}
}

$name = $_POST['name'];
$ip = getenv('REMOTE_ADDR');
$title = addslashes($_POST['title']);
$content = addslashes($_POST['content']);

DBQuery("update {$_GET['table']} set name = '$name', ip = '$ip', title = '$title', content = '$content' where num = {$_GET['num']} limit 1");
DBClose();

echo 'OK';
?>