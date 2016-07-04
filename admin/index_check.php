<?php
	require_once("../dbconfig.php");
	session_start();
	session_destroy();
	header("Content-Type: text/html; charset=UTF-8");
	$db = new DBC;
	$db->DBI();

	$id = $_POST['log_id'];
	$pass = $_POST['log_passwd'];

	$db->query = "select member_id, passwd, permit, member_name, email from z_test_member where member_id='".$id."' and passwd=password('".$pass."')";
	$db->DBQ();

	$num = $db->result->num_rows;
	$data = $db->result->fetch_row();

	$db->DBO();

	if($num==1 and $data[2]==2) {
		session_start();
		$_SESSION['id'] = $id;
		$_SESSION['permit'] = $data[2];
		$_SESSION['name'] = $data[3];
		//echo $id;
		echo "<script>location.replace('./main.php');</script>";
	} else {
		echo "<script>alert('관리자만 로그인 가능합니다.');history.back();</script>";
	}


?>
