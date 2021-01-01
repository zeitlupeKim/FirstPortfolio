<?php
$name = $_POST['name'];
$title = addslashes($_POST['title']);
$content = addslashes($_POST['content']);
$password = $_POST['password'];
$isPrivate = $_POST['isPrivate'];

$wtime = time();
$ip = getenv('REMOTE_ADDR'); //환경변수중에 클라이언트의 ip를 가져온다.

$num_of_file = count($_FILES['file']['tmp_name']); //count는 배열을 대상으로 해서 사용한다.
$ok_list = array(); //정상적인 것들을 저장.
$same_file_list = array(); //같은 파일
$not_saved_list = array(); //저장 오류. 권한이 없거나 오류가 있거나 그런 상황에 맞는 것들을 저장.


for($i=0; $i < $num_of_file; $i++){
    if(is_uploaded_file($_FILES['file']['tmp_name'][$i])){ //임시 폴더에 저장되어 있는 것들을 복사하기 전에
        if(file_exists('./' . $_GET['table'] . '_files/' . $_FILES['file']['name'][$i])){ //같은 이름의 파일이 존재하면
            array_push($same_file_list , $_FILES['file']['name'][$i]); //같은 이름의 리스트에 올린다.
            unlink($_FILES['file']['tmp_name'][$i]); //파일 지우는 명령
            continue;
        }
        
        //만약 저장을 하지 못했다면, 업로드된 파일을 옮긴다.
        if(! move_uploaded_file($_FILES['file']['tmp_name'][$i],'./' . $_GET['table'] . '_files/' . $_FILES['file']['name'][$i]))){ 
            array_push($not_saved_file, $_FILES['file']['name'][$i])!!;
            unlink($_FILES['file']['tmp_name'][$i]); //파일 지우는 명령
            continue;
        }
        
        array($ok_list,$_FILES['file']['name'][$i]);
    }
}
$msg="";

if(count($same_file_list) > 0){ //파일의 갯수가 0 초과면
    $msg = 'SAME_FILE;';
    for($i = 0; $i<count($same_file_list), $i++){
      if($i==0){
          $msg .=$same_file_list[$i];
      }else{
          $msg.=', ' . $same_file_list[$i];
      }
    }
}

if(count($same_file_list) > 0){
    $msg = 'SAME_FILE;';
    for($i = 0; $i<count($same_file_list), $i++){
      if($i==0){
          $msg .=$same_file_list[$i];
      }else{
          $msg.=', ' . $same_file_list[$i];
      }
    }
}
?>