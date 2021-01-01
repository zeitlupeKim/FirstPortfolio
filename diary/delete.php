<?php
include_once '../db.inc.php';

	DBQuery("delete from diary where num =  {$_GET['num']} limit 1");  /*get방식으로 날아온 데이터중에 key가 num인 것을 1개만 지워라*/
	DBClose();
	echo 'OK'; 

?>
