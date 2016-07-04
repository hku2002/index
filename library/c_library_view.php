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
</head>
<?php
	require_once("../top_navi.php");
	require_once("../sub_top_img.php");

	if(!isset($_SESSION['id'])) {
		echo "<script>alert('로그인 후 이용하십시요.');history.back();</script>";
	} else {
		$c_lib_num = $_GET['c_lib_num'];
	
		if(!empty($c_lib_num) && empty($_COOKIE['z_test_c_library_' . $c_lib_num])) {
			header("Content-Type: text/html; charset=UTF-8");
			$sql = 'update z_test_c_library set c_lib_hit = c_lib_hit + 1 where c_lib_num = ' . $c_lib_num;
			$result = $db->query($sql); 
			if(empty($result)) {
				?>
				<script>
					alert('오류가 발생했습니다.');
					history.back();
				</script>
				<?php 
			} else {
				setcookie('z_test_c_library_' . $c_lib_num, TRUE, time() + (60 * 60 * 24), '/');
			}
		}
	}//else
	
	$sql = 'select c_lib_title, c_lib_content, c_lib_date, c_lib_hit, member_id, c_lib_filename from z_test_c_library where c_lib_num = ' . $c_lib_num;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	
	//댓글 table 개수
	$sql_cnt = 'select count(*) as cnt from z_test_c_library where c_lib_num =' . $c_lib_num;
	$result_cnt = $db->query($sql_cnt);
	$row_cnt = $result_cnt->fetch_assoc();
	$co_cnt = $row_cnt['cnt'];

	//댓글 select
	$sql_co = 'select * from z_test_c_library where c_lib_num =' . $c_lib_num;
	$result_co = $db->query($sql_co);
?>
<body>

<div class="sub_wrap">
	<div class="sub_container">
		<div class="sub_top">
			<div class="sub_top_title">공용자료실</div>
			<div class="sub_top_route">Home>자료실>공용자료실</div>
			<div class="clear"></div>
		</div>
		<div class="sub_middle">
			<div class="title01">&nbsp;&nbsp;제목</div>
			<div class="title02">&nbsp;&nbsp;<?php echo htmlspecialchars($row['c_lib_title'])?></div>
			<div class="clear"></div>
			<div class="member_id01">&nbsp;&nbsp;작성자</div>
			<div class="member_id02">&nbsp;&nbsp;<?php echo $row['member_id']?></div>
			<div class="clear"></div>
			<div class="date01">&nbsp;&nbsp;등록일</div>
			<div class="date02">&nbsp;&nbsp;<?php echo $row['c_lib_date']?></div>
			<div class="clear"></div>
			<div class="file01">&nbsp;&nbsp;파일</div>
			<form action="./c_library_download.php" method="POST">
				<div class="file02">
					<span>&nbsp;&nbsp;<?=$row['c_lib_filename']?>
					</span>
					&nbsp;
					<input type="hidden" name="c_lib_num" value="<?=$c_lib_num?>"/>
					<input type="submit" value="다운로드"/>	
				</div>
			</form>
			<div class="clear"></div>
			<div class="content"><?php echo htmlspecialchars($row['c_lib_content'])?></div>

			<div class="btnSet">
				<a href="./c_library_upload.php?c_lib_num=<?php echo $c_lib_num?>&member_id=<?php echo $row['member_id']?>"><div class="btn">수정</div></a>
				<a href="./c_library_delete.php?c_lib_num=<?php echo $c_lib_num?>"><div class="btn">삭제</div></a>
				<a href="./c_library_list.php"><div class="btn">목록</div></a>	
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