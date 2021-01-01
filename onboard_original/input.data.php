<?php
if (!isset($_COOKIE['board_list_view']) || $_COOKIE['board_list_view'] != md5('yes')) {
	header('Location: http://goto.hell');
	exit;
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

include_once '../db.inc.php';

$name = $_POST['name'];
$wr_date = time();
$ip = getenv('REMOTE_ADDR');
$title = addslashes($_POST['title']);
$content = addslashes($_POST['content']);
$passwd = $_POST['passwd'];
$cat = isset($_POST['cat']) ? $_POST['cat'] : 0;

DBQuery("insert into {$_GET['table']} values(null, '$name', $wr_date, 0, '$ip', '$title', '$content', password('$passwd'), $cat, '$file', 0, 0, 0)");

//echo "insert into {$_GET['table']} values(null, '$name', $wr_date, 0, '$ip', '$title', '$content', password('$passwd'), $cat, '$file', 0, 0, 0)";

DBClose();

echo 'OK';
?>