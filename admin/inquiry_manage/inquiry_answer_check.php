<?php
	header("Content-Type: text/html; charset=UTF-8");

	$member_id   = $_POST['member_id'];
	$member_name = $_POST['member_name'];
	$email       = $_POST['email'];
	$title       = $_POST['title'];
	$message     = $_POST['message'];
	$headers = "From: customer@hku2002.cafe24.com\r\n";
   
	$to = $email;
   
	mail($to,$title,$message,$headers); 

	require_once("../../dbconfig.php");
	$sql = "update z_test_inquiry set answer = 'o' where member_id='".$member_id."'";
	$result = $db->query($sql);

	echo "<script>alert('답변글 전송이 완료되었습니다.');location.replace('../main.php');</script>";
   
?>