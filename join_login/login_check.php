<?php
	require_once("../dbconfig.php");
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

	if($num==1) {
		session_start();
		$_SESSION['id'] = $id;
		$_SESSION['permit'] = $data[2];
		$_SESSION['name'] = $data[3];
		$_SESSION['email'] = $data[4];
		echo "<script>location.replace('../index.php');</script>";
	} else if(($id!="" || $pass!="") && $data[0]!=1) {
		echo "<script>alert('아이디 혹은 비밀번호가 맞지 않습니다.');history.back();</script>";
	}


?>
