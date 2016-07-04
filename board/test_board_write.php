<?php
	require_once("../dbconfig.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>해규의 홈페이지</title>
	<link rel="stylesheet" href="../css/board.css" />
	<script src="../js/common.js"></script>
</head>
<?php
	require_once("../top_navi.php");
	require_once("../sub_top_img.php");
	//$_GET['tb_num']이 있을 때만 $tb_num 선언
	if(isset($_GET['tb_num'])) {
		$tb_num = $_GET['tb_num'];
		$member_id = $_GET['member_id'];
		$session_id=$_SESSION['id'];
	}  
	if(isset($tb_num)) {
		$sql = 'select tb_title, tb_content, member_id from z_test_board where tb_num = ' . $tb_num;
		$result = $db->query($sql);
		$row = $result->fetch_assoc();

		if($session_id != $member_id) {
			$result = $db->query($sql); 
			echo '<script>alert("본인이 작성한 글만 수정이 가능합니다.");history.back()</script>';
		} 
	}
?>
<body>

<div class="sub_wrap">
	<div class="sub_container">
		<div class="sub_top">
			<div class="sub_top_title">게시판</div>
			<div class="sub_top_route">Home>고객지원>게시판</div>
			<div class="clear"></div>
		</div>
		<form action="./test_board_write_ok.php" name="tb_write_ok" method="post">
			<div class="sub_middle">
				<?php
				if(isset($tb_num)) {
					echo '<input type="hidden" name="tb_num" value="' . $tb_num . '">';
				}
				?>
				<div class="write_id01">&nbsp;&nbsp;아이디</div>
				<div class="write_id02">
					<?php
						if(isset($tb_num)) {
							echo "&nbsp;&nbsp;".$row['member_id'];
						} else { 
							echo "&nbsp;&nbsp;".$_SESSION['id'];
					 } ?>
				</div>
				<div class="clear"></div>
				<div class="write_pw01">&nbsp;&nbsp;비밀번호</div>
				<div class="write_pw02">
					&nbsp;&nbsp;<input type="password" name="bPassword" class="write_pw">
				</div>
				<div class="clear"></div>
				<div class="write_title01">&nbsp;&nbsp;제목</div>
				<div class="write_title02">
					&nbsp;&nbsp;<input type="text" name="bTitle" class="write_title" value="<?php echo isset($row['tb_title'])?$row['tb_title']:null?>">
				</div>
				<div class="clear"></div>
				<div class="write_content">
					<textarea name="bContent" id="bContent" class="write_text_box"><?php echo isset($row['tb_content'])?$row['tb_content']:null?></textarea>
				</div>
				<div class="btnSet">
					<button class="write_submit" type="button" onclick="write_check()">
							<?php echo isset($tb_num)?'확인':'작성'?>
					</button>
					<a href="./test_board.php" class="btnList btn" style="margin-left:60px">목록</a>
				</div>
			</div>
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