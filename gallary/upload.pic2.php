<?php
include_once '../header.inc.html';
include_once '../db.inc.php';
setcookie('board_list_view', md5('yes'), 0, '/'); 
//점검, 확인
if (!is_uploaded_file($_FILES['pic']['tmp_name'])) {
	echo "FILE_NOT_UPLOADED";
	exit;
}

if (file_exists('./pics/' . $_FILES['pic']['name'])) {
	echo "SAME_FILE_EXISTS";
	unlink($_FILES['pic']['tmp_name']);
	exit;
}
/*이상이 없을 때, 실제로 이동 됨.*/
if (!move_uploaded_file($_FILES['pic']['tmp_name'], './pics/' . $_FILES['pic']['name'])) {
	echo "MOVE_FAIL";
	unlink($_FILES['pic']['tmp_name']);
	exit;
}

$name = $_POST['name'];
$title = addslashes($_POST['title']);
$pic = $_FILES['pic']['name'];
$pw = $_POST['pw'];
$upTime = time();

DBQuery("insert into gallery values(null, '$name', $upTime, '$title', '$pic', password('$pw'))");

echo "OK";

include_once '../footer.inc.html';
?>