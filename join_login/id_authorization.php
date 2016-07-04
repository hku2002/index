<?php
	if(!isset($_POST['data'])){
		echo "<script>alert('정상 경로로 접속해 주십시요.');location.href='http://hku2002.cafe24.com/Z_TEST/index.php'</script>";
	}

	require_once("../dbconfig.php");
	$name_value = $_POST['name_value'];
	$email01    = $_POST['email01'];
	$email02    = $_POST['email02'];
	$email      = $email01 . '@' . $email02;

	$sql = "select member_id, member_name, email from z_test_member where member_name='". $name_value . "' and email='" . $email . "'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();

	

	if(empty($row)) {
		echo '<script>alert("입력하신 정보가 올바르지 않습니다.");history.back()</script>';
	} else {
		header("Content-Type: text/html; charset=UTF-8");
		$random_int = rand(000000,999999);
		$to = $email;
		$msg = '인증번호 : '.$random_int;
	    $headers = "From: customer@hku2002.cafe24.com\r\n";

		mail($to,"아이디 찾기 인증번호 입니다.",$msg, $headers); 
		$member_id = $row['member_id'];
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>해규의 홈페이지</title>
	<link rel="stylesheet" href="../css/common.css" />
	<script type="text/javascript">	
		function noEvent() { //새로고침 방지
			if(event.keyCode == 116) {
				event.keyCode = 2;
				return false;
			} else if(event.ctrlKey && (event.keyCode==78 || event.keyCode == 82)) {
				return false;
			}
		}
		document.onkeydown = noEvent;

		function id_authorization() {//보안안됨 수정요망
			var input_value = document.search_id_form.auth_num.value;
			if(input_value != '<?=$random_int ?>') {
				alert("인증번호가 올바르지 않습니다.");
			} else {
				alert("회원님의 id는 <?=$member_id?> 입니다.");
				window.location.replace('./login.php');
			}
		}
	</script>
</head>
<body oncontextment="return false">
<?php
	require_once("../top_navi.php");
	require_once("../sub_top_img.php");
?>

<div class="sub_wrap">
	<div class="sub_container">
		<div class="sub_top">
			<div class="sub_top_title">아이디찾기</div>
			<div class="sub_top_route">Home>로그인>아이디찾기</div>
			<div class="clear"></div>
		</div>
		<div class="sub_middle">
			<div class="search_id_wrap">
				<div class="search_id_text01">인증번호를 입력하신 이메일로 발송하였습니다.</div>
				<div class="search_id_text02">인증번호 : </div>
				<form action="id_identify.php" name="search_id_form" method="post">
					<div class="input_auth01"><input class="input_auth02" type="text" name="auth_num" placeholder="인증번호를 입력하여 주십시요."/></div>
					<input type="hidden" name="data" value="1"/>
				</form> 
				<button class="search_id_button" onclick="id_authorization()">인증하기</button>
				<div class="clear"></div>
			</div>
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
