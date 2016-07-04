<?php
	header("Content-Type: text/html; charset=UTF-8");
	require_once("../dbconfig.php");
	$db = new DBC;
	$db->DBI();

	$id        = $_POST['id'];
	$password  = $_POST['password'];
	$email01   = $_POST['email01'];
	$email02   = $_POST['email02'];
	$email     = $email01."@".$email02;
	$date      = date('Y-m-d');
	$name      = $_POST['name'];
	$address01 = $_POST['address01'];
	$address02 = $_POST['address02'];
	$zipcode   = $_POST['zipcode'];

	$address = $address01 .'/'. $address02;

	$db->query = "insert into z_test_member values ('".$id."', password('".$password."'), '".$email."', '".$date."', 1, '".$name."', '".$address."', '".$zipcode."')";
	$db->DBQ();
	if(!$db->result) {
		echo "<script>alert('회원가입에 실패하였습니다.');history.back();</script>";
		$db->DBO();
		exit;
		
	} else {
		header("Content-Type: text/html; charset=UTF-8");
		echo "<script>alert('회원가입 하신것을 환영합니다. 로그인 페이지로 이동합니다.');location.replace('./login.php');</script>";
		$db->DBO();
		exit;
	}


?>