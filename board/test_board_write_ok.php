<?php
	require_once("../dbconfig.php");
	session_start();

	//$_POST['tb_num']이 있을 때만 $tb_num 선언
	if(isset($_POST['tb_num'])) {
		$tb_num = $_POST['tb_num'];
		$date = date('Y-m-d H:i:s');
	}

	//tb_num 없다면(글 쓰기라면) 변수 선언
	if(empty($tb_num)) {
		$member_id = $_SESSION['id'];
		$date = date('Y-m-d H:i:s');
	}

	//항상 변수 선언
	$bPassword = $_POST['bPassword'];
	$bTitle = $_POST['bTitle'];
	$bContent = $_POST['bContent'];

//글 수정
if(isset($tb_num)) {
	//수정 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
	$sql = 'select count(tb_password) as cnt from z_test_board where tb_password=password("' . $bPassword . '") and tb_num = ' . $tb_num;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	
	//비밀번호가 맞다면 업데이트 쿼리 작성
	if($row['cnt']) {
		$sql = 'update z_test_board set tb_title="' .$bTitle. '", tb_content="' .$bContent. '", tb_date= "' .$date. '" where tb_num = ' .$tb_num;
		$msgState = '수정';
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
	
//글 등록
} else {
	//등록 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
	$sql = 'select count(tb_password) as cnt from z_test_board where tb_password=password("' . $bPassword . '")';
	$result = $db->query($sql);
	$row = $result->fetch_assoc();

	if($row['cnt']) {
		$sql = 'insert into z_test_board (tb_num, tb_title, tb_content, tb_date, tb_hit, member_id, tb_password) values(null, "' . $bTitle . '", "' . $bContent . '", "' . $date . '", 0, "' . $member_id . '", password("'. $bPassword .'"))';
		$msgState = '등록';
	} else {
		echo '<script>alert("가입시 등록한 비밀번호를 입력하여 주십시요.");history.back();</script>';
		exit;
	}
}

//메시지가 없다면 (오류가 없다면)
if(empty($msg)) {
	$result = $db->query($sql);
	
	//쿼리가 정상 실행 됐다면,
	if($result) {
		$msg = '정상적으로 글이 ' . $msgState . '되었습니다.';
		if(empty($tb_num)) {
			$tb_num = $db->insert_id;
		}
		$replaceURL = './test_board_view.php?tb_num=' . $tb_num;
	} else {
		$msg = '글을 ' . $msgState . '하지 못했습니다.';
?>
		<script>
			alert("<?php echo $msg?>");
			history.back();
		</script>
<?php
		exit;
	}
}

?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>