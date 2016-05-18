jQuery(document).ready(function($) {

$('head').append('<link href="http://oto2.vidinvision.net/assets/css/font-awesome.min.css" rel="stylesheet">');
$('head').append('<link rel="stylesheet" href="http://oto2.vidinvision.net/assets/css/generate.css" type="text/css" />');
$('head').append('<link rel="stylesheet" href="http://oto2.vidinvision.net/assets/css/overlay-external.css" type="text/css" />');

    /*
    |--------------------------------------------------------------------------
    | When play button is clicked on the screen - uncomment the player iframe
    |--------------------------------------------------------------------------
    |
    */
	
	if($(window).width() <= 767 )
	{
		$(".ivf_container").css({width: '',height: ''});
		
	}
		

     $('.play_btn').on('click', function() {

            var txt = $(".ivf_container").attr("id");
            var campaignID = txt.split("-");
               
              $.ajax({
                    type: "POST",
                    url: 'http://oto2.vidinvision.net/tracking',
                    data:{campaign: campaignID[1]},
                    async:true,
                    crossDomain:true,
                    success: function(data) {
                        //alert(data);
                    }
                });

         
        $("#fullpreview").css("display","block");

        var button = $(this),
            player_wrapper = button.parent(),
            url = button.attr('data-video_url'),
            player_wrapper_content = player_wrapper.contents(),
            iframe = player_wrapper_content[0].data;
        //default loading method
        player_wrapper.prepend(iframe);
        //fallback for lazy-loade
        if(player_wrapper.find('iframe').length < 1) {
            player_wrapper.prepend('<iframe id="vdoPlayer1"  src="'+url+'" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>');
        }
        player_wrapper.addClass('plaing');
        player_wrapper.find('.play_btn').hide();

        var getDelayValue = $(".btnFinalBackground").attr("data-btn-delay");

        if(getDelayValue == '')
        {
            getDelayValue = 20; 
        }
		
		//seconds=A*1000;
		var delayAction  = getDelayValue*1000;
		
		$(".button-styling").delay(delayAction).fadeIn();


        var getBannerDelayValue = $(".bannerPreview").attr("data-banner-delay");
        if(getBannerDelayValue == '')
        {
            getBannerDelayValue = 40;
        }
		
		var delayBanner  = getBannerDelayValue * 1000;

        $(".bannerPreview").delay(delayBanner).fadeIn();


        var getBuyNowValue = $(".buyNowPreview").attr("data-buynow-delay");

        if(getBuyNowValue == '')
        {
            getBuyNowValue = 60;
        }

		var delayBuyNow  = getBuyNowValue * 1000;
		
        $(".buyNowPreview").delay(delayBuyNow).fadeIn();
		
		
		var getLeadValue = $(".optinformsWrapper").attr("data-lead-delay");

        if(getLeadValue == '')
        {
            getLeadValue = 60;
        }
		
		var delayLead  = getLeadValue * 1000;
        $(".optinformsWrapper").delay(delayLead).fadeIn();
		

        var fire = {
        init:function(){
            
                $('iframe').contents().find('.controls').hide();
            
        }
      };

      fire.init();

      
    });

    $("#closeFullScreen").on('click',function(){
            $(".button-styling").hide();
            $(".bannerPreview").hide();
            $(".buyNowPreview").hide();
    });

    $(".buyNowClose").on('click',function(){
            $(".buyNowPreview").hide();
    });

    $(".btnClose").on('click',function(){
            $(".button-styling").hide();
    });

    $(".bannerClose").on('click',function(){
            $(".bannerPreview").hide();
    });
	
	$(".leadClose").click(function(){
        $("#optinforms-form3").hide();
    });
	
	
    $("#fullpreview").click(function(){
        $(".overlay").show();
    });

    $("#closeFullScreen").click(function(){
       $(".overlay").hide(); 
    });
    
    $('#fullpreview').on('click', function() {

        var button = $(this),
            player_wrapper = $(".fullscreen-video-wrapper");
            url = $(".iPlayBtnID").attr('data-video_url');
            //player_wrapper_content = player_wrapper.contents(),
            //iframe = player_wrapper_content[0].data;
        

        //default loading method
        //player_wrapper.prepend(iframe);
		
		$(".iframe-wrapper").html("");
		
        $(".iframe-wrapper").prepend('<iframe id="vdoPlayer2" src="'+url+'" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>');

        var getDelayValue = $(".btn-fullscreen").attr("data-btn-delay");

        if(getDelayValue == '')
        {
            getDelayValue = 15; 
        }
		
		//seconds=A*1000;
		var delayAction  = getDelayValue*1000;
		
        $(".button-styling").delay(delayAction).fadeIn();


        var getBannerDelayValue = $(".fullscreen-banner").attr("data-banner-delay");
        if(getBannerDelayValue == '')
        {
            getBannerDelayValue = 20;
        }
		
		var delayBanner  = getBannerDelayValue*1000;

        $(".bannerPreview").delay(delayBanner).fadeIn();


        var getBuyNowValue = $(".fullscreen-buynow").attr("data-buynow-delay");;

        if(getBuyNowValue == '')
        {
            getBuyNowValue = 30;
        }

		var delayBuynow  = getBuyNowValue*1000;	
        $(".buyNowPreview").delay(delayBuynow).fadeIn();
		
		var getLeadValue = $(".optinformsWrapper").attr("data-lead-delay");
		if(getLeadValue == '')
        {
            getLeadValue = 40;
        }
		
		var delayLead  = getLeadValue * 1000;
        $(".optinformsWrapper").delay(delayLead).fadeIn();
		
		
		//var video = $("#vdoPlayer1").attr("src");
		//$("#vdoPlayer1").attr("src","");
		//$("#vdoPlayer1").attr("src",video);
		
    });

	
	
	$(".leadBtn").click(function(){
		
		$("#leadFrm").attr('target', '_blank');
		$("#leadFrm").submit();
		$("#optinforms-form3").hide();
		return true;
	});	
	

 });    
