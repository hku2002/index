<?php
	require_once("../../dbconfig.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>관리자 페이지</title>
	<link rel="stylesheet" href="../../css/board.css" />
	<link rel="stylesheet" href="../css/admin.css" />
</head>
<body>
<?php
	require_once("../header.php");
	require_once("../left_navi.php");

	$tb_num = $_GET['tb_num'];
	
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
<div class="board_view_wrap">

	<table>
		<tbody>
			<tr>
				<td class="tb_left_content">&nbsp;&nbsp;제목</td>
				<td class="tb_right_content">&nbsp;&nbsp;<?php echo htmlspecialchars($row['tb_title'])?></td>
			</tr>
			<tr>
				<td class="tb_left_content">&nbsp;&nbsp;작성자</td>
				<td class="tb_right_content">&nbsp;&nbsp;<?php echo $row['member_id']?></td>
			</tr>
			<tr>
				<td class="tb_left_content">&nbsp;&nbsp;등록일</td>
				<td class="tb_right_content">&nbsp;&nbsp;<?php echo $row['tb_date']?></td>
			</tr>
			<tr>
				<td class="tb_left_content">&nbsp;&nbsp;내용</td>
				<td class="tb_right_content">&nbsp;&nbsp;<?php echo htmlspecialchars($row['tb_content'])?></td>
			</tr>
		</tbody>
	</table>

	<div class="board_view_btn">
		<a href="./board_manage.php"><button>목록</button></a>
	</div>
	<div>댓글</div>
	<!--댓글 view-->
	<div class="admin_comment_wrap">
		<?php
			if($co_cnt != '0') {
				while($row_co = $result_co->fetch_assoc()) {
		?>
		<div class="admin_comment">		
			<div class="admin_co_id"><?php echo htmlspecialchars($row_co['co_id'])?></div>
			<div class="admin_co_content"><?php echo htmlspecialchars($row_co['co_content'])?></div>
		</div>
		<?php
				}
			} else if($co_cnt == '0'){
				echo "<div class='co_wrap'>댓글이 존재하지 않습니다.</div><div class='clear'></div>";
			}
		?>
	</div>

</div>

</body>
</html>