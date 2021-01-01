function Modify(table, num, page, field, val) {
	location.href = 'modify.html?table=' + table + '&num=' + num + '&page=' + page + '&field=' + field + '&val=' + val;
}

function Delete(table, num, page, field, val) {
	var answer;

<?php
if (isset($_COOKIE['adminLogin']) && $_COOKIE['adminLogin'] == md5('_yes_')) {
?>
	answer = confirm('현재의 게시물을 지울까요?');
<?php
}
else {
?>
	answer = prompt('비밀번호를 입력하십시오.', '');
<?php
}
?>

	if (answer) {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if (this.responseText == 'PW_ERROR') {
					alert('비밀번호가 일치하지 않습니다. 확인 후 다시 시도하십시오.');
				}
				else if (this.responseText == 'OK') {
					location.href = 'index.html?table=<?=$_GET['table'];?>&page=<?=$_GET['page'];?>&field=<?=$_GET['field'];?>&val=<?=$_GET['val'];?>';
				}
			}
		};

		xhr.open('GET', 'delete.data.php?table=' + table + '&num=' + num + '&passwd=' + answer, true);
		xhr.send();
	}
}

function SaveCmt(form, table, num) {
	var cmtForm = new FormData(form);
	var name = document.getElementById('name').value;
	if (!/[^\s]{2,}/.test(name)) {
		alert('이름을 입력하십시오.');
		document.getElementById('name').value = "";
		document.getElementById('name').focus();
		return;
	}
	
	var cmt = document.getElementById('comment').value;
	if (!/[^\s]+/.test(cmt)) {
		alert('댓글 내용을 입력하십시오.');
		document.getElementById('comment').value = "";
		document.getElementById('comment').focus();
		return;
	}

	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById('cmtsCount').innerText = parseInt(document.getElementById('cmtsCount').innerText) + 1;
			document.getElementById('cmts_list').innerHTML += this.responseText;
		}
	};
	
	xhr.open('POST', 'cmt.save.php?table=' + table + '&b_num=' + num, true);
	xhr.send(cmtForm);

	document.getElementById('name').value = "";
	document.getElementById('comment').value = "";
}

function IncGood(table, num) {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById('cmt_good_' + num).innerText = this.responseText;
		}
	};

	xhr.open('GET', 'cmt.inc.good.php?table=' + table + '&num=' + num, true);
	xhr.send();
}

function IncBad(table, num) {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById('cmt_bad_' + num).innerText = this.responseText;
		}
	};

	xhr.open('GET', 'cmt.inc.bad.php?table=' + table + '&num=' + num, true);
	xhr.send();
}