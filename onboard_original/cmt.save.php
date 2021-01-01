<?php
if (!isset($_COOKIE['board_list_view']) || $_COOKIE['board_list_view'] != md5('yes')) {
	header('Location: http://goto.hell');
	exit;
}
include_once '../db.inc.php';

$table = $_GET['table'] . '_cmts';
$name = addslashes($_GET['name']);
$wr_time = time();
$ip = getenv('REMOTE_ADDR');
$comment = addslashes($_GET['comment']);

DBQuery("insert into $table values(null, {$_GET['b_num']}, '$name', $wr_time, '$ip', '$comment', 0, 0)");

$max_num = mysqli_fetch_row(DBQuery("select max(num)from $table"))[0]; //1행 1열의 번호값을 뽑아옴

$result = DBQuery("select * from $table where num = $max_num limit 1");
$cmt = mysqli_fetch_array($result);
DBClose($result);

$wr_time = date('Y년 n월 j일 H:i', $cmt['wr_time']);
$comment = nl2br($cmt['comment']);

echo <<< _FIELDSET_
<fieldset>
	<legend>[ <b>{$cmt['name']}</b> ] &nbsp;<span style='color: silver;'>|</span>&nbsp; [ 시각 : $wr_time ] &nbsp;<span style='color: silver;'>|</span>&nbsp; [ IP : {$cmt['ip']} ]</legend>
	$comment
	<div style='text-align: right; padding-right: 30px;'>
		<input type="button" value="좋아요" class="btn2" onClick="IncGood('{$_GET['table']}', {$cmt['num']});"/> <span id="cmt_good_{$cmt['num']}">{$cmt['good']}</span> &nbsp;<span style="color: silver;">|</span>&nbsp; 
		<input type="button" value="싫어요" class="btn2" onClick="IncBad('{$_GET['table']}', {$cmt['num']});"/> <span id="cmt_bad_{$cmt['num']}">{$cmt['bad']}</span>
	</div>
</fieldset>
_FIELDSET_;
?>