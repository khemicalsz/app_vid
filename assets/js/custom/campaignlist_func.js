$(document).ready(function(){
	$(".removeBtn").click(function(){
		var getID = $(this).attr("data-record-id");
		
		$("#inputDeleteID").val(getID);
	});


	$("#deleteYes").click(function(){
		$("#deleteCampaignFrm").submit();
	});


	$(".view").click(function(){
		var getID = $(this).attr("data-cid");
		

		$.ajax({
			 type:'post',
			 data:{"cid":getID},
			 url:'campaignlist/ajaxGenerateHtml',
			 success:function(data){
			 	//console.log(data);
			 	$('#showGenCode').text(data);
			 	$('#generateHtmlContainer').modal('show'); 
			 }
		});
	});

	$(".wordpress").click(function(){
		var getID = $(this).attr("data-cid");
		

		$.ajax({
			 type:'post',
			 data:{"cid":getID},
			 url:'campaignlist/ajaxWordpressCode',
			 success:function(data){
			 	console.log(data);
			 	$('#showWordpressCode').text(data);
			 	$('#wordpressContainer').modal('show'); 
			 }
		});
	});
	
});