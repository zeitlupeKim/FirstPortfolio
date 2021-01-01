<?php
include_once '../db.inc.php';

$result = DBQuery("select count(*) from adminList where tableName = '{$_GET['table']}' and adminID = '{$_GET['adminID']}'");//adminList의 테이블의 필드 tableName이 이 get방식을 통해 넘어온 table과 같은 것이 몇 개인가? - 이 레코드 셋에는 한 줄 한 칸의 정보를 가지고 있다. 

		$row = mysqli_fetch_row($result); // 이 결과 레코드 셋에서 row 형식으로 자료를 가져온다. 
		$count = $row[0];//첫 번째 칸에 있는 내용을 count에 집어 넣어놓음.
		if($count < 1) {
			DBClose($result);
			echo 'ID_NOT_FOUND';
			exit;	
		}

$result = DBQuery("select * from adminList where tableName = '{$_GET['table']}' and adminID = '{$_GET['adminID']}'");
$row = mysqli_fetch_array($result);
$org_pw = $row['adminPW'];

$result = DBQuery("select password('{$_GET['adminPW']}')");
$row = mysqli_fetch_row($result);
$pw = $row[0];

if ($org_pw != $pw) {
	DBClose($result);
	echo 'PW_ERROR';
	exit;
}


setcookie('admin', md5($_GET['table']), 0, '/'); //첫 번째 매개변수는 쿠키 이름, 두 번쨰 매개변수는 쿠키가 가질 값. md5라는 함수를 가진다. 암호화를 할 떄 쓰는 함수. 현재 사용중인 table 이름을 md5로 암호화한다. 세 번째 매개변수는 경로를 의미함. 네 번쨰 매개변수는 시간을 제어함. 예) 1시간 : time() + 3600, 0으로 하면 브라우저가 종료될 떄 까지 유효함. 관리자 모드

DBClose($result);


echo 'OK';
?>

