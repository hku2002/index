<?php
	require_once("../dbconfig.php");
	header('Content-Type: text/html; charset=UTF-8');

	$c_lib_num = $_POST['c_lib_num'];

	$sql = 'select c_lib_filename from z_test_c_library where c_lib_num = "' . $c_lib_num .'"';
	$result = $db->query($sql);
	$row = $result->fetch_assoc();


	$filepath   = './file/'.$row['c_lib_filename'];
	$filesize   = filesize($filepath);
	$path_parts = pathinfo($filepath);

	$path_parts['basename'] = iconv("UTF-8","CP949",$path_parts['basename']);
	$filepath = iconv("CP949","UTF-8",$filepath);

	$filename   = $path_parts['basename'];
	$extension  = $path_parts['extension'];

	header("Pragma: public");
	header("Expires: 0");
	header("Content-Type: application/octet-stream");
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: $filesize");

	ob_clean();
	flush();
	readfile($filepath);

?>
