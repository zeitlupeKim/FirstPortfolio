<?php

include_once '../db.inc.php';

mysqli_query($link,"delete from namecard where num = {$_GET['num']}") or die('요청한 쿼리를 수행할 수 없습니다.'); //없어도 상관은 없다.

mysqli_close($link); //열은 것을 닫음.

echo "<script>location.href='index.html'; </script>"; //자신을 연 window는 parent를 이용. 나를 읽어들인 부모를 새로 갱신.

?>