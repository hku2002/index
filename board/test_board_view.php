<?php
	ob_start();
	require_once("../dbconfig.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>해규의 홈페이지</title>
<link rel="stylesheet" href="../css/board.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
<script src="../js/common.js"></script>
<script  type="text/javascript">
	$(document).ready(function(){
		$('.co_comment_view').click(function() {
			$('.co_wrap').toggle();
			$('.co_write_wrap').toggle();
		});
		$('.point').click(function() {
			$('.co_wrap').toggle();
			$('.co_write_wrap').toggle();
		});
	});
</script>
</head>
<?php
	require_once("../top_navi.php");
	require_once("../sub_top_img.php");

	if(!isset($_SESSION['id'])) {
		echo "<script>alert('로그인 후 이용하십시요.');history.back();</script>";
	} else {
		$tb_num = $_GET['tb_num'];
/*		if(!empty($tb_num)) {
			$sql = 'update z_test_board set tb_hit = tb_hit + 1 where tb_num = ' . $tb_num;
			$result = $db->query($sql); 
			if(empty($result)) {
				?>
				<script>
					alert('오류가 발생했습니다.');
					history.back();
				</script>
				<?php 
			} else {
				
			} 
		}*/
	
		if(!empty($tb_num) && empty($_COOKIE['z_test_board_' . $tb_num])) {
			$sql = 'update z_test_board set tb_hit = tb_hit + 1 where tb_num = ' . $tb_num;
			$result = $db->query($sql); 
			if(empty($result)) {
				?>
				<script>
					alert('오류가 발생했습니다.');
					history.back();
				</script>
				<?php 
			} else {
				setcookie('z_test_board_' . $tb_num, TRUE, time() + (60 * 60 * 24), '/');
			}
		}
	}//else
	
	$sql = 'select tb_title, tb_content, tb_date, tb_hit, member_id from z_test_board where tb_num = ' . $tb_num;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	
	//댓글 table 개수
	$sql_cnt = 'select count(*) as cnt from z_test_comment where tb_num =' . $tb_num;
	$result_cnt = $db->query($sql_cnt);
	$row_cnt = $result_cnt->fetch_assoc();
	$co_cnt = $row_cnt['cnt'];

	//댓글 select
	$sql_co = 'select * from z_test_comment where tb_num =' . $tb_num;
	$result_co = $db->query($sql_co);
?>
<body>

<div class="sub_wrap">
	<div class="sub_container">
		<div class="sub_top">
			<div class="sub_top_title">게시판</div>
			<div class="sub_top_route">Home>고객지원>게시판</div>
			<div class="clear"></div>
		</div>
		<div class="sub_middle">
			<div class="title01">&nbsp;&nbsp;제목</div>
			<div class="title02">&nbsp;&nbsp;<?php echo htmlspecialchars($row['tb_title'])?></div>
			<div class="clear"></div>
			<div class="member_id01">&nbsp;&nbsp;작성자</div>
			<div class="member_id02">&nbsp;&nbsp;<?php echo $row['member_id']?></div>
			<div class="clear"></div>
			<div class="date01">&nbsp;&nbsp;등록일</div>
			<div class="date02">&nbsp;&nbsp;<?php echo $row['tb_date']?></div>
			<div class="clear"></div>
			<div class="content"><?php echo htmlspecialchars($row['tb_content'])?></div>

			<!--댓글 view-->
			<div class="co_comment_view">댓글</div>
			<div class="point"><img src="../img/point.jpg"></div>
			<div class="clear"></div>
			<?php
				if($co_cnt != '0') {
					while($row_co = $result_co->fetch_assoc()) {
			?>
			<div class="co_wrap">		
				<div class="co_id_view"><?php echo htmlspecialchars($row_co['co_id'])?></div>
				<div class="co_content_view"><?php echo htmlspecialchars($row_co['co_content'])?></div>
				<div class="clear"></div>
			</div>
			<?php
					}
				} else if($co_cnt == '0'){
					echo "<div class='co_wrap'>댓글이 존재하지 않습니다.</div><div class='clear'></div>";
				}
			?>
			

			<!--댓글 작성-->
			<form action="./test_comment_ok.php" method="post">
				<div class="co_write_wrap">
					<div class="comment_id">
						<?php
							echo "&nbsp;&nbsp;".$_SESSION['id'];
						?>
					</div>
					<div class="comment_content">
						<textarea name="co_content" id="co_content" class="co_content"></textarea>
						<input type="hidden" name="tb_num" value="<?php echo $tb_num?>"/>
						<input type="hidden" name="co_id" value="<?php echo $_SESSION['id']?>"/>
					</div>
					<button class="co_button" type="submit">작성</button>
					<div class="clear"></div>
				</div>
			</form>

			<div class="btnSet">
				<a href="./test_board_write.php?tb_num=<?php echo $tb_num?>&member_id=<?php echo $row['member_id']?>"><div class="btn">수정</div></a>
				<a href="./test_board_delete.php?tb_num=<?php echo $tb_num?>&member_id=<?php echo $row['member_id']?>"><div class="btn">삭제</div></a>
				<a href="./test_board.php"><div class="btn">목록</div></a>	
			</div>
		</div>
	</div>
</div>
<div>
	<?php
		require_once("../footer.php");
	?>
</div>

</body>
</html>