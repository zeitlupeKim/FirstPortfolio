<?php

/* 
*****************************************************************************
*******************************Setting variable******************************
*****************************************************************************
*/
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

/* 
********************************************************************************
*******************Setting definition of upload and error***********************
********************************************************************************
*/
for($i = 0; $i < $num_of_file; $i++){
    //임시 폴더에 저장되어 있는 것들을 복사하기 전에같은 이름의 파일이 존재하면
    if(is_uploaded_file($_FILES['file']['tmp_name'][$i])){ 
        if(file_exists('./' . $_GET['table'] . '_files/' . $_FILES['file']['name'][$i])){ 
            array_push($same_file_list, $_FILES['file']['name'][$i]); //같은 이름의 리스트에 올린다.
            unlink($_FILES['file']['tmp_name'][$i]); //파일 지우는 명령
            continue;
        }
        
        //만약 저장을 하지 못했다면, 업로드된 파일을 옮긴다.
        if(!move_uploaded_file($_FILES['file']['tmp_name'][$i], './' . $_GET['table'] . '_files/' . $_FILES['file']['name'][$i])){ 
            array_push($not_saved_file, $_FILES['file']['name'][$i]);
            unlink($_FILES['file']['tmp_name'][$i]); //파일 지우는 명령
            continue;
        }

        array_push($ok_list, $_FILES['file']['name'][$i]);
    }
}

$msg=''; //에러메세지

if(count($same_file_list) > 0){ //파일의 갯수가 0 초과면
    $msg = 'SAME_FILE:';
    for($i = 0; $i<count($same_file_list); $i++){
      if($i == 0){
          $msg .= $same_file_list[$i]; // ??
      }
	  else{
          $msg .= ', ' . $same_file_list[$i]; // 두 번째 파일부터는 콤마로 파일을 이어서 연결
      }
    }
}

if(count($not_saved_list) > 0){ // 앞부분에 에러가 있으면
    if(strlen($msg) > 0){
        $msg .= '||SAVE_ERROR:';
    }
	else{
        $msg = 'SAVE_ERROR:';
    }
   
    for($i = 0; $i < count($not_saved_list); $i++){
      if($i == 0){
          $msg .= $not_saved_list[$i];
      }
	  else{
          $msg .= ', ' . $not_saved_list[$i];
      }
    }
}

if(count($ok_list) > 0){ // 앞부분에 에러가 있으면 
$msg .= '||_OK_';
$file = '';
    for($i = 0; $i < count($ok_list); $i++){
        if($i == 0){
            $file = $ok_list[$i];
        }
        else{
            $file .= ':' . $ok_list[$i];
        }
    }
    
	include_once '../db.inc.php'; //정상적으로 완료되었을 때, DB에 입력받는 로직
    DBQuery("insert into {$_GET['table']} values(null, '$name', '$title', '$content', $wtime, '$ip', password('$password'), 0, '$file', '$isPrivate');");
    DBClose();
}
    
echo $msg;
?>