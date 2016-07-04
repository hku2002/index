<?php 

	$db_host = "localhost";
	$db_id = "hku2002";
	$db_password = "gorbek2@!";
	$db_name = "hku2002";

	$db_conn = mysql_connect($db_host, $db_id, $db_password) or die ("Fail to connect database!");
	mysql_select_db ($db_name, $db_conn);

	$query = 'select member_id from z_test_member';
	$result = mysql_query($query);

	if(!$result){
		$message = 'Invalid query' .mysql_error()."\n";
		$message = 'Whole query' .$query;
		die($message);
	}

	$resultArray = array();
	while($row = mysql_fetch_assoc($result)) {
		$arrayMiddle = array(
			"member_id" => urlencode($row['member_id'])
		);
		array_push($resultArray, $arrayMiddle);
	}

	print_r(urldecode (json_encode($resultArray)));

/*
	// 데이터베이스에서 데이터를 가저옴
	if($result = mysqli_query($link, 'select member_id from z_test_member', MYSQLI_USE_RESULT)) {
		// 데이터베이스로부터 반환된 데이터를 객체 형태로 가공
		$obj = array();
		while($row = mysqli_fetch_object($result)) {
			$t = new stdClass();
			$t->member_id = $row->member_id;
			$obj[] = $t;
			unset($t);
		}
	} else {
		$obj = array(0 => 'empty');
	}
*/
	//최종결과 데이터를 JSON 스트링으로 변환 후 출력

?>