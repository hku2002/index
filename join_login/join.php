<?php
	require_once("../dbconfig.php");
	if(!isset($_POST['data'])){
		echo "<script>alert('정상 경로로 접속해 주십시요.');location.href='http://hku2002.cafe24.com/Z_TEST/index.php'</script>";
	} else {
		$data = $_POST['data'];
	}
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
?>
<script src="../js/common.js"></script>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
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
<script>
var pattern1 = /[0-9]/;                     //숫자
var pattern2 = /[a-zA-Z]/;                  //문자
var pattern3 = /[~!@#$%^&*()_+|<>?:{}]/;    //특수문자
var pwFlag = false;

window.onload = function(){
	
	var member_id = document.join_form.id.value;
	var sid = document.getElementById("input_id");
	sid.onblur = function(){
	  	if(sid.value != null && sid.value.length > 0) { 
		    $.ajax({
		     	url:'./json_data.php',  //url에 주소 넣기
		     	dataType:'json',      //dataType에 데이터 타입 넣기
		     	data : {"member_id" : member_id},
		     	async:false,
		     	success:function(data){     //success에 성공했을 때 동작 넣기.
		     		var res = data;
		     		// 1번이면 res의 length를 체크
		     		// 2번 each문 을 이용
 					var flag = false;
 		     		$.each(res, function(idx){
 		     			var resulrStr;
  		     			 if(res[idx].member_id == sid.value){
 		     				resultStr = '<span class="id_no">이미 사용중인 아이디 입니다.</span>';
 		     				document.getElementById("id_check").innerHTML = resultStr;
 		     				return false;
 		     			} else {
 		     				resultStr = '<span class="id_ok">사용 가능한 아이디 입니다.</span>';
 		     				document.getElementById("id_check").innerHTML = resultStr;
 		     				flag = true;
 		     			}
 		     		});
		      		
 		     		if(!flag) {
 		     			resultStr = '<span class="id_no">사용 불가능한 아이디 입니다.</span>';
 		     			document.getElementById("id_check").innerHTML = resultStr;
 		     			return;
 		     		} else if (!pattern2.test(sid.value) || sid.value.length>15 || sid.value.length<6){
 		     			resultStr = '<span class="id_no">아이디 조건에 맞지 않습니다.</span>';
 		     			document.getElementById("id_check").innerHTML = resultStr;
 		     			return;
 		     		} else {
 		     			
 		     		}
		       	},
		       	error : function (res) {

		       	}
		    });
	  	}
	}


	document.getElementById("input_pw01").addEventListener('blur', pwChecker);
	document.getElementById("input_pw02").addEventListener('blur', pwChecker);
}

	

	
	function pwChecker() {
		var pw1 = document.join_form.password.value;
		var pw2 = document.join_form.password_identfy.value;
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
<title>해규의 홈페이지</title>
</head>
<body>

<div class="join_top_wrap">
	<div class="join_top_content">
		<div class="sub_top">
			<div class="sub_top_title">회원 가입</div>
			<div class="sub_top_route">Home>이용약관>회원가입</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<div class="join_middle_wrap">
	<div class="join_middle_content">
		<form name="join_form" action="./join_ok.php" method="post">
			<div class="join_tb_name">필수 입력 사항</div>
			<table cellspacing="0" cellpadding="0" width="770px" border="0" align="center">
				<tr>
					<td class="join_table01" style="border-top:1px solid #CACACA">아이디</td>
					<td class="join_table02" style="border-top:1px solid #CACACA">
						<input class="join_input01" id="input_id" name="id" type="text" size="38" placeholder="6~15자,영문소문자를 사용하세요." value=''/>
						<span class="id_ok" id="id_check">6~15자,영문소문자를 사용하세요.</span>
					</td>
				</tr>
				<tr>
					<td class="join_table01">비밀번호</td>
					<td class="join_table02">
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
				<tr>
					<td class="join_table01">이름</td>
					<td class="join_table02">
						<input class="join_input02" name="name" type="text" size="14"/>
					</td>
				</tr>
				<tr>
					<td class="join_table01">이메일</td>
					<td class="join_table02">
						<input class="join_input02" name="email01" type="text" size="9"/> @ <input class="join_input02" name="email02" type="text" size="15"/>
					</td>
				</tr>
			</table>
			<span style="font-size:13px">- 이름, 이메일은 아이디 및 비밀번호 찾기에 이용되오니 올바르게 입력하여 주십시요.</span>
			<div class="join_tb_name">선택 입력 사항</div>
			<table cellspacing="0" cellpadding="0" width="770px" border="0" align="center">
				<tr>
					<td class="join_table01" style="border-top:1px solid #CACACA" rowspan="2">주소</td>
					<td class="join_table02" style="border-top:1px solid #CACACA">
						<input class="join_input03" id="input_address" name="address01" type="text" size="55" value=''>
						<div class="join_search_address" onclick="address_search()">주소검색</div>
					</td>
				</tr>
				<tr>
					<td class="join_table02">
						<input class="join_input03" id="input_address2" name="address02" type="text" size="55" value=''>
					</td>
				</tr>
				<tr>
					<td class="join_table01">우편번호</td>
					<td class="join_table02">
						<input class="join_input04" id="input_zipcode" name="zipcode" type="text" size="5" value=''>
					</td>
				</tr>
			</table>
		</form>
		<div class="join_button" onclick="join_submit()">가입하기</div>
		<div class="clear"></div>
	</div>
</div>
<div>
	<?php
		require_once("../footer.php");
	?>
</div>

</body>
</html>