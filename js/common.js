
/************************
		login.php
************************/
function loginBtn() {
	var id = document.login_frm.log_id.value;
	var pw = document.login_frm.log_passwd.value;

	if(id=="") {
		alert("아이디를 입력하세요.");
		return focus();
	} else if(pw=="") {
		alert("비밀번호를 입력하세요.");
		return focus();
	}
	document.login_frm.submit();
}


/************************
	join_agree.php
************************/
function join_agree() {
	var agree_terms = document.getElementById("agree_terms");
	var agree_pers_info = document.getElementById("agree_pers_info");
	var join_data = document.join_data.data.value;
	if(!agree_terms.checked) {
		alert("이용약관에 동의를 해주세요.");
		return;
	} else if(!agree_pers_info.checked) {
		alert("개인정보취급방침에 동의를 해주세요.");
		return;
	} else {
		document.join_data.submit();
		//location.href = "./join.php";
	}
}



/************************
		join.php
************************/
function join_submit() {
	
	//var regexp = /^[a-z0-9]{6,15}$/;
	var pattern1 = /[0-9]/;                     //숫자
	var pattern2 = /[a-zA-Z]/;                  //문자
	var pattern3 = /[~!@#$%^&*()_+|<>?:{}]/;    //특수문자
	
	
	if(document.join_form.id.value=='') {
		alert("아이디를 입력하세요");
		return focus();	
	} else if(!pattern1.test(document.join_form.id.value)||!pattern2.test(document.join_form.id.value)||
			document.join_form.id.value.length>15||document.join_form.id.value.length<6) {
		alert("아이디는 영문,숫자 6~15글자만 가능합니다.");		
	} else if(document.join_form.password.value=='') {
		alert("비밀번호를 입력하세요");
		return focus();
	} else if(!pattern1.test(document.join_form.password.value)||!pattern2.test(document.join_form.password.value)||!pattern3.test(document.join_form.password.value)||
			document.join_form.password.value.length>20||document.join_form.password.value.length<6) {
		alert("비밀번호는 영문,숫자,특수문자포함 6~20글자만 가능합니다.");		
	} else if(document.join_form.password.value!=document.join_form.password_identfy.value) {
		alert("비밀번호와 비밀번호 확인 데이터가 일치하지 않습니다.");
		return focus();
	} else if(document.join_form.name.value=='') {
		alert("이름을 입력하세요.");
		return focus();
	} else if(document.join_form.email01.value=='') {
		alert("이메일을 입력하세요.")
		return focus();
	} else if(document.join_form.email02.value=='') {
		alert("이메일을 입력하세요.")
		return focus();
	} else {
		document.join_form.submit();
	}
}



/************************
	info_change.php
************************/
function info_change_submit() {
	document.info_change_form.action = './info_change_check.php';
	document.info_change_form.submit();
}


/************************
  inquiry_send_check.php
************************/
function inquiry_send() {
	var id      = document.send_mail.id.value;
	var name    = document.send_mail.name.value;
	var email   = document.send_mail.email.value;
	var title   = document.send_mail.title.value;
	var message = document.send_mail.message.value;
	if(title == "") {
		alert("제목을 입력하여 주십시요.");
		return send_mail.title.focus();
	} else if(message == "") {
		alert("내용을 입력하여 주십시요.");
		return send_mail.message.focus();
	} else {
	document.send_mail.submit();
	}
}


/************************
  test_board_write.php
************************/
function write_check() {
	var passwd = document.tb_write_ok.bPassword.value;
	if(passwd == '') {
		alert('비밀번호를 입력하여 주십시요.');
		return tb_write_ok.bPassword.fucus();
	} else {
		document.tb_write_ok.submit();
	}
}


/************************
    new_password.php
************************/
function pw_change_button() {
	var pattern1 = /[0-9]/;                     //숫자
	var pattern2 = /[a-zA-Z]/;                  //문자
	var pattern3 = /[~!@#$%^&*()_+|<>?:{}]/;    //특수문자
	var passwd01 = document.new_pw_form.password.value;
	var passwd02 = document.new_pw_form.password_identfy.value;
	if(passwd01 == '') {
		alert("비밀번호를 입력하여 주십시요.");
		return new_pw_form.password.focus();
	} else if(passwd02 == '') {
		alert("비밀번호 확인란를 입력하여 주십시요.");
		return new_pw_form.password_identfy.focus();
	} else if(passwd01 != passwd02) {
		alert("비밀번호가 서로 일치하지 않습니다.");
		return new_pw_form.password_identfy.focus();
	} else if(!pattern1.test(document.new_pw_form.password.value)||!pattern2.test(document.new_pw_form.password.value)||!pattern3.test(document.new_pw_form.password.value)||
		document.new_pw_form.password.value.length>20||document.new_pw_form.password.value.length<6) {
		alert("비밀번호는 영문,숫자,특수문자포함 6~20글자만 가능합니다.");
		return focus();
	} else {
		document.new_pw_form.submit();
	}
} 