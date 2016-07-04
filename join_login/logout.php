<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();
unset($_SESSION['id']);
unset($_SESSION['permit']);
session_destroy();
echo "<script>alert('로그아웃 되었습니다.');location.replace('../index.php')</script>";
?>