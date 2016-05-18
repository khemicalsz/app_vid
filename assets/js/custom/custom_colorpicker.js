$(function(){
	$('.titleColor').colorpicker({
		format: 'hex',

	}).on('changeColor.titleColor', function(event){
  		
  		$("#buttonTitle").css('color',event.color.toHex());
  		$(".btnPreviewTitle").css('color',event.color.toHex());
	})
	
	/*
	$('.button-text').colorpicker({
		format: 'hex',

	}).on('changeColor.button-text', function(event){
		$("#buttonTxt a").css('color',event.color.toHex());
		//alert('hey');

	});
	*/

	$('.btnbgcontainer').colorpicker({
		format: 'hex',

	}).on('changeColor.btnbgcontainer', function(event){
  		
  		$("#btnBg").css('background-color',event.color.toHex());
  		$(".btnPreviewBackground").css('background-color',event.color.toHex());
	})



	$("#btnBackground").on("change",function(){
		$("#buttonTxt").css('background-color','');
		
		$("#buttonTxt").removeClass(removeButtonBgClasses);
		$(".btnPreview").removeClass(removeButtonBgClasses);

		$("#buttonTxt").addClass($(this).val());
		$(".btnPreview").addClass($(this).val());
	});


	function removeButtonBgClasses(index, css) {
    return (css.match (/(^|\s)button-bg\S+/g) || []).join(' ');
    }; 


	$('.button-text').colorpicker({
		format: 'hex',

	}).on('changeColor.button-text', function(event){

		$(".btnPreview a").css('color',event.color.toHex());
		$("#buttonTxt a").css('color',event.color.toHex());
	});
	

	$("#btnTxtInput").keyup(function(){
		var btnTxt = $(this).val();

		$(".button-text-custom").text(btnTxt);

	});

	$("#btnTitleText").keyup(function(){
		var btnTxt = $(this).val();
		$("#buttonTitle").text(btnTxt);
		$(".btnPreviewTitle").text(btnTxt);

	});	

	
	
	 $("#btnTxtInput").bind('blur',function(){
                var getbtnTxtVal = $(this).val();

               if(getbtnTxtVal !='')
               {
                    $(".btnPreview").text(getbtnTxtVal);
               }
       });

       $("#redirect_url").bind('blur',function(){
                var getbtnUrlVal = $(this).val();
                
               if(getbtnUrlVal !='')
               {
                    $(".btnPreviewBackground a").attr("href",getbtnUrlVal);
                    $("#buttonTxt a").attr("href",getbtnUrlVal);

               }
               else
               {
               		$(".button-styling").hide();
               }
       });


/*
	$("#buttonShape").change(function(){
		var getShape = $(this).val();
		var getbutton = $("#buttonTxt");
		var getPreviewButton = $(".btnPreview");

		switch(getShape)
		{
			case 'Square':
				getbutton.removeClass(removeClasses);
				getbutton.addClass("radius-button-square");

				getPreviewButton.removeClass(removeClasses);
				getPreviewButton.addClass("radius-button-square");
				break;

			case 'Rounded':
				getbutton.removeClass(removeClasses);
				getbutton.addClass("radius-button-rounded");

				getPreviewButton.removeClass(removeClasses);
				getPreviewButton.addClass("radius-button-rounded");
				break;

			case 'Round':
				getbutton.removeClass(removeClasses);
				getbutton.addClass("radius-button-round");

				getPreviewButton.removeClass(removeClasses);
				getPreviewButton.addClass("radius-button-round");				
				break;

			default:
				getbutton.removeClass(removeClasses);
				getbutton.addClass("radius-button-square");

				getPreviewButton.removeClass(removeClasses);
				getPreviewButton.addClass("radius-button-square");

		}

	});


	function removeClasses(index, css) {
    return (css.match (/(^|\s)radius-\S+/g) || []).join(' ');
	};

	$("#buttonSize").change(function(){
		var getSize = $(this).val();
		var getbutton = $("#buttonTxt");
		var getPreviewButton = $(".btnPreview");
		switch(getSize)
		{
			case 'Mini':
				getbutton.removeClass(removeSizeClasses);
				getbutton.addClass("size-button-mini");

				getPreviewButton.removeClass(removeSizeClasses);
				getPreviewButton.addClass("size-button-mini");				
				break;

			case 'Small':
				getbutton.removeClass(removeSizeClasses);
				getbutton.addClass("size-button-small");

				getPreviewButton.removeClass(removeSizeClasses);
				getPreviewButton.addClass("size-button-small");
				break;

			case 'Normal':
				getbutton.removeClass(removeSizeClasses);
				getbutton.addClass("size-button-normal");

				getPreviewButton.removeClass(removeSizeClasses);
				getPreviewButton.addClass("size-button-normal");
				break;

			case 'Large':
				getbutton.removeClass(removeSizeClasses);
				getbutton.addClass("size-button-large");

				getPreviewButton.removeClass(removeSizeClasses);
				getPreviewButton.addClass("size-button-large");				
				break;
					
			default:
				getbutton.removeClass(removeSizeClasses);
				getbutton.addClass("size-button-small");

				getPreviewButton.removeClass(removeSizeClasses);
				getPreviewButton.addClass("size-button-small");

		}

	});

	function removeSizeClasses(index, css) {
    return (css.match (/(^|\s)size-\S+/g) || []).join(' ');
	};

	
	$("#buttonStyle").change(function(){
		var getStyle = $(this).val();
		var getbutton = $("#buttonTxt");
		var getPreviewButton = $(".btnPreview");
		switch(getStyle)
		{
			case 'Modern':
				getbutton.removeClass(removeStyleClasses);
				getbutton.addClass("hover-button-modern");

				getPreviewButton.removeClass(removeStyleClasses);
				getPreviewButton.addClass("hover-button-modern");
				break;

			case 'Classic':
				getbutton.removeClass(removeStyleClasses);
				getbutton.addClass("hover-button-classic");

				getPreviewButton.removeClass(removeStyleClasses);
				getPreviewButton.addClass("hover-button-classic");
				break;

			case 'Flat':
				getbutton.removeClass(removeStyleClasses);
				getbutton.addClass("hover-button-flat");

				getPreviewButton.removeClass(removeStyleClasses);
				getPreviewButton.addClass("hover-button-flat");
				break;

			case 'Outline':
				getbutton.removeClass(removeStyleClasses);
				getbutton.addClass("hover-button-outline");

				getPreviewButton.removeClass(removeStyleClasses);
				getPreviewButton.addClass("hover-button-outline");
				break;
			
			case '3D':
				getbutton.removeClass(removeStyleClasses);
				getbutton.addClass("hover-button-3d");

				getPreviewButton.removeClass(removeStyleClasses);
				getPreviewButton.addClass("hover-button-3d");
				break;

			default:
				getbutton.removeClass(removeStyleClasses);
				getbutton.addClass("hover-button-modern");

				getPreviewButton.removeClass(removeStyleClasses);
				getPreviewButton.addClass("hover-button-modern");

		}

	});

	function removeStyleClasses(index, css) {
    return (css.match (/(^|\s)hover-\S+/g) || []).join(' ');
	};	

	*/
	
	$("#addUrl").click(function(){
		$("#landingImgUrlWrapper").slideDown();
	});

	$("#showImg").click(function(){
		$("#landingImgUrlWrapper").hide();
		$("#landingImgUrl").val('');
	});

	$("#uploadBuyNowButton").click(function(){
		$("#uploadButtonWrapper").slideDown();
	});

	$("#showBuyNowBtn").click(function(){
		$("#uploadButtonWrapper").hide();
		$("#uploadBuyNow").val('');
	});

	$("#bannerUrl").blur(function(){

		var bannerUrl = $("#bannerUrl").val();
		var img = $("<img />").attr('src', bannerUrl)
	    .one('load', function() {
	        if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
	            alert('broken image!');
	        } else {
	            $(".bannerPreview a").append(img);
	            
	        }
	    });
	});

	$("#bannerRedirectUrl").blur(function(){
		getLink = $(this).val();
		
		if(getLink == '')
		{
			$(".bannerPreview a").hide();
		}
		else
		{
			$(".bannerPreview a").show();
			$(".bannerPreview a").attr("href", getLink);	
		}
		
	});

	$("#uploadBuyNow").change(function (){
       var fileName = $("#uploadBuyNow")[0].files[0];
       var tmppath = URL.createObjectURL($("#uploadBuyNow")[0].files[0]);
       //$(".filename").html(fileName);
       //console.log(fileName);
       //console.log(tmppath);
       //$(".buyNowPreview a").attr("href", fileName);
     	$(".buyNowPreview a").html('');

     	var file = $("#uploadBuyNow")[0].files[0];
    	if(file.type.match('image.*')){
        var reader = new FileReader();
        reader.onload = (function(file){
            return function(e){
                //console.log(e.target.result);
                var img = $("<img />").attr('src', e.target.result);
                $(".buyNowPreview a").append(img);
            }
        })(file);
	    }

	    reader.readAsDataURL(file);

     });

		
	$(".buy-button-img").click(function(){
		var imgSrc = $(this).find('img').attr('src');
		//var replaceImgType = imgSrc.replace(".png",".gif");
		$(".buyNowPreview a").html('');
		var img = $("<img />").attr('src', imgSrc);
		$(".buyNowPreview a").append(img);
		$("#uploadedBuyNowIcon").val('');
	});
	

	$("#buyNowUrl").blur(function(){
		getLink = $(this).val();
		
		if(getLink == '')
		{
			$(".buyNowPreview a").hide();
		}
		else
		{
			$(".buyNowPreview a").show();
			$(".buyNowPreview a").attr("href", getLink);	
		}
		
	});


});