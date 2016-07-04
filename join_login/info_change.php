<?php
	require_once("../dbconfig.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=1350px" />
<link rel="stylesheet" href="../css/common.css" />
<?php
	require_once("../top_navi.php");
	require_once("../sub_top_img.php");

	if($_SESSION['id'] == '') {
		echo "alert('정상경로로 접속하여 주십시요.');history.back();";
		exit;
	} else {
		$member_id = $_SESSION['id'];
		$member_id = str_replace("/","",$member_id);

		$sql = "select address, zipcode from z_test_member where member_id='".$member_id."'";
		$result = $db->query($sql);
		$row = $result->fetch_assoc();

		$address = $row['address'];
		$address_exp = explode("/", $address);
		if(!isset($address_exp[0])) {
			$address_exp[0] = '';
		} else if(!isset($address_exp[1])) {
			$address_exp[1] = '';
		}

		$zipcode = $row['zipcode'];

		$email     = $_SESSION['email'];
		$email_exp = explode("@", $email);
	}
?>
<script src="../js/common.js"></script>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script type="text/javascript">
function address_search() {
    new daum.Postcode({
		oncomplete: function(data) {
			// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 각 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullAddr = ''; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

			// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
			if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
				fullAddr = data.roadAddress;

			} else { // 사용자가 지번 주소를 선택했을 경우(J)
				fullAddr = data.jibunAddress;
			}

			// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
			if(data.userSelectedType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			document.getElementById('input_zipcode').value = data.zonecode; //5자리 새우편번호 사용
			document.getElementById('input_address').value = fullAddr;

			// 커서를 상세주소 필드로 이동한다.
			document.getElementById('input_address2').focus();
		}
	}).open();
}
</script>
<title>해규의 홈페이지</title>
</head>
<body>

<div class="join_top_wrap">
	<div class="join_top_content">
		<div class="sub_top">
			<div class="sub_top_title">개인정보수정</div>
			<div class="sub_top_route">Home>정보수정</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<div class="join_middle_wrap">
	<div class="join_middle_content">
		<form name="info_change_form" method="post">
			<div class="join_tb_name">필수 입력 사항</div>
			<table cellspacing="0" cellpadding="0" width="770px" border="0" align="center">
				<tr>
					<td class="join_table01" style="border-top:1px solid #CACACA">아이디</td>
					<td class="join_table02" style="border-top:1px solid #CACACA"><?=$member_id?></td>
					<input type="hidden" name="member_id" value=<?=$member_id?>/>
				</tr>
				<tr>
					<td class="join_table01">비밀번호</td>
					<td class="join_table02">
						<button class="change_pw" type="button">비밀번호변경</button>
					</td>
				</tr>
				<tr>
					<td class="join_table01">이름</td>
					<td class="join_table02"><?=$_SESSION['name']?></td>
				</tr>
				<tr>
					<td class="join_table01">이메일</td>
					<td class="join_table02">
						<input class="join_input02" name="email01" type="text" size="9" value="<?=$email_exp[0]?>"/> @ 
						<input class="join_input02" name="email02" type="text" size="15" value="<?=$email_exp[1]?>"/>
					</td>
				</tr>
			</table>
			<span style="font-size:13px">- 이메일은 아이디 및 비밀번호 찾기에 이용되오니 올바르게 입력하여 주십시요.</span>
			<div class="join_tb_name">선택 입력 사항</div>
			<table cellspacing="0" cellpadding="0" width="770px" border="0" align="center">
				<tr>
					<td class="join_table01" style="border-top:1px solid #CACACA" rowspan="2">주소</td>
					<td class="join_table02" style="border-top:1px solid #CACACA">
						<input class="join_input03" id="input_address" name="address01" type="text" size="55" value="<?=$address_exp[0]?>">
						<div class="join_search_address" onclick="address_search()">주소검색</div>
					</td>
				</tr>
				<tr>
					<td class="join_table02">
						<input class="join_input03" id="input_address2" name="address02" type="text" size="55" value="<?=$address_exp[1]?>">
					</td>
				</tr>
				<tr>
					<td class="join_table01">우편번호</td>
					<td class="join_table02">
						<input class="join_input04" id="input_zipcode" name="zipcode" type="text" size="5" value="<?=$zipcode?>">
					</td>
				</tr>
			</table>
		<div class="join_button" onclick="info_change_submit()">정보수정</div>
		<div class="clear"></div>
		</form>
	</div>
</div>
<div>
	<?php
		require_once("../footer.php");
	?>
</div>

</body>
</html>