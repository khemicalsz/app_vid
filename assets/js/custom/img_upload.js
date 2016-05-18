$(document).ready(function() {

  $.uploadPreview({
    input_field: "#image-upload",
    preview_box: "#image-preview",
    label_field: "#image-label"
  });

  $('#image-preview').hover(
	  function () {
	    $('#image-label').fadeIn();
	  },
	  function () {
	    $('#image-label').fadeOut();
	  }
	);


	function convertFileToDataURLviaFileReader(url, callback){
		    var xhr = new XMLHttpRequest();
		    xhr.responseType = 'blob';
		    xhr.onload = function() {
		        var reader  = new FileReader();
		        reader.onloadend = function () {
		            callback(reader.result);
		        }
		        reader.readAsDataURL(xhr.response);
		    };
		    xhr.open('GET', url);
		    xhr.send();
	}

	function convertImgToDataURLviaCanvas(url, callback, outputFormat) {
	    var img = new Image();
	    img.crossOrigin = 'Anonymous';
	    img.onload = function(){
	        var canvas = document.createElement('CANVAS');
	        var ctx = canvas.getContext('2d');
	        var dataURL;
	        canvas.height = this.height;
	        canvas.width = this.width;
	        ctx.drawImage(this, 0, 0);
	        dataURL = canvas.toDataURL(outputFormat);
	        callback(dataURL);
	        canvas = null;
	    };
	    img.src = url;
	}


	var convertFunction = convertImgToDataURLviaCanvas;
	var imageUrl = $('#first-img').attr('src');

	convertFunction(imageUrl, function(base64Img) {
		$('#image-preview').css('background-image', 'url(' + base64Img + ')');
	});

	// $('.utm_form_title1').on('keypress', function(evt) {
	// 	console.log($('.utm_form_title1').text());
	// });

});