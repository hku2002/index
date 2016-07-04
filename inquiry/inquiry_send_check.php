<?php
	header("Content-Type: text/html; charset=UTF-8");

	$id      = $_POST['id'];
	$name    = $_POST['name'];
	$email   = $_POST['email'];
	$title   = $_POST['title'];
	$message = $_POST['message'];
   
	$to='hku2002@nate.com';
	$msg = '아이디 : ' .$id. '<br/>'.
		   '이름 : ' .$name. '<br/>'.
		   '내용 : ' .$message;
   
	mail($to,$title,$msg,"보낸사람 메일주소 : ".$email);  

	require_once("../dbconfig.php");
	$sql = "insert into z_test_inquiry (inquiry_num, member_id, member_name, email, inquiry_title, inquiry_content) values(null,'".$id."','".$name."','".$email."','".$title."','".$message."')";
	$result = $db->query($sql);
	echo "<script>alert('문의글 전송이 완료되었습니다.');location.replace('../index.php');</script>";
   
?>