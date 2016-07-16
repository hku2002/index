<!--
<?php
	header('Content-Type: text/html; charset=utf-8');
	$db = new mysqli('localhost', '111111', '111111', '111111');

	if($db->connect_error) {
		die('데이터베이스 연결에 문제가 있습니다.\n관리자에게 문의 바랍니다.');
	}

	$db->set_charset('utf8');
?>
-->
<?php
class DBC //이거 사용 안됨 로그인만 사용
{
	public $db;
	public $query;
	public $result;

	public function DBI()
	{
		$this->db = new mysqli('localhost', '111111', '111111', '111111'); //host, id, pw, database 순서
		$this->db->query('SET NAMES UTF8');
		if(mysqli_connect_errno())
		{
			header("Content-Type: text/html; charset=UTF-8");
			echo "데이터 베이스 연동에 실패했습니다.";
			exit;
		}
	}

	public function DBQ()
	{
		$this->result = $this->db->query($this->query);
	}

	public function DBO()
	{
		//$this->result->free;
		$this->db->close();
	}
}
?>
