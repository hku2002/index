<?php
	require_once("../../dbconfig.php");

	$sql = 'select * from z_test_inquiry';
	$result = $db->query($sql);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/admin.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
	<script src="../js/admin.js"></script>
	<script type="text/javascript">
		
	</script>
	<title>관리자 페이지</title>
</head>
<body>
<?php
	require_once("../header.php");
	require_once("../left_navi.php");
?>
<div class="inquiry_wrap">
	<form action="./inquiry_delete.php" name="inquiry_form" method="POST">
		<table class="inquiry_table">
			<tbody>
				<tr class="inquiry_table_line">
					<td class="inquiry_all_check">전체<input type="checkbox" id="all_check" name="check_all" ></td>
					<td class="inquiry_member_id">아이디</td>
					<td class="inquiry_name">이름</td>
					<td class="inquiry_email">이메일</td>
					<td class="inquiry_title">제목</td>
					<td class="inquiry_date">문의날짜</td>
					<td class="inquiry_answer">답변여부</td>
				</tr>
				<?php
					while($row = $result->fetch_assoc()) {
				?>
				<tr>
					<td class="inquiry_all_check"><input type="checkbox" name="inquiry_checkbox[]" id="inquiry_check" value=<?=$row['member_id']?>/></td>
					<td class="inquiry_member_id"><?=$row['member_id']?></td>
					<td class="inquiry_name"><?=$row['member_name']?></td>
					<td class="inquiry_email"><?=$row['email']?></td>
					<td class="inquiry_title"><a href="./inquiry_view.php?inquiry_num=<?=$row['inquiry_num']?>"><?=$row['inquiry_title']?></a></td>
					<td class="inquiry_date"><?=$row['inquiry_date']?></td>
					<td class="inquiry_answer"><?=$row['answer']?></td>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
		<div class="inquiry_btn_wrap">
			<button type="submit">삭제</button>
		</div>
	</form>
</div>
<div class="clear"></div>
</body>
</html>