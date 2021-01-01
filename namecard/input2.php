<?php

include_once '../db.inc.php';

$name = $_GET['name'];  //  <-- 수퍼 글로벌, POST방식으로 'name'을 $name에 넣어라. 
$tel = $_GET['tel']; 
$email = $_GET['email']; 
$etc = $_GET['etc']; 

mysqli_query($link,"insert into namecard values(null, '$name', '$tel', '$email', '$etc')") or die('QUERY_FAILED');

mysqli_close($link); //열은 것을 닫음.

echo "OK"; //자신을 연 window는 parent를 이용. 나를 읽어들인 부모를 새로 갱신.

?>