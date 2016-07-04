<?php
	require_once("../../dbconfig.php");
	$sql = 'select * from z_test_member';
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
<div class="member_wrap">
	<div class="class_num_explain">등급1:기본등급 / 등급2:관리자등급</div>
		<form name="member_form" method="POST">
			<table class="member_table">
				<tbody>
					<tr class="table_line">
						<td class="all_check">전체<input type="checkbox" id="all_check" name="check_all" ></td>
						<td class="member_id">아이디</td>
						<td class="name">이름</td>
						<td class="email">이메일</td>
						<td class="regdate">가입일</td>
						<td class="permit">등급</td>
					</tr>
					<?php
						while($row = $result->fetch_assoc()) {
					?>
					<tr>
						<td class="all_check"><input type="checkbox" name="member_checkbox[]" id="member_check" value=<?php echo $row['member_id']?>/></td>
						<td class="member_id"><?php echo $row['member_id']?></td>
						<td class="name"><?php echo $row['member_name']?></td>
						<td class="email"><?php echo $row['email']?></td>
						<td class="regdate"><?php echo $row['regdate']?></td>
						<td class="permit"><?php echo $row['permit']?></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
			<div class="member_btn_wrap">
				<button type="button" onclick="member_up()">등급올리기</button>
				<button type="button" onclick="member_down()">등급내리기</button>
				<button type="button" onclick="member_delete()">탈퇴</button>
			</div>
		</form>
</div>
</body>
</html>