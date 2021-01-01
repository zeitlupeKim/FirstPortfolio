<?php
include_once './db.inc.php';

$result = DBQuery("select * from adminList where tableName = '*' and adminID = '{$_GET['id']}' limit 1");

if(mysqli_num_rows($result) < 1) { //만약 질의값이 0개라면
	echo 'FAIL';
	DBClose();
	exit;
}

$row = mysqli_fetch_array($result);

$originalPassword = $row['adminPW']; 
$userPassword = mysqli_fetch_row(DBQuery("select password('{$_GET['pw']}')"))[0];
																
if($originalPassword != $userPassword){
	echo 'FAIL';
	DBClose($result); // 15행에서 조회한 DBQuery의 종료임
	exit;
}

setcookie('adminLogin',md5('_yes_'), 0 , '/'); //쿠키설정

echo 'OK';
DBClose($result);

/* 
***********************************기능해설***********************************
로그인과 관련되어 있음
include_once './db.inc.php'; 

테이블 이름이 *이고 adminID가 사용자가 입력한 id와 일치하는 값을 조회, 오직 1개이므로 1개만 리턴
$result = DBQuery("select *from adminList where tableName='*' and adminID='{$_GET['id']}' limit 1"); 

//만약 질의값이 0개라면 'FAIL'을 반환하고 DBQuery를 닫는다. php에서 exit는 스크립트의 실행을 종료한다.
if(mysqli_num_rows($result) < 1){ 
	echo 'FAIL'; 
	DBClose(); //DB 닫음
	exit; //종료
}

//질의값 result가 가지고 있는 값들의 배열을 리턴.
$row = mysqli_fetch_array($result);

$originalPassword = $row['adminPW']; 질의값의 원본 비밀번호인 adminPW의 값을 저장.
$userPassword = mysqli_fetch_row(DBQuery("select password('{$_GET['pw']}')"))[0]; 사용자가 입력한 비밀번호를 질의하여 얻은 결괏값을 저장
if($originalPassword != $userPassword){ //두 비밀번호가 서로 같지 않다면 오류 반환과 DBQuery종료, 그리고 스크립트 종료를 함.
	echo 'FAIL';
	DBClose($result); // 15행에서 조회한 DBQuery
	exit;
}

setcookie('adminLogin',md5('_yes_'),0,'/'); //쿠키설정

echo 'OK'; //스크립트가 강제종료되지 않는다면, 쿠키설정 후에 'OK'를 반환하고 DBQuery를 폐쇄할 것이다.
DBClose($result);
?>
*/


?>