$(document).ready(function(){
	$(".removeUser").click(function(){
		var getID = $(this).attr("data-record-id");
		$("#inputDeleteID").val(getID);
	});
	
	$("#deleteYes").click(function(){
		$("#deleteUserFrm").submit();
	});
	
	
});