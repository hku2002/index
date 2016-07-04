<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=1350px" />
<link rel="stylesheet" href="../css/common.css" />
<script src="../js/common.js"></script>
<title>해규의 홈페이지</title>
</head>
<body>

<?php
	header("Content-Type: text/html; charset=UTF-8");
	require_once("../top_navi.php");
	require_once("../sub_top_img.php");
	if(isset($_SESSION['id'])) {
		echo "<script>alert('로그인이 되어 있습니다.');history.back();</script>";
	}
?>

<form name="login_frm" action="./login_check.php" method='post'>
	<div class="login_wrap">
		<div class="login_content">
			<div class="sub_top">
				<div class="sub_top_title">회원 로그인</div>
				<div class="sub_top_route">Home>로그인</div>
				<div class="clear"></div>
			</div>
			<div class="login_mblgn"><span style="color:#0054FF">MEMBER</span><br/>LOGIN</div>
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
			<button class="join_btn" onclick="loginBtn()">로그인</button>
			<div class="clear"></div>
			<a href="./search_id.php"><div class="search_id" onmouseover="this.style.color='#0054FF'" onmouseout="this.style.color='black'">아이디 찾기</div></a>
			<a href="./search_pw.php"><div class="search_pw" onmouseover="this.style.color='#0054FF'" onmouseout="this.style.color='black'">비밀번호 찾기</div></a>
		</div>
	</div>
</form>
<div>
	<?php
		require_once("../footer.php");
	?>
</div>

</body>
</html>