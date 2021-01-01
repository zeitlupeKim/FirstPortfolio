<?php

include_once '../db.inc.php';

$name = $_POST['name'];  //  <-- 수퍼 글로벌, POST방식으로 'name'을 $name에 넣어라. 
$tel = $_POST['tel']; 
$email = $_POST['email']; 
$etc = addslashes($_POST['etc']); 

mysqli_query($link,"insert into namecard values(null, '$name', '$tel', '$email', '$etc')") or die('요청한 쿼리를 수행할 수 없습니다.');

mysqli_close($link); //열은 것을 닫음.

echo "<script>opener.location.reload(); self.close();</script>"; //자신을 연 window는 parent를 이용. 나를 읽어들인 부모를 새로 갱신.

?>