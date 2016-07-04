<?php

	require_once("../../dbconfig.php");
	if(isset($_POST['board_checkbox'])) {
		$tb_num = $_POST['board_checkbox'];
		$count = count($tb_num);
		$i = 0;
		for($i; $i<=$count-1; $i=$i+1) {
			$tb_num[$i] = str_replace("/","",$tb_num[$i]); 
			$sql = "delete from z_test_board where tb_num = '" . $tb_num[$i] ."'";
			$result = $db->query($sql);
			$sql = "delete from z_test_comment where tb_num = '" . $tb_num[$i] ."'";
			$result = $db->query($sql);	
		}
		echo "<script>alert('글 삭제가 완료되었습니다.');location.href='./board_manage.php';</script>";
	} else {
		echo "<script>alert('삭제할 글을 선택하여 주십시요.');location.href='./board_manage.php';</script>";
	}
?>