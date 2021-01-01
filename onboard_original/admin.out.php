<?php
setcookie('admin','', time() - 3600, '/'); //첫 번째 매개변수는 쿠키 이름, 두 번쨰 매개변수는 쿠키가 가질 값. md5라는 함수를 가진다. 암호화를 할 떄 쓰는 함수. 현재 사용중인 table 이름을 md5로 암호화한다. 세 번째 매개변수는 경로를 의미함. 
echo "<script>location.href='list.html?={$_GET['tale']}';</script>";
?>

