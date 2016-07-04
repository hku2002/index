<?php
	require_once('../dbconfig.php');
	
	$board_num = $_POST['tb_num'];

	$sql = 'update z_test_board set tb_hit= tb_hit-1 where tb_num = ' .$board_num;
	$result = $db->query($sql);
	
	$co_id = $_POST['co_id'];
	$co_content = $_POST['co_content'];
	
	$sql = 'insert into z_test_comment values(null, ' .$board_num . ', null, "' . $co_content . '", "' . $co_id . '")';
	$result = $db->query($sql);
	$co_num = $db->insert_id;
	
	$sql = 'update z_test_comment set co_order = co_num where co_num = ' . $co_num;
	
	$result = $db->query($sql);
	if($result) {
?>
	<script>
		alert('댓글이 정상적으로 작성되었습니다.');
		location.replace("./test_board_view.php?tb_num=<?php echo $board_num ?>");
	</script>
<?php
	}
?>