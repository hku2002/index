<?php
	require_once("../dbconfig.php");
	session_start();
	header('Content-Type: text/html; charset=utf-8');

	// 파일 업로드
	// 설정
	$uploads_dir = './file/';
	$allowed_ext = array('jpg','jpeg','png','gif','hwp','txt','pdf');
	 
	// 변수 정리
	$_FILES['userfile']['name'] = iconv("UTF-8","CP949",$_FILES['userfile']['name']);

	$error = $_FILES['userfile']['error'];
	$name = $_FILES['userfile']['name'];
	$ext = array_pop(explode('.', $name));
	 
	// 오류 확인
	if( $error != UPLOAD_ERR_OK ) {
		switch( $error ) {
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				echo "<script>alert('업로드 용량을 초과하였습니다.');history.back();</script>";
			case UPLOAD_ERR_NO_FILE:
				echo "<script>alert('파일이 첨부되지 않았습니다.');history.back();</script>";
				break;
			default:
				echo "<script>alert('파일이 업로드 되지 않았습니다. 관리자에게 문의하세요.');history.back();</script>";
		}
		exit;
	}
	 
	// 확장자 확인
	if( !in_array($ext, $allowed_ext) ) {
		echo "허용되지 않는 확장자입니다.";
		exit;
	}
	 
	// 파일 이동
	move_uploaded_file( $_FILES['userfile']['tmp_name'], "$uploads_dir/$name");
	$name = iconv("CP949","UTF-8",$name);
	// 파일 정보 출력
	echo "<h2>파일 정보</h2>
		<ul>
			<li>파일명: $name</li>
			<li>확장자: $ext</li>
			<li>파일형식: {$_FILES['userfile']['type']}</li>
			<li>파일크기: {$_FILES['userfile']['size']} 바이트</li>
		</ul>";




	//$_POST['c_lib_num']이 있을 때만 $c_lib 선언
	if(isset($_POST['c_lib_num'])) {
		$c_lib_num = $_POST['c_lib_num'];
		$c_lib_date = date('Y-m-d H:i:s');
	}

	//c_lib_num 없다면(글 쓰기라면) 변수 선언
	if(empty($tb_num)) {
		$member_id = $_SESSION['id'];
		$c_lib_date = date('Y-m-d H:i:s');
	}

	//항상 변수 선언
	$c_lib_title = $_POST['c_lib_title'];
	$c_lib_content = $_POST['c_lib_content'];

//글 수정
if(isset($c_lib_num)) {

	//업데이트 쿼리 작성
	if($row['cnt']) {
		$sql = 'update z_test_c_library set c_lib_title="' .$c_lib_title. '", c_lib_content="' .$c_lib_content. '", c_lib_date= "' .$c_lib_date. '" where c_lib_num = ' .$c_lib_num;
		$msgState = '수정';
	//틀리다면 메시지 출력 후 이전화면으로
	} else {
		$msg = '오류가 발생하였습니다.';
	?>
		<script>
			alert("<?php echo $msg?>");
			history.back();
		</script>
	<?php
		exit;
	}
	
//글 등록
} else {
	$sql = 'insert into z_test_c_library (c_lib_num, c_lib_title, c_lib_content, c_lib_date, c_lib_hit, member_id, c_lib_filename) values(null, "' . $c_lib_title . '", "' . $c_lib_content . '", "' . $c_lib_date . '", 0, "' . $member_id . '","' . $name . '")';
	$msgState = '등록';
}

//메시지가 없다면 (오류가 없다면)
if(empty($msg)) {
	$result = $db->query($sql);
	
	//쿼리가 정상 실행 됐다면,
	if($result) {
		$msg = '정상적으로 글이 ' . $msgState . '되었습니다.';
		if(empty($c_lib_num)) {
			$c_lib_num = $db->insert_id;
		}
		$replaceURL = './c_library_view.php?c_lib_num=' . $c_lib_num;
	} else {
		$msg = '글을 ' . $msgState . '하지 못했습니다.';
?>
		<script>
			alert("<?php echo $msg?>");
			history.back();
		</script>
<?php
		exit;
	}
}

?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>