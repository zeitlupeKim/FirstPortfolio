<?php
include_once '../db.inc.php';

$num = $_GET['num'];
$name = $_GET['name'];  //  <-- 수퍼 글로벌, POST방식으로 'name'을 $name에 넣어라. 
$tel = $_GET['tel']; 
$email = $_GET['email']; 
$etc = addslashes($_GET['etc']); 

mysqli_query($link,"update namecard set name = '$name', tel = '$tel', email = '$email', etc = '$etc' where num = $num limit 1") or die('QUERY_FAILED');

mysqli_close($link); //열은 것을 닫음.

echo "OK"; //자신을 연 window는 parent를 이용. 나를 읽어들인 부모를 새로 갱신.

?>