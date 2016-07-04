<?php
	require_once("../dbconfig.php");

	if($_POST['data'] != '1') {
		echo "<script>>alert('정상 경로로 접속하여 주십시요.');history.back();</script>";
		exit;
	} else {
		$new_pw = $_POST['password'];
		$member_id = $_POST['member_id'];

		$sql = "delete from z_test_pw_check where member_id = '".$member_id."'";
		$result = $db->query($sql);

		$sql = 'update z_test_member set passwd = password("'.$new_pw.'") where member_id="'.$member_id.'"';
		$result = $db->query($sql);

		if($result) {
			echo "<script>alert('비밀번호 변경이 완료되었습니다.');location.href='./login.php';</script>";
		} else {
			echo "<script>alert('오류가 발생하였습니다. 관리자에게 문의하세요.');history.back();</script>";
		}
	}
?>