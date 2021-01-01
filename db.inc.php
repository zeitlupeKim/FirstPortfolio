<?php

$link = mysqli_connect('localhost', 'kswj1510','rlaehdrjs','kswj1510') or die('DB서버에 접속할 수 없습니다.');

function DBQuery($q){
	global $link; 
	
	$result = mysqli_query($link, $q) or die('Query error : 요청한 쿼리를 실행할 수 없습니다');
	//$result = mysqli_query($link, $q) or die('Query error : <b>' . mysqli_error($link) . '</b>');
	
	return $result;
}

function DBClose($result = null){
	global $link;
	if($result) {
		mysqli_free_result($result);
	}
	mysqli_close($link);
}
?>
