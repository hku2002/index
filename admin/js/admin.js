
/* member_manage.php */
function member_delete() {
	document.member_form.action = './member_delete_check.php';
	document.member_form.submit();
}

function member_up() {
	document.member_form.action = './member_up_check.php';
	document.member_form.submit();
}

function member_down() {
	document.member_form.action = './member_down_check.php';
	document.member_form.submit();
}

$(function(){
	$('#all_check').click(function(){
		if($('#all_check').prop("checked")) {
			$('input[id=member_check]').prop("checked",true);
		} else {
			$('input[id=member_check]').prop("checked",false);
		}
	});
});


/* inquiry_answer.php */
function answer_check() {
	var title   = document.send_mail.title.value;
	var message = document.send_mail.message.value;

	if(title == '') {
		alert("제목을 입력하여 주십시요.");
		return;
	} else if(message == null) {
		alert("내용을 입력하여 주십시요.");
		return;
	} else {
		document.send_mail.submit;
	}
}

/* board_manage.php */
$(function(){
	$('#board_all_check').click(function(){
		if($('#board_all_check').prop("checked")) {
			$('input[id=board_check]').prop("checked",true);
		} else {
			$('input[id=board_check]').prop("checked",false);
		}
	});
});