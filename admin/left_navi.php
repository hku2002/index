<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
	$('.navi_board').click(function(){
		$('.navi_ul_child').toggle('fast');
	});
});
</script>

<div class="left_navi">
	<div class="navi_top_margin"></div>
	<ul class="navi_ul">
		<a href="http://hku2002.cafe24.com/Z_TEST/admin/member_manage/member_manage.php"><li class="navi_content">회원관리</li></a>
		<li class="navi_board">게시판관리
			<ul class="navi_ul_child">
				<a href="http://hku2002.cafe24.com/Z_TEST/admin/board_manage/board_manage.php"><li class="navi_content">게시판</li></a>
				<a href="./notice_manage.php"><li class="navi_content">공지사항</li></a>
			</ul>
		</li>
		<a href="http://hku2002.cafe24.com/Z_TEST/admin/inquiry_manage/inquiry_manage.php"><li class="navi_inquiry">문의글관리</li></a>
		<a href="./access_log.php"><li class="navi_content">접속관리</li></a>
	</ul>
</div>