<?php
	if(!isset($_POST['data'])){
		echo "<script>alert('정상 경로로 접속해 주십시요.');location.href='http://hku2002.cafe24.com/Z_TEST/index.php'</script>";
	}

	require_once("../dbconfig.php");

	$auth_num = $_POST['auth_num'];
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>해규의 홈페이지</title>
</head>
<body>
<div class="sub_wrap">
	<div class="sub_container">
		<div class="sub_top">
			<div class="sub_top_title">아이디찾기</div>
			<div class="sub_top_route">Home>로그인>아이디찾기</div>
			<div class="clear"></div>
		</div>
		<div class="sub_middle">
			고객님의 id 는
		</div>
	</div>
</div>
</body>
</html>
