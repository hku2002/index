<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./css/admin.css" />
	<title>관리자 페이지</title>
</head>
<body>

<form name="login_frm" action="./index_check.php" method='post'>
	<div class="login_wrap">
		<div class="login_content">
			<div class="login_mblgn"><span style="color:#0054FF">관리자</span><br/>LOGIN</div>
			<div class="login_text_wrap">
				<div class="login_text">아이디</div>
				<div class="login_text">비밀번호&nbsp</div>
			</div>
			<div class="login_input">
				<div class="login_idPw">
					<input class="login_text_idPw" type='text' name='log_id'size='16' placeholder='아이디'/>
				</div>
				<div class="login_idPw">
					<input class="login_text_idPw" type='password' name='log_passwd' size='16' placeholder='비밀번호'/>
				</div>
			</div>
			<button class="login_btn" type="submit" onclick="loginBtn()">로그인</button>
		</div>
	</div>
</form>

</body>
</html>
