<?php
include_once '../db.inc.php';

$result = DBQuery("select * from gallery where num = {$_GET['num']} limit 1");
$row = mysqli_fetch_array($result);
$org_pw = $row['pw'];
$pic = $row['pic'];

//$result = DBQuery("select password('{$_GET['pw']}')");
//$row = mysqli_fetch_row($result);
//$new_pw = $row[0];
$new_pw = mysqli_fetch_row(DBQuery("select password('{$_GET['pw']}')"))[0];

if ($org_pw != $new_pw) {
	echo 'PW_ERROR';
	DBClose();
	exit;
}

DBQuery("delete from gallery where num = {$_GET['num']} limit 1");
unlink('./pics/' . $pic);

echo "OK";
DBClose();

?>
<?php
include_once '../footer.inc.html';
?>
