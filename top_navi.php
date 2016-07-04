<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
<style type="text/css">
* {margin:0;padding:0}
body {font-family:"맑은 고딕"}
a {color:#353535;text-decoration: none}
a:focus {outline:none}
.nav_wrap {width:100%;margin:0 auto;position:relative;background-color:white;border-bottom:1px solid #B8B8B8}
.n_top {width:100%; height:25px; border-bottom:1px solid #D5D5D5; padding:5px 0 0 0; background-color:#E7E7E7; text-align:center}
.n_top_content {height:25px; margin:0 auto; width:980px}
.n_top_ul {height:25px; margin:0 0 0 0; padding:0 0 0 800px}
.n_top_text {float:left; padding:5 0 0 0; width:65px; list-style-type:none}
.text {width:65px; color:gray; font-size:12px; cursor:pointer}
.nav_container {width:960px;margin:0 auto;position:relative}
.sub_wrap01 {display:none;width:200px;height:35px;position:relative;left:50%;margin-left:-100px;border:1px solid #ccc}
.sub_wrap02 {display:none;width:300px;height:35px;position:relative;left:50%;margin-left:-150px;border:1px solid #ccc}
.sub_content {float:left;width:100px;height:35px;font-size:13px;list-style:none;text-align:center}
nav {width:100%;height:60px;margin:0 auto}
nav:after {display:block;content:'';clear:both}
.logo {float:left;width:192px;height:60px;line-height:60px}
ul:after {display:block;content:'';clear:both}
nav>ul {height:60px}
nav>ul>li {float:left;width:192px;height:60px;font-size:17px;position:relative;list-style:none;text-align:center}
nav>ul>li>a {display:block;width:100%;height:60px;line-height:60px;font-weight:bold}
nav>ul>li>a:hover {color:white;background-color:#0054FF}
/* class 없을때 적용
nav ul ul {display:none;width:300px;height:35px;position:relative;left:50%;margin-left:-150px;border:1px solid #ccc}
nav ul ul li {float:left;width:100px;height:35px;font-size:13px;list-style:none;text-align:center}
*/
nav ul ul li a {display:block;width:99px;height:35px;line-height:35px;background-color:#fff;color:#555;border-right:1px solid #ccc}
nav ul ul li a:hover {background-color:#0054FF;color:white}
nav ul ul li:last-child a {width:100px;border-right:none}
.sub_menu_space {width:100%;height:36px}
</style>

<script type="text/javascript">
$(function(){
	var menu=$('nav>ul>li');
	menu.hover(function(){
		$(this).find('ul').css("display","block");
	}, function(){
		$('nav ul ul').css("display","none");
	});
});

function login() {
	location.replace('http://hku2002.cafe24.com/Z_TEST/join_login/login.php');
}

function logout() {
	location.replace('http://hku2002.cafe24.com/Z_TEST/join_login/logout.php');
}

function info_change(){
	location.replace('http://hku2002.cafe24.com/Z_TEST/join_login/info_change.php');
}
function join() {
	//location.replace('http://hku2002.cafe24.com/Z_TEST/join_login/join_agree.php');
	document.join_agr.submit();
}

</script>

<div class="nav_wrap">
	<div class="n_top">
		<div class="n_top_content">
			<ul class="n_top_ul">

				<?php
				session_start();
				if(!isset($_SESSION['id'])){
					echo "<li class='n_top_text' onclick='login()'><span class='text'>로그인&nbsp;&nbsp;</span></li>
					<form action='http://hku2002.cafe24.com/Z_TEST/join_login/join_agree.php' name='join_agr' method='post'>
					<li class='n_top_text' onclick='join()'><span class='text'>회원가입</span></li>
					<input type='hidden' name='data' value='1'/>
					</form>";
				} else {
					$id = $_SESSION['id'];
					echo "<li class='n_top_text' onclick='logout()'><a href='#'><span class='text'>로그아웃</span></a></li>
					<li class='n_top_text' onclick='info_change()'><a href='#'><span class='text'>정보수정</span></a></li>";
				}
				?>

				
			</ul>
		</div>
	</div><!--n_top-->
	<div class="nav_container">
		<nav>
			<div class="logo">
			<a href="http://hku2002.cafe24.com/Z_TEST/index.php"><img src="http://hku2002.cafe24.com/Z_TEST/img/logo.png" width="192px" height="60px" alt="로고이미지"/></a></div>
			<ul>
				<li>
					<a href="#">회사소개</a>
					<ul class="sub_wrap01">
						<li class="sub_content"><a href="http://hku2002.cafe24.com/Z_TEST/company/company_info.php">회사소개</a></li>
						<li class="sub_content"><a href="http://hku2002.cafe24.com/Z_TEST/company/ceo_greeting.php">CEO인사말</a></li>
					</ul>
				</li>
				<li>
					<a href="#">자료실</a>
					<ul class="sub_wrap01">
						<li class="sub_content"><a href="http://hku2002.cafe24.com/Z_TEST/library/c_library_list.php">공용자료실</a></li>
						<li class="sub_content"><a href="#">관리자자료실</a></li>
					</ul>
				</li>
				<li>
					<a href="#">고객지원</a>
					<ul class="sub_wrap02">
						<li class="sub_content"><a href="http://hku2002.cafe24.com/Z_TEST/board/test_board.php">게시판</a></li>
						<li class="sub_content"><a href="http://hku2002.cafe24.com/Z_TEST/notice/notice_list.php">공지사항</a></li>
						<li class="sub_content"><a href="http://hku2002.cafe24.com/Z_TEST/inquiry/inquiry.php">문의하기</a></li>
					</ul>
				</li>
				<li>
					<a href="#">기타</a>
					<ul class="sub_wrap02">
						<li class="sub_content"><a href="#">공용채팅방</a></li>
						<li class="sub_content"><a href="#">서브11</a></li>
						<li class="sub_content"><a href="#">서브12</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</div>
<div class="sub_menu_space"></div>