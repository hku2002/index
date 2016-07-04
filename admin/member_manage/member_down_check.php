<?php

	require_once("../../dbconfig.php");
	if(isset($_POST['member_checkbox'])) {
		$member_id = $_POST['member_checkbox'];
		$j = 0;
		$count = count($member_id);
		for($j; $j<=$count-1; $j=$j+1) {
			$member_id[$j] = str_replace("/","",$member_id[$j]);
			if($member_id[$j] == '관리자'){
				echo '<script>alert("관리자는 등급을 변경할 수 없습니다.");history.back();</script>';
				exit;
			}
		}


		$i = 0;
		for($i; $i<=$count-1; $i=$i+1) {
			$member_id[$i] = str_replace("/","",$member_id[$i]); 
			$sql = "update z_test_member set permit = '1' where member_id = '" . $member_id[$i] ."'";
			$result = $db->query($sql);	
		}

		echo "<script>alert('등급 내리기가 완료되었습니다.');location.href='./member_manage.php';</script>";
	} else {
		echo "<script>alert('등급을 올릴 회원을 선택하여 주십시요.');location.href='./member_manage.php';</script>";
	}

?>