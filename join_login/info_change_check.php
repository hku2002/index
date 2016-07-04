<?php
	require_once("../dbconfig.php");
	session_start();

	$member_id = $_POST['member_id'];
	$email01   = $_POST['email01'];
	$email02   = $_POST['email02'];
	$address01 = $_POST['address01'];
	$address02 = $_POST['address02'];
	$zipcode   = $_POST['zipcode'];

	$member_id = str_replace("/","",$member_id);
	$email     = $email01 . '@' . $email02;
	$address   = $address01 . '/' . $address02;

	$_SESSION['email'] = $email;

	$sql = 'update z_test_member set email="' .$email. '", address="' .$address. '", zipcode="' .$zipcode. '" where member_id="' .$member_id. '"';
	$result = $db->query($sql);
	
	if($result) {
		echo "<script>alert('수정이 완료되었습니다.');history.back();</script>";
	} else {
		echo "<script>alert('오류가 발생하였습니다.');history.back();</script>";
	}
?>