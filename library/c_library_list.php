<?php
	require_once("../dbconfig.php");
	
	/* 페이징 시작 */
	//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
	if(isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}

	/* 검색 시작 */
	
	if(isset($_GET['searchColumn'])) {
		$searchColumn = $_GET['searchColumn'];
		$subString = null;
		$subString = '&amp;searchColumn=' . $searchColumn;
	}
	if(isset($_GET['searchText'])) {
		$searchText = $_GET['searchText'];
		$subString = null;
		$subString = '&amp;searchText=' . $searchText;
	}
	
	if(isset($searchColumn) && isset($searchText)) {
		$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
	} else {
		$searchSql = '';
	}
	
	/* 검색 끝 */
	
	$sql = 'select count(*) as cnt from z_test_c_library'. $searchSql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	
	$allPost = $row['cnt']; //전체 게시글의 수

	if(empty($allPost)) {
		$emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';
		$allPage = 1;
		$onePage = 1;
	} else if($allPost) {
	
	$onePage = 15; // 한 페이지에 보여줄 게시글의 수.
	$allPage = ceil($allPost / $onePage); //전체 페이지의 수
	}
	
	if($page < 1 && $page > $allPage) {
?>
		<script>
			alert("존재하지 않는 페이지입니다.");
			history.back();
		</script>
<?php
		exit;
	}
	
	$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
	$currentSection = ceil($page / $oneSection); //현재 섹션
	$allSection = ceil($allPage / $oneSection); //전체 섹션의 수
	
	$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지
	
	if($currentSection == $allSection) {
		$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
	} else {
		$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
	}
	
	$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
	$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.
	
	$subString ='';
	$paging = '<ul>'; // 페이징을 저장할 변수
	
	//첫 페이지가 아니라면 처음 버튼을 생성
	if($page != 1) { 
		$paging .= '<a href="./c_library_list.php?page=1' . $subString . '"><li class="page_start">처음</li></a>';
	}
	//첫 섹션이 아니라면 이전 버튼을 생성
	if($currentSection != 1) { 
		$paging .= '<a href="./c_library_list.php?page=' . $prevPage . $subString . '"><li class="page_prev">이전</li></a>';
	}
	
	for($i = $firstPage; $i <= $lastPage; $i++) {
		if($i == $page) {
			$paging .= '<li class="page_current">' . $i . '</li>';
		} else {
			$paging .= '<a href="./c_library_list.php?page=' . $i . $subString . '"><li class="page">' . $i . '</li></a>';
		}
	}
	
	//마지막 섹션이 아니라면 다음 버튼을 생성
	if($currentSection != $allSection) { 
		$paging .= '<a href="./c_library_list.php?page=' . $nextPage . $subString . '"><li class="page_next">다음</li></a>';
	}
	
	//마지막 페이지가 아니라면 끝 버튼을 생성
	if($page != $allPage) { 
		$paging .= '<a href="./c_library_list.php?page=' . $allPage . $subString . '"><li class="page_end">끝</li></a>';
	}
	$paging .= '</ul>';
	
	/* 페이징 끝 */
	$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
	$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문
	
	$sql = 'select * from z_test_c_library' . $searchSql . ' order by c_lib_num desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지)
	$result = $db->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>해규의 홈페이지</title>
	<link rel="stylesheet" href="../css/board.css" />
</head>
<body>
<?php
	require_once("../top_navi.php");
	require_once("../sub_top_img.php");
	if(!isset($_SESSION['id'])) {
		$id="";
	} else {
		$id=$_SESSION['id'];
	}
?>
<script>
	function writee() {
		var id='<?=$id;?>';
		if(id!="") {
			location.replace('./c_library_upload.php');
		} else if(id==""){
			alert("로그인이 필요합니다.");
		}
	}
</script>
<div class="boardWrap">
	<article class="boardArticle">
		<div id="boardList">
			<div class="sub_top">
				<div class="sub_top_title">공용자료실</div>
				<div class="sub_top_route">Home>자료실>공용자료실</div>
				<div class="clear"></div>
			</div>
			<div class="searchBox">
				<form action="./c_library_list.php" method="get">
					<div class="searchBox02">
						<select name="searchColumn" class="select_box">
							<option <?php echo $searchColumn=='c_lib_title'?'selected="selected"':null?> value="c_lib_title">제목</option>
							<option <?php echo $searchColumn=='c_lib_content'?'selected="selected"':null?> value="c_lib_content">내용</option>
							<option <?php echo $searchColumn=='member_id'?'selected="selected"':null?> value="member_id">작성자</option>
						</select>
					</div>
					<div class="searchBox03">
						<input class="input_box" type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>">
					</div>
					<div class="searchBox04">
						<button type="submit" class="search_btn">검색</button>
					</div>
					<div class="clear"></div>
				</form>
			</div>
			<div class="board_wrap">
			<table>
				<thead>
					<tr>
						<th scope="col" class="no">번호</th>
						<th scope="col" class="title">제목</th>
						<th scope="col" class="author">작성자</th>
						<th scope="col" class="date">최종작성일</th>
						<th scope="col" class="hit">조회</th>
					</tr>
				</thead>
				<tbody>
						<?php
							if(isset($emptyData)) {
								echo $emptyData;
							} else {
							while($row = $result->fetch_assoc())
							{
								$datetime = explode(' ', $row['c_lib_date']);
								$date = $datetime[0];
								$time = $datetime[1];
								if($date == Date('Y-m-d'))
									$row['c_lib_date'] = $time;
								else
									$row['c_lib_date'] = $date;
						?>
					<tr>
						<td class="no"><?php echo $row['c_lib_num']?></td>
						<td class="title">&nbsp;&nbsp;&nbsp;&nbsp;<a href="./c_library_view.php?c_lib_num=<?=$row['c_lib_num']?>"><?php echo $row['c_lib_title']?></a></td>
						<td class="author"><?php echo $row['member_id']?></td>
						<td class="date"><?php echo $row['c_lib_date']?></td>
						<td class="hit"><?php echo $row['c_lib_hit']?></td>
					</tr>
						<?php
							}
						}
						?>
				</tbody>
			</table>
			</div>
			<div class="btnSet">
				<div class="bd_button" onclick="writee();">글쓰기</div>
			</div>
			<div class="paging">
				<div class="paging_num">
					<?php echo $paging ?>
				</div>
			</div>
		</div>
	</article>
</div>
<div>
	<?php
		require_once("../footer.php");
	?>
</div>
</body>
</html>