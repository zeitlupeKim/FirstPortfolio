<?php
    $crypted_pw = crypt($_GET['pw']);
echo "서버에서 보내온 내용입니다. <hr> 암호화된 결과는 {$crypted_pw}입니다.";
?>