<?php
include_once './db.inc.php';

//테이블 이름이 tableName 그리고 adminID가 'kswj1510과 같은 것을 adminList테이블로부터 찾아라
$result = DBQuery("select *from adminList where tableName = '*' and adminID = '{$_GET['id']}' limit 1");
if (mysqli_num_rows($result) < 1){
	echo 'FAIL';
	DBClose();
	exit;
}


$row = mysqli_fetch_array($result);

$orgPW = $row['adminPW']; //DB에서 불러온 adminPW의 값이 orgPW에 있음.
//GET방식을 통해 날아온 값 중에 pw라는 키에 들어 있는 값을 패스워드 함수를 통해서 사용자가 보낸 내용을 암호화를 한다. 이 결과 레코드에서 줄 형식으로 뽑아와라.
//실제로 뽑아 온 것은 1줄 1칸짜리 정보가 나옴.
$userPW = mysqli_fetch_row(DBQuery("select password('{$_GET['pw']}')"))[0];

if($orgPW != $userPW){
	echo 'FAIL';
	DBClose($result);
	exit;
}



//COOKIE 굽자 : adminLogin에 md5('_yes_')를 집어넣어서 현재 브라우저를 닫을 때까지 사이트 전체적으로 접근이 가능하도록 한다라는 의미.
//md5('_yes_')이렇게 사용하게 되면 이 변수가 언제까지 유효한가? 접근 범위 제어는? 이러한 것들이 힘들어지므로, 쿠키로 해결을 한다. 쿠키이름, 암호화(_yes_), 현재 시간 브라우저 닫을때까지, 접)
//세 번째 매개변수에서 time() + 3600초를 하면 한시간 단위를 의미하게 됨. 1분 = 60초임
setcookie('adminLogin', md5('_yes_'), 0, '/');

echo 'OK';
DBClose($result);
?>
