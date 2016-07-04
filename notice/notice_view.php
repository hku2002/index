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
<script src="../js/common.js"></script>
</head>
<?php
	require_once("../top_navi.php");
	require_once("../sub_top_img.php");
	$no_num = $_GET['no_num'];
	if(!empty($no_num) && empty($_COOKIE['z_test_notice_' . $no_num])) {
		$sql = 'update z_test_notice set no_hit = no_hit + 1 where no_num = ' . $no_num;
		$result = $db->query($sql); 
		if(empty($result)) {
			?>
			<script>
				alert('오류가 발생했습니다.');
				history.back();
			</script>
			<?php 
		} else {
				setcookie('z_test_notice_' . $no_num, TRUE, time() + (60 * 60 * 24), '/');
		}
	}
	$sql = 'select no_title, no_content, no_date, no_hit, no_id from z_test_notice where no_num = ' . $no_num;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
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
			<div class="title02">&nbsp;&nbsp;<?php echo htmlspecialchars($row['no_title'])?></div>
			<div class="clear"></div>
			<div class="member_id01">&nbsp;&nbsp;작성자</div>
			<div class="member_id02">&nbsp;&nbsp;<?php echo $row['no_id']?></div>
			<div class="clear"></div>
			<div class="date01">&nbsp;&nbsp;등록일</div>
			<div class="date02">&nbsp;&nbsp;<?php echo $row['no_date']?></div>
			<div class="clear"></div>
			<div class="content"><?php echo htmlspecialchars($row['no_content'])?></div>
			<div class="btnSet" style="margin-left:643px">
				<a href="./notice_list.php"><div class="btn">목록</div></a>	
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