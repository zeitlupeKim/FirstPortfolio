<?php
/*기기 이름을 보려면 http user agent 값을 찍어보면 된다*/
$mobiles = array(
    'iphone',
    'ipad',
    'galaxy',
    'IEMobile',
);

for($i=0; $i < count($mobiles); $i++){
    if(strpos($_SERVER['HTTP_USER_AGENT'], $mobiles[$i]) > 0){
        header("Location: https://holosoft.co.kr/~kswj1510/mobile");
        exit;
    }
}
//서비스 내용, 실제 서비스 할 때는 다음코드를 반드시 지우자.
$echo $_SERVER['HTTPS_USER_AGENT'];
?>