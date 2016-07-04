<div class="header">
	<div class="logo"><img src="" width=100px height=48px alt="로고"/></div>
<?php
	session_start();
	if(isset($_SESSION['id'])){
		echo "<a href='./admin_logout.php'><div class='logout'>로그아웃</div></a><div class='header_id'>안녕하세요.&nbsp;". $_SESSION['id'] ."님</div></li>";
	} else {
		echo "<script>alert('정상경로로 접속하십시요.');location.href='http://hku2002.cafe24.com/Z_TEST/';</script>";
	}
?>
</div>