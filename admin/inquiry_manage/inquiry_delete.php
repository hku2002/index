<?php
	require_once("../../dbconfig.php");
	if(isset($_POST['inquiry_checkbox'])) {
		$member_id = $_POST['inquiry_checkbox'];
		$count = count($member_id);
		$i = 0;
		for($i; $i<=$count-1; $i=$i+1) {
			$member_id[$i] = str_replace("/","",$member_id[$i]); 
			$sql = "delete from z_test_inquiry where member_id = '" . $member_id[$i] ."'";
			$result = $db->query($sql);	
		}
		
		echo "<script>alert('문의글 삭제가 완료되었습니다.');location.href='./inquiry_manage.php';</script>";
	} else {
		echo "<script>alert('삭제할 글을 선택하여 주십시요.');location.href='./inquiry_manage.php';</script>";
	}
?>