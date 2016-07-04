<?php
	if(!isset($_POST['data'])){
		echo "<script>alert('정상 경로로 접속해 주십시요.');location.href='http://hku2002.cafe24.com/Z_TEST/index.php'</script>";
	} else {
		require_once("../dbconfig.php");
		$member_id  = $_POST['id_value'];
		$auth_num   = $_POST['input_auth02'];

		$sql    = "select member_id, auth_num from z_test_pw_check where member_id='".$member_id."'";
		$result = $db->query($sql);
		$row    = $result->fetch_assoc();

		$number = $row['auth_num'];
?>
<form action="./pw_authorization.php" name="data_value" method='post'>
	<input type="hidden" name="data" value="2" />
	<input type="hidden" name="member_id" value="<?=$member_id?>"/>
</form>
<?php
		if($number != $auth_num) {
			echo "<script>alert('인증번호가 일치하지 않습니다.');
			document.data_value.submit();
			</script>";
		} else {
			echo "<script>alert('인증번호가 일치합니다.');</script>";
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>해규의 홈페이지</title>
	<link rel="stylesheet" href="../css/common.css" />
	<script src="../js/common.js"></script>
</head>
<body>
<?php
	require_once("../top_navi.php");
	require_once("../sub_top_img.php");
?>
<script type="text/javascript">	
	var pattern1 = /[0-9]/;                     //숫자
	var pattern2 = /[a-zA-Z]/;                  //문자
	var pattern3 = /[~!@#$%^&*()_+|<>?:{}]/;    //특수문자
	var pwFlag = false;

	window.onload = function(){
		document.getElementById("input_pw01").addEventListener('blur', pwChecker);
		document.getElementById("input_pw02").addEventListener('blur', pwChecker);
	}

	function pwChecker() {
	var pw1 = document.new_pw_form.password.value;
	var pw2 = document.new_pw_form.password_identfy.value;
	var resultStr = '';
	
		if(pw1 != '' && pw2 != '') {
			if(!pattern1.test(pw1) || !pattern2.test(pw1) || !pattern3.test(pw1) || pw1.length>20 || pw1.length<6) {
				resultStr = '<span class="pw_no">비밀번호 조건에 맞지 않습니다.</span>';
				document.getElementById("pw_check").innerHTML = resultStr;
				pwFlag = false;
			} else if(pw1 == pw2) {
				resultStr = '<span class="pw_ok">올바른 비밀번호 입니다.</span>';
				document.getElementById("pw_check").innerHTML = resultStr;
				pwFlag = true;
			} else {
				resultStr = '<span class="pw_no">비밀번호가 일치하지 않습니다.</span>';
				document.getElementById("pw_check").innerHTML = resultStr;
				pwFlag = false;
			}
		}
		//두개의 입력란 중 하나라도 입력이 안되어 있을 경우 실행
		if(pw1 == '' || pw2 == '') {
			if(pw1 == pw2) {
				resultStr = '<span class="pw_ok">6~20자,영문 소문자,숫자,특수문자를 사용하세요.</span>';
				document.getElementById("pw_check").innerHTML = resultStr;
				pwFlag = false;
			}
		}
	}
</script>

<div class="sub_wrap">
	<div class="sub_container">
		<div class="sub_top">
			<div class="sub_top_title">새비밀번호</div>
			<div class="sub_top_route">Home>로그인>비밀번호찾기>새비밀번호</div>
			<div class="clear"></div>
		</div>
		<div class="sub_middle">
			<div style="margin:50px 0 30px 0;color:black;font-weight:bold;font-size:16px">새로운 비밀번호를 입력하시기 바랍니다.</div>
			<form name="new_pw_form" action="./new_password_check.php" method="post">
				<table cellspacing="0" cellpadding="0" width="770px" border="0" align="center">
					<tr>
						<td class="join_table01" style="border-top:1px solid #CACACA">비밀번호</td>
						<td class="join_table02" style="border-top:1px solid #CACACA">
							<input class="join_input01" id="input_pw01" name="password" type="password" size="38" placeholder="6~20자,영문소문자,숫자,특수문자를 사용하세요."/>
							<span class="pw_ok" id="pw_check">6~20자,영문소문자,숫자,특수문자를 사용하세요.</span>
						</td>
					</tr>
					<tr>
						<td class="join_table01">비밀번호 확인</td>
						<td class="join_table02">
							<input class="join_input01" id="input_pw02" name="password_identfy" type="password" size="38" placeholder=" 6~20자,영문소문자,숫자,특수문자를 사용하세요."/>	
						</td>
					</tr>
				</table>
				<input type="hidden" name="data" value="1"/>
				<input type="hidden" name="member_id" value="<?=$member_id?>"/>
			</form>
			<button type="button" onclick="pw_change_button()" style="width:60px;height:28px;margin:15px 0 200px 700px;color:white;font-size:13px;background-color:#0054FF;border:1px solid #0054FF;cursor:pointer">변경</button>
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
