<?php
	require_once("../dbconfig.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>해규의 홈페이지</title>
	<link rel="stylesheet" href="../css/board.css" />
</head>
<?php
	require_once("../top_navi.php");
	require_once("../sub_top_img.php");
	//$_GET['c_lib_num']이 있을 때만 $c_lib_num 선언
	if(isset($_GET['c_lib_num'])) {
		$c_lib_num = $_GET['c_lib_num'];
		$member_id = $_GET['member_id'];
		$session_id=$_SESSION['id'];
	}  
	if(isset($c_lib_num)) {
		$sql = 'select c_lib_title, c_lib_content, member_id from z_test_c_library where c_lib_num = ' . $c_lib_num;
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
			<div class="sub_top_title">공용자료실</div>
			<div class="sub_top_route">Home>자료실>공용자료실</div>
			<div class="clear"></div>
		</div>
		<form action="./c_library_upload_ok.php" method="post" enctype="multipart/form-data">
			<div class="sub_middle">
				<?php
				if(isset($c_lib_num)) {
					echo '<input type="hidden" name="c_lib_num" value="' . $c_lib_num . '">';
				}
				?>
				<div class="write_id01">&nbsp;&nbsp;아이디</div>
				<div class="write_id02">
					<?php
						if(isset($c_lib_num)) {
							echo "&nbsp;&nbsp;".$row['member_id'];
						} else { 
							echo "&nbsp;&nbsp;".$_SESSION['id'];
					 } ?>
				</div>
				<div class="clear"></div>
				<div class="write_file01">&nbsp;&nbsp;첨부자료</div>
				<div class="write_file02">
					<input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
					&nbsp;&nbsp;<input type="file" name="userfile" id="userfile"/>			
				</div>
				<div class="clear"></div>
				<div class="write_title01">&nbsp;&nbsp;제목</div>
				<div class="write_title02">
					&nbsp;&nbsp;<input type="text" name="c_lib_title" class="write_title" value="<?php echo isset($row['c_lib_title'])?$row['c_lib_title']:null?>">
				</div>
				<div class="clear"></div>
				<div class="write_content">
					<textarea name="c_lib_content" id="bContent" class="write_text_box"><?php echo isset($row['c_lib_content'])?$row['c_lib_content']:null?></textarea>
				</div>
				<div class="btnSet">
					<button type="submit" class="write_submit">
							<?php echo isset($c_lib_num)?'확인':'작성'?>
					</button>
					<a href="./c_library_list.php" class="btnList btn" style="margin-left:60px">목록</a>
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