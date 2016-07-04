<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>해규의 홈페이지</title>
	<link rel="stylesheet" href="./css/common.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
</head>
<body>
<?php
	$_SERVER['REMOTE_ADDR']; // 접속한 사용자의 ip 주소 불러오기

	//$_SERVER['SERVER_PORT']; // 사용되고 있는 포트 불러오기

	$_SERVER['HTTP_USER_AGENT']; // 접속자의 사용자 환경값 가져오기

	
	require_once("./top_navi.php");
	require_once("./dbconfig.php");
	$sql = 'select tb_title, tb_num from z_test_board order by tb_num desc';
	$result = $db->query($sql);
?>
	<div class="main_wrap">
		<div class="main_container">
			<div class="main_img_box"></div>
			<div class="main_content_box">
				<a href="./company/company_info.php">
				<div class="main_content" style="background:url('./img/main02.jpg') no-repeat center top">
					<div class="main_content_text01">회사소개</div>
				</div>
				</a>
				<a href="./library/c_library_list.php">
				<div class="main_content" style="background:url('./img/main03.jpg') no-repeat center top">
					<div class="main_content_text01">공용자료실</div>
				</div>
				</a>
				<a href="./inquiry/inquiry.php">
				<div class="main_content" style="background:url('./img/main04.jpg') no-repeat center top">
					<div class="main_content_text01">문의하기</div>
				</div>
				</a>
				<div class="clear"></div>
				<div class="main_content">내용4
				</div>
				<div class="main_content">내용5
				</div>
				<div class="main_content" style="background-color:white;border:1px solid #D5D5D5">
					<div class="main_content_text01">게시판</div>
					<ul class="main_board">
						<?php
							for($i=1; $i<7; $i=$i+1) {
								$row = $result->fetch_assoc()
						?>
						<a href="./board/test_board_view.php?tb_num=<?=$row['tb_num']?>"><li><?=$row['tb_title']?></li></a>
						<?php
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div>
		<?php
			require_once("./footer.php");
		?>
	</div>
</body>
</html>
