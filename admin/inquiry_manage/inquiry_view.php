<?php
	require_once("../../dbconfig.php");
	$inquiry_num = $_GET['inquiry_num'];
	$sql = "select * from z_test_inquiry where inquiry_num='".$inquiry_num."'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/admin.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
	<script src="../js/admin.js"></script>
	<title>관리자 페이지</title>
</head>
<body>
<?php
	require_once("../header.php");
	require_once("../left_navi.php");
?>
<div class="inquiry_view_wrap">
	<div class="inquiry_title01">&nbsp;&nbsp;제목</div>
	<div class="inquiry_title02">&nbsp;&nbsp;<?=$row['inquiry_title']?></div>
	<div class="clear"></div>
	<div class="inquiry_id01">&nbsp;&nbsp;아이디</div>
	<div class="inquiry_id02">&nbsp;&nbsp;<?=$row['member_id']?></div>
	<div class="clear"></div>
	<div class="inquiry_name01">&nbsp;&nbsp;이름</div>
	<div class="inquiry_name02">&nbsp;&nbsp;<?=$row['member_name']?></div>
	<div class="clear"></div>
	<div class="inquiry_email01">&nbsp;&nbsp;이메일</div>
	<div class="inquiry_email02">&nbsp;&nbsp;<?=$row['email']?></div>
	<div class="clear"></div>
	<div class="inquiry_content"><?= $row['inquiry_content']?></div>
	<form action="./inquiry_answer.php" method="POST">
		<input type="hidden" name="member_id" value="<?=$row['member_id']?>"/>
		<input type="hidden" name="member_name" value="<?=$row['member_name']?>"/>
		<input type="hidden" name="email" value="<?=$row['email']?>"/>
		<div class="inquiry_answer_btn"><a href="./inquiry_answer.php"><button type="submit">답변하기</button></a></div>
	</form>
	<div class="inquiry_btn"><a href="./inquiry_manage.php"><button>목록</button></a>	</div>
</div>
</body>
</html>