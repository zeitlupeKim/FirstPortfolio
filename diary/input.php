<?php
include_once '../db.inc.php';

$year = $_POST['year'];
$month = $_POST['month'];
$pdate = $_POST['pdate'];
$ptime = $_POST['ptime'];
$promise = addslashes($_POST['promise']);

DBQuery("insert into diary values(null, $year, $month, $pdate, '$ptime', '$promise')");
DBClose();


?>
<script>
opener.location.reload();
self.close();
</script>

