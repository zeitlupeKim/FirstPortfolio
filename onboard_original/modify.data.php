<?php
if (!isset($_COOKIE['board_list_view']) || $_COOKIE['board_list_view'] != md5('yes')) {
	header('Location: http://goto.hell');
	exit;
}

include_once '../db.inc.php';

if (!isset($_COOKIE['admin']) || ($_COOKIE['admin'] != md5($_GET['table']))) {
	$result = DBQuery("select passwd from {$_GET['table']} where num = {$_GET['num']} limit 1");
	$row = mysqli_fetch_row($result);
	$orgPW = $row[0];
	
	$passwd = $_POST['passwd'];
	$result = DBQuery("select password('$passwd')");
	$row = mysqli_fetch_row($result);
	$currPW = $row[0];

	if ($orgPW != $currPW) {
		DBClose($result);
		echo 'PW_ERROR';
		exit;
	}
}

$file = "";

if (isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
	if (file_exists('./files/' . $_GET['table'] . '/' . $_FILES['file']['name'])) {
		echo 'SAME_FILE_EXISTS';
		exit;
	}

	$file = $_FILES['file']['name'];

	if (!move_uploaded_file($_FILES['file']['tmp_name'], './files/' . $_GET['table'] . '/' . $_FILES['file']['name'])) {
		echo 'SAVE_ERROR';
		exit;
	}
}

$name = $_POST['name'];
$up_date = time();
$ip = getenv('REMOTE_ADDR');
$title = addslashes($_POST['title']);
$content = addslashes($_POST['content']);
$cat = isset($_POST['cat']) ? $_POST['cat'] : 0;

DBQuery("update {$_GET['table']} set name = '$name', up_date = $up_date, ip = '$ip', title = '$title', content = '$content', cat = $cat, file = '$file' where num = {$_GET['num']} limit 1");
DBClose();

echo 'OK';
?>