 $('document').ready(function(){
        $('#login').submit(function(){
            var userID = $('#userID').val();
            var userPW = $('#userPW').val();
            
            if(!userID){
                alert('아이디를 입력하든가');
                $('#userID').focus();
                return false;
            }
            
            if(!userPW){
                alert('비밀번호는 어쩌고!?');
                $('#userPW').focus();
                return false;
            }
        });
    });