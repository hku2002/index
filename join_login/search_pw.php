<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>해규의 홈페이지</title>
	<link rel="stylesheet" href="../css/common.css" />
</head>
<body>
<?php
	require_once("../top_navi.php");
	require_once("../sub_top_img.php");
?>
<div class="sub_wrap">
	<div class="sub_container">
		<div class="sub_top">
			<div class="sub_top_title">비밀번호찾기</div>
			<div class="sub_top_route">Home>로그인>비밀번호찾기</div>
			<div class="clear"></div>
		</div>
		<div class="sub_middle">
			<div class="search_pw_mblgn"><span style="color:#0054FF">비밀번호</span><br/>찾기</div>
			<div class="search_pw_text_wrap">
				<div class="search_pw_text">이름</div>
				<div class="search_pw_text">아이디</div>
				<div class="search_pw_text">이메일</div>
			</div>
			<form action="pw_authorization.php" method="POST">
				<div class="search_pw_input">
					<div class="search_pw_idPw">
						<input class="name_value" type='text' name='name_value'size='10'/>
					</div>
					<div class="search_pw_idPw">
						<input class="id_value" type='text' name='id_value'size='15'/>
					</div>
					<div class="search_pw_idPw">
						<input class="email01" type='text' name='email01' size='16'/> @ 
						<input class="email02" type='text' name='email02' size='16'/>
					</div>
				</div>
				<input type="hidden" name="data" value="1"/>
				<button class="search_pw_btn" type="submit">찾기</button>
				<div class="clear"></div>
				<div class="search_pw_bottom_text">
					- 회원가입시 입력한 이름과 이메일을 입력하여 주십시요.<br/>
					- 회원정보에 등록된 정보와 입력한 정보가 같아야, 인증번호를 받을 수 있습니다.
				</div>
			</form>
		</div>
	</div>
</div>
<div>
	<?php
		require_once("../footer.php");
	?>
</div>
</body>
</html>
