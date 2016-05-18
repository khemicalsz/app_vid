$(document).ready(function() {

	// Form Title
	$('.vid_inv_form_title').blur(function() {
	    var updatedVal = $(this).text();
	    // console.log(updatedVal);
	    $('input[name=lead_title]').val(updatedVal);
	});

	// Form Description
	$('.vid_inv_form_desc').blur(function() {
	    var updatedVal = $(this).text();
	    // console.log(updatedVal);
	    $('input[name=lead_desc]').val(updatedVal);
	});

	// Form Button
	$('.vid_inv_form_btn').blur(function() {
	    var updatedVal = $(this).text();
	    // console.log(updatedVal);
	    $('input[name=lead_btn_txt]').val(updatedVal);
	});

})