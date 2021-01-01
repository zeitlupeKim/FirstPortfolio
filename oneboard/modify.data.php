<?php
if (!isset($_COOKIE['board_list_view']) || $_COOKIE['board_list_view'] != md5('yes')) {
	header('Location: http://goto.hell');
	exit;
}


include_once '../db.inc.php';

if (! isset($_COOKIE['adminLogin']) || ($_COOKIE['adminLogin'] != md5('_yes_'))) {
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


$isFile = $file ? ",file = '$file'":""; //파일이라는 변수가 값을 가지고 있을 떄만 file='$file'실행


$name = $_POST['name'];
$up_date = time();
$ip = getenv('REMOTE_ADDR');
$title = addslashes($_POST['title']);
$content = addslashes($_POST['content']);
$cat = isset($_POST['cat']) ? $_POST['cat'] : 0;

DBQuery("update {$_GET['table']} set name = '$name', up_date = $up_date, ip = '$ip', title = '$title', content = '$content', cat = $cat $isFile where num = {$_GET['num']} limit 1");
DBClose();

echo 'OK';
?>