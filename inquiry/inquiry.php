<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="../css/common.css" />
	<script src="../js/common.js"></script>
	<title>해규의 홈페이지</title>
</head>
<body>
<?php
	require_once("../top_navi.php");
	require_once("../sub_top_img.php");
	if(!isset($_SESSION['id'])){
		echo "<script>alert('로그인 후 이용 가능합니다.');history.back();</script>";
	} else {
		$id = $_SESSION['id'];
		$name = $_SESSION['name'];
		$email = $_SESSION['email'];
		$email_exp = explode("@", $email);
	}
?>
<div class="sub_wrap">
	<div class="sub_container">
		<div class="sub_top">
			<div class="sub_top_title">문의하기</div>
			<div class="sub_top_route">Home>고객지원>문의하기</div>
			<div class="clear"></div>
		</div>
		<div class="sub_middle">
			<div class="inquiry_top_text">관리자에게 문의할 내용을 보내주세요.</div>
			<div class="inquiry_table_wrap">
				<form action="inquiry_send_check.php" name="send_mail" method="post">
					<table cellpadding="0">
						<tbody>
							<tr>
								<td class="inquiry_table_td01">&nbsp;&nbsp;&nbsp;아이디</td>
								<td class="inquiry_table_td02">&nbsp;<?=$id?>
									<input class="inquiry_id" name="id" type="hidden" value="<?=$id?>"/>
								</td>
							</tr>
							<tr>
								<td class="inquiry_table_td01">&nbsp;&nbsp;&nbsp;이름</td>
								<td class="inquiry_table_td02">&nbsp;<?=$name?>
									<input class="inquiry_name" name="name" type="hidden" value="<?=$name?>"/>
								</td>
							</tr>
							<tr>
								<td class="inquiry_table_td01">&nbsp;&nbsp;&nbsp;이메일</td>
								<td class="inquiry_table_td02">&nbsp;
									<input class="inquiry_email01" name="email01" type="text" value="<?=$email_exp[0]?>"/> @  
									<input class="inquiry_email02" name="email02" type="text" value="<?=$email_exp[1]?>"/>
									<input name="email" type="hidden" value="<?=$email_exp[0].'@'.$email_exp[1]?>"/>
								</td>
							</tr>
							<tr>
								<td class="inquiry_table_td01">&nbsp;&nbsp;&nbsp;제목</td>
								<td class="inquiry_table_td02">&nbsp;
									<input class="inquiry_title" name="title" type="text"/>
								</td>
							</tr>
							<tr>
								<td class="inquiry_table_td01">&nbsp;&nbsp;&nbsp;내용</td>
								<td class="inquiry_table_td02">&nbsp;
									<textarea class="inquiry_content" name="message"></textarea>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<div class="inquiry_button_wrap">
				<div class="inquiry_button" onclick="inquiry_send()">보내기</div>
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
