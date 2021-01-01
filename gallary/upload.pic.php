<?php
include_once '../header.inc.html';
include_once '../db.inc.php';
setcookie('board_list_view', md5('yes'), 0, '/'); 


if (!is_uploaded_file($_FILES['pic']['tmp_name'])) {
	echo "<script>alert('파일이 업로드되지 않았습니다. 관리자에게 문의하십시오.'); history.go(-1);</script>";
	exit;
}

if (file_exists('./pics/' . $_FILES['pic']['name'])) {
	echo "<script>alert('이름이 같은 파일이 있습니다. 이름을 바꾼 후 업로드하십시오.'); history.go(-1);</script>";
	exit;
}

if (!move_uploaded_file($_FILES['pic']['tmp_name'], './pics/' . $_FILES['pic']['name'])) {
	echo "<script>alert('파일을 저장할 수 없습니다. 관리자에게 문의하십시오.'); history.go(-1);</script>";
	exit;
}

$name = $_POST['name'];
$title = addslashes($_POST['title']);
$pic = $_FILES['pic']['name'];
$pw = $_POST['pw'];
$upTime = time();

DBQuery("insert into gallery values(null, '$name', $upTime, '$title', '$pic', password('$pw'))");

echo "<script>opener.location.reload(); self.close();</script>";

?>
