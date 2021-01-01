<?php
include_once '../db.inc.php';
if(!isset($_COOKIE['_view_list_repository0_']) || $_COOKIE['_view_list_repository0_'] != md5('yes')){
    header('Location:http://goto.hell');
}


$result = DBQuery("select pw, file from {$_GET['table']} where num = {$_GET['num']} limit 1");
$row = mysqli_fetch_array($result);
$orgPW = $row['pw'];
$file = $row['file'];

if (! isset($_COOKIE['adminLogin']) || ($_COOKIE['adminLogin'] != md5('_yes_'))) {
	$passwd = $_GET['passwd'];
	$result = DBQuery("select passwd('$passwd')");
	$row = mysqli_fetch_row($result);
	$currPW = $row[0];

	if ($orgPW != $currPW) {
		DBClose($result);
		echo 'PW_ERROR';
		exit;
	}
}

$files = explode(':',$file);
for($i = 0; $i < count($files); $i++){
	unlink($_GET['table'] . '_files/' . $files[$i]); //지울 파일은 files의 변수 i번째
}

$files = explode(':', $file);
for ($i = 0; $i < count($files); $i++) {
	unlink($_GET['table'] . '_files/' . $files[$i]);
}


DBQuery("delete from {$_GET['table']}_cmts where b_num = {$_GET['num']}");
DBQuery("delete from {$_GET['table']} where num = {$_GET['num']} limit 1");

DBClose($result);

echo 'OK';
?>