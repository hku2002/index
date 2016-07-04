<?php
	require_once("../dbconfig.php");

	//$_GET['tb_num']이 있어야만 글삭제가 가능함.
	if(isset($_GET['tb_num'])) {
		$tb_num = $_GET['tb_num'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>해규의 홈페이지</title>
	<link rel="stylesheet" href="../css/board.css" />
<?php
	require_once("../top_navi.php");
	require_once("../sub_top_img.php");

	$session_id = $_SESSION['id'];
	$member_id  = $_GET['member_id'];
	if($session_id != $member_id) {
		echo '<script>alert("본인이 작성한 글만 수정이 가능합니다.");history.back()</script>';
		exit;
	} 

	if(isset($tb_num)) {
		$sql = 'select count(tb_num) as cnt from z_test_board where tb_num = ' . $tb_num;
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
		if(empty($row['cnt'])) {
?>
<script>
	alert('글이 존재하지 않습니다.');
	history.back();
</script>
<?php
	exit;
		}
		
		$sql = 'select tb_title, member_id, tb_content from z_test_board where tb_num = ' . $tb_num;
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
?>
</head>
<body>
<div class="sub_wrap">
	<div class="sub_container">
		<div class="sub_top">
			<div class="sub_top_title">게시판</div>
			<div class="sub_top_route">Home>고객지원>게시판</div>
			<div class="clear"></div>
		</div>
		<div class="sub_middle">
			<form action="./test_board_delete_ok.php" method="post">
				<input type="hidden" name="tb_num" value="<?php echo $tb_num?>">
				<div class="title01">&nbsp;&nbsp;제목</div>
				<div class="title02">&nbsp;&nbsp;<?php echo $row['tb_title']?></div>
				<div class="clear"></div>
				<div class="member_id01">&nbsp;&nbsp;작성자</div>
				<div class="member_id02">&nbsp;&nbsp;<?php echo $row['member_id']?></div>
				<div class="clear"></div>
				<div class="date01">&nbsp;&nbsp;비밀번호</div>
				<div class="date02">&nbsp;&nbsp;<input type="password" name="bPassword" id="bPassword"></div>
				<div class="clear"></div>
				<div class="content"><?php echo $row['tb_content']?></div>
				<div class="btnSet">
					<button type="submit" class="btnSubmit btn">삭제</button>
					<a href="./test_board.php" class="btnList btn">목록</a>
				</div>
			</form>
		</div>
	</div>
</div>

	<?php
		//$tb_num이 없다면 삭제 실패
		} else {
	?>
		<script>
			alert('정상적인 경로를 이용해주세요.');
			history.back();
		</script>
	<?php
			exit;
		}
	?>

</body>
</html>