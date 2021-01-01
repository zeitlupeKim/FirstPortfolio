<?php
include_once './send_attach.php';
send_attachment($_GET['fname'], $_GET['table'] . '_files/' . $_GET['fname']); // 파일이름, 경로는 테이블이름_fiels
?>