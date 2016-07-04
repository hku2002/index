<?php
	if(!isset($_POST['data'])){
		echo "<script>alert('정상 경로로 접속해 주십시요.');location.href='http://hku2002.cafe24.com/Z_TEST/index.php'</script>";
	} else if ($_POST['data']=='2') {

		require_once("../dbconfig.php");
		$member_id   = $_POST['member_id'];

		$sql    = "select member_id, auth_num from z_test_pw_check where member_id='". $member_id ."'";
		$result = $db->query($sql);
		$row    = $result->fetch_assoc();

		$random_int = $row['auth_num'];

		$id_value = $member_id;

	} else {
		require_once("../dbconfig.php");
		$name_value = $_POST['name_value'];
		$id_value   = $_POST['id_value'];
		$email01    = $_POST['email01'];
		$email02    = $_POST['email02'];
		$email      = $email01 . '@' . $email02;

		$sql    = "select member_id from z_test_pw_check where member_id='". $id_value ."'";
		$result = $db->query($sql);
		$row    = $result->fetch_assoc();

		if(isset($row['member_id'])) {
			$sql = "delete from z_test_pw_check where member_id = '".$id_value."'";
			$result = $db->query($sql);
		} else {
			$sql    = "select member_id, member_name, email from z_test_member where member_id='". $id_value ."' and member_name='". $name_value . "' and email='" . $email . "'";
			$result = $db->query($sql);
			$row    = $result->fetch_assoc();	
		}

		if(empty($row)) {
			echo '<script>alert("입력하신 정보가 올바르지 않습니다.");history.back()</script>';
		} else {
			header("Content-Type: text/html; charset=UTF-8");
			$random_int = rand(000000,999999);
			$to = $email;
			$msg = '인증번호 : '.$random_int;
		   
			mail($to,"비밀번호 찾기 인증번호 입니다.",$msg,"From: customer@hku2002.cafe24.com\r\n");	

			$sql = "insert into z_test_pw_check (member_id, email, member_name, auth_num) values('".$id_value."', '".$email."', '".$name_value."', '".$random_int."')";
			$result = $db->query($sql);
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>해규의 홈페이지</title>
	<link rel="stylesheet" href="../css/common.css" />
	<script type="text/javascript">	
		//새로고침 방지
		function noEvent() { 
			if(event.keyCode == 116) {
				event.keyCode = 2;
				return false;
			} else if(event.ctrlKey && (event.keyCode==78 || event.keyCode == 82)) {
				return false;
			}
		}
		document.onkeydown = noEvent;

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
			<div class="sub_top_title">비밀번호찾기</div>
			<div class="sub_top_route">Home>로그인>비밀번호찾기</div>
			<div class="clear"></div>
		</div>
		<div class="sub_middle">
			<div class="search_pw_wrap">
				<div class="search_pw_text01">인증번호를 입력하신 이메일로 발송하였습니다.</div>
				<div class="search_pw_text02">인증번호 : </div>
				<form action="./new_password.php" name="search_pw_form" method='post'>
					<div class="input_auth01"><input class="input_auth02" type="text" name="input_auth02" placeholder="인증번호를 입력하여 주십시요."/></div>
					<input type="hidden" name="data" value="1"/><input type="hidden" name="id_value" value="<?=$id_value?>"/>
					<button class="search_pw_button" onclick="pw_authorization()">인증하기</button>
				</form action="./new_password.php" method="POST"> 
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
