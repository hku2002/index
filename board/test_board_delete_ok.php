<?php
	require_once("../dbconfig.php");

	//$_POST['tb_num']이 있을 때만 $tb_num 선언
	if(isset($_POST['tb_num'])) {
		$tb_num = $_POST['tb_num'];
		echo '<script>alert($tb_num);</script>';
	} else {
		echo '<script>alert("오류가 발생하였습니다.");history.back();</script>';
	}

	$bPassword = $_POST['bPassword'];
	
//글 삭제
if(isset($tb_num)) {
	//삭제 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
	$sql = 'select count(tb_password) as cnt from z_test_board where tb_password=password("' . $bPassword . '") and tb_num = ' . $tb_num;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();

	//비밀번호가 맞다면 삭제 쿼리 작성
	if($row['cnt']) {
		$sql = 'delete from z_test_board where tb_num = ' . $tb_num;
		$sql2 = 'delete from z_test_comment where tb_num = '. $tb_num;
	//틀리다면 메시지 출력 후 이전화면으로
	} else {
			

		$msg = '비밀번호가 맞지 않습니다.';    
	?>
		<script>
			alert("<?php echo $msg?>");
			history.back();
		</script>
	<?php
		exit;
	}
}

	$result = $db->query($sql);
	$result2 = $db->query($sql2);
	
//쿼리가 정상 실행 됐다면,
if($result) {
	$msg = '정상적으로 글이 삭제되었습니다.';
	$replaceURL = './test_board.php';
} else {
	$msg = '글을 삭제하지 못했습니다.';
?>
	<script>
		alert("<?php echo $msg?>");
		history.back();
	</script>
<?php
	exit;
}


?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>