<?php
	require_once("../../dbconfig.php");

	$member_id   = $_POST['member_id'];
	$member_name = $_POST['member_name'];
	$email       = $_POST['email'];
	$email_exp   = explode("@", $email);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/admin.css" />
	<script src="../js/admin.js"></script>
	<title>관리자 페이지</title>
</head>
<body>
<?php
	require_once("../header.php");
	require_once("../left_navi.php");
?>
<div class="inquiry_answer_wrap">
	<form action="inquiry_answer_check.php" name="send_mail" method="post">
		<table cellpadding="0">
			<tbody>
				<tr>
					<td class="inquiry_table_td01">&nbsp;&nbsp;&nbsp;고객아이디</td>
					<td class="inquiry_table_td02">&nbsp;<?=$member_id?>
						<input class="inquiry_id" name="member_id" type="hidden" value="<?=$member_id?>"/>
					</td>
				</tr>
				<tr>
					<td class="inquiry_table_td01">&nbsp;&nbsp;&nbsp;고객명</td>
					<td class="inquiry_table_td02">&nbsp;<?=$member_name?>
						<input class="inquiry_name" name="member_name" type="hidden" value="<?=$member_name?>"/>
					</td>
				</tr>
				<tr>
					<td class="inquiry_table_td01">&nbsp;&nbsp;&nbsp;고객이메일</td>
					<td class="inquiry_table_td02">&nbsp;<?=$email_exp[0]?>@<?=$email_exp[1]?>
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
						<textarea class="inquiry_answer_content" name="message"></textarea>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="inquiry_answer_button"><button onclick="answer_check()">보내기</button></div>
	</form>
</div>
</body>
</html>