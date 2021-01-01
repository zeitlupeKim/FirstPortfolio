function Login(){
	//Verify ID
	let userID = document.getElementById('userID').value;

	if(!userID){
		alert('아이디를 입력하세요');
		document.getElementById('userID').focus();
		return;
	}
	
	//Verify PW
	let userPW = document.getElementById('userPW').value;

	if(!userPW){
		alert('비밀번호를 입력하세요');
		document.getElementById('userPW').focus();
		return;
	}

	//Setting AJAX ansychronous communication
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			if(this.responseText == 'OK'){
				location.reload();
			}
			else{
				alert('너도 법적으로 처벌받을 수 있습니다');
			}
		}
	};

	xhr.open('GET', 'https://holosoft.co.kr/~kswj1510/admin.login.php?id=' + userID + '&pw=' + userPW,true);
	xhr.send();
}

function Logout(){
	//Setting AJAX ansychronous communication
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
				location.reload();
		}
	};
	
	xhr.open('GET', 'https://holosoft.co.kr/~kswj1510/admin.logout.php', true);
	xhr.send();
}