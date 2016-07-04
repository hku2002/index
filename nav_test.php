
<!--
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="./css/common.css" />
-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
<style type="text/css">
body {font-family:"맑은 고딕"}
.n_top {width:100%; height:25px; border-bottom:1px solid #D5D5D5; padding:5px 0 0 0; background-color:#E7E7E7; text-align:center}
.n_top_content {height:25px; margin:0 auto; width:980px}
.n_top_ul {height:25px; margin:0 0 0 0; padding:0 0 0 800px}
.n_top_text {float:left; padding:5 0 0 0; width:65px; list-style-type:none}
.text {width:65px; color:gray; font-size:12px}
.n_bottom {width:100%; height:60px; border-bottom:1px solid #BDBDBD; text-align:center}
.n_bottom_content {margin:0 auto; width:980px; height:60px}
.n_bottom_ul {margin:0 0 0 0; padding:0 0 0 0; width:980px; height:60px}
.logo {float:left; padding:5px 10px 0 0; width:200px; height:60px; list-style-type:none}
.n_menu01 {float:left; padding-top:15px; width:150px; height:60px; font-size:23px; color:#353535; list-style-type:none}
.n_menu02 {float:left; padding-top:15px; width:150px; height:60px; font-size:23px; color:#353535; list-style-type:none}
.n_menu03 {float:left; padding-top:15px; width:150px; height:60px; font-size:23px; color:#353535; list-style-type:none}
.n_menu04 {float:left; padding-top:15px; width:150px; height:60px; font-size:23px; color:#353535; list-style-type:none}
.n_menu05 {float:left; padding-top:15px; width:150px; height:60px; font-size:23px; color:#353535; list-style-type:none}
.n_sub_menu {margin:0 auto; width:940px; height:25px}
.n_sub_ul01 {width:310px; height:25px; margin:0 0 0 70px; display:none}
.n_sub_ul02 {width:310px; height:25px; margin:0 0 0 200px; display:none}
.n_sub_ul03 {width:310px; height:25px; margin:0 0 0 330px; display:none}
.n_sub_ul04 {width:310px; height:25px; margin:0 0 0 480px; display:none}
.n_sub_ul05 {width:310px; height:25px; margin:0 0 0 570px; display:none}
.sub_menu {float:left; margin:0 10px 0 10px; font-size:13px; list-style-type:none}
</style>
<script type="text/javascript">
$(document).ready(function(){
    $(".n_menu01").mouseover(function(){
        $(".n_sub_ul01").css("display","block");
    });
	$(".n_menu01").mouseout(function(){
        $(".n_sub_ul01").css("display","none");
    });
});

function login() {
	location.replace('http://hku2002.cafe24.com/Z_TEST/join_login/login.php');
}

function logout() {
	location.replace('http://hku2002.cafe24.com/Z_TEST/join_login/logout.php');
}
function join() {
	location.replace('http://hku2002.cafe24.com/Z_TEST/join_login/join.php');
}
</script>
<!--
</head>
<body>
-->
	<div class="n_top">
		<div class="n_top_content">
			<ul class="n_top_ul">

				<?php
				session_start();
				if(!isset($_SESSION['id'])){
					echo "<li class='n_top_text' onclick='login()'><a href='#'><span class='text'>로그인&nbsp;&nbsp;|</span></a></li>
					<li class='n_top_text' onclick='join()'><a href='#'><span class='text'>회원가입</span></a></li>";
				} else {
					$id = $_SESSION['id'];
					echo "<li class='n_top_text' onclick='logout()'><a href='#'><span class='text'>로그아웃</span></a></li>";
				}
				?>

				
			</ul>
		</div>
	</div> <!--n_top-->
	<div class="n_bottom">
		<div class="n_bottom_content">
			<ul class="n_bottom_ul">
				<li class="logo"><img src="" width="200px" height="50px" alt="로고"/></li>
				<li class="n_menu01">메뉴1</li>
				<li class="n_menu02">메뉴2</li>
				<li class="n_menu03">메뉴3</li>
				<li class="n_menu04">메뉴4</li>
				<li class="n_menu05">메뉴5</li>
			</ul>
			<div class="n_sub_menu">
				<ul class="n_sub_ul01">
					<li class="sub_menu">서브메뉴1</li>
					<li class="sub_menu">|</li>
					<li class="sub_menu">서브메뉴2</li>
					<li class="sub_menu">|</li>
					<li class="sub_menu">서브메뉴3</li>
				</ul>
				<ul class="n_sub_ul02">
					<li class="sub_menu">서브메뉴4</li>
					<li class="sub_menu">|</li>
					<li class="sub_menu">서브메뉴5</li>
					<li class="sub_menu">|</li>
					<li class="sub_menu">서브메뉴6</li>
				</ul>
				<ul class="n_sub_ul03">
					<li class="sub_menu">서브메뉴7</li>
					<li class="sub_menu">|</li>
					<li class="sub_menu">서브메뉴8</li>
					<li class="sub_menu">|</li>
					<li class="sub_menu">서브메뉴9</li>
				</ul>
				<ul class="n_sub_ul04">
					<li class="sub_menu">서브메뉴10</li>
					<li class="sub_menu">|</li>
					<li class="sub_menu">서브메뉴11</li>
					<li class="sub_menu">|</li>
					<li class="sub_menu">서브메뉴12</li>
				</ul>
				<ul class="n_sub_ul05">
					<li class="sub_menu">서브메뉴13</li>
					<li class="sub_menu">|</li>
					<li class="sub_menu">서브메뉴14</li>
					<li class="sub_menu">|</li>
					<li class="sub_menu">서브메뉴15</li>
				</ul>
			</div>
		</div>
	</div> <!--n_bottom-->
<!--	
</body>
</html>
-->