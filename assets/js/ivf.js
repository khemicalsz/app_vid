jQuery(document).ready(function($) {
    /*
    |--------------------------------------------------------------------------
    | When play button is clicked on the screen - uncomment the player iframe
    |--------------------------------------------------------------------------
    |
    */
    $('.i_video_player .play_btn').on('click', function() {

        var button = $(this),
            player_wrapper = button.parent(),
            url = button.attr('data-video_url'),
            player_wrapper_content = player_wrapper.contents(),
            iframe = player_wrapper_content[0].data;
        //default loading method
        if(!testPreview){
        player_wrapper.prepend(iframe);
        //fallback for lazy-loade
        if(player_wrapper.find('iframe').length < 1) {
            player_wrapper.prepend('<iframe src="'+url+'" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>');
        }
        player_wrapper.addClass('plaing');
        player_wrapper.find('.play_btn').hide();
        }

		
		var getCallToActionUrl = $("#redirect_url").val();
		var getRedirectUrl = $("#bannerRedirectUrl").val();
		var getBuyNowUrl = $("#buyNowUrl").val();
		
		//console.log("action"+getCallToActionUrl);
		//console.log("redirect"+getRedirectUrl);
		//console.log("buynow"+getBuyNowUrl);
		
		if(getCallToActionUrl != '')
		{
			 var getDelayValue = $("#delayBtn").val();
			if(getDelayValue == '')
			{
				getDelayValue = 5000;
			}
			
			//seconds=(A/1000)%60
			var delayAction  = (getDelayValue/1000)%60;
			
			//console.log(delayAction);
			
			$(".button-styling").delay(delayAction).fadeIn();
		}
		
		if(getRedirectUrl.length != '')
		{
			var getBannerDelayValue = $("#delayBanner").val();
			if(getBannerDelayValue == '')
			{
				getBannerDelayValue = 20000;
			}

			
			var delayBanner  = (getBannerDelayValue/1000)%60;
			
			$(".bannerPreview").delay(delayBanner).fadeIn();
		}
		
		if(getBuyNowUrl.length != '')
		{
			var getBuyNowValue = $("#buynowDelay").val();
        
			if(getBuyNowValue == '')
			{
				getBuyNowValue = 30000;
			}
			
			var delayBuyNow  = (getBuyNowValue/1000)%60;
			$(".buyNowPreview").delay(delayBuyNow).fadeIn();
		}

    });

    $("#closeFullScreen").on('click',function(){
		
		
		$(".plaing iframe").each(function() { 
			var src= $(this).attr('src');
			$(this).attr('src','');  
		});
		
		 
		
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
    /*
    |--------------------------------------------------------------------------
    | iVideoFrame slider setup
    |--------------------------------------------------------------------------
    |
    */
    var ivf_slider = $('.ivf_slider'),
        speed = 500;

    if(ivf_slider.length > 0) {
        //for each slider
        ivf_slider.each(function() {

            var slider = $(this),
                frame = slider.parent();

            //clone firest image to the end of the slider
            slider.find('.ivf_slider_img').first().clone().appendTo(slider);

            //prepare (resize) slider and slides
            setup_slider(slider);

            //setup autoplay
            if(slider.attr('data-autoplay') == '1') {
                var loop = setInterval(function(e) {
                    if(frame.is(':hover') && slider.attr('data-pause_on_hover') == '1') return; //turn off autoplay on screen hover
                    var bar = frame.find('.slide_progres');
                    var bar_val = parseInt(bar.attr('data-val'),0);
                    bar_val ++;
                    bar.attr('data-val', bar_val);
                    bar.css({'width': bar_val+'%'});
                    if(bar_val > 100) {
                        bar.css('width', 0);
                        bar.attr('data-val', 0);
                        move_slider(slider, 'right');
                    }
                }, parseInt(slider.attr('data-on_stage'),0) / 100);
            }

        });
        //repeat slider setup no window resize
        $(window).on('resize', function() {
            ivf_slider.each(function() {
                setup_slider($(this));
            });
        });
        //slider arrow noavigation
        $('.ivf_sa').on('click', function() {
            move_slider_by_arrow($(this));
        });
    }
    /**
     * Resize slides and their container
     */
    function setup_slider(slider) {
        var container = slider.parent(),
            images = slider.find('.ivf_slider_img'),
            count = images.length,
            load = setInterval(function(e) {
                var master_width = container.width();
                images.css('width', master_width);
                slider.css('width', master_width*count);
                if(master_width != 0) {
                    clearInterval(load);
                }
            },100);
        slider.attr('data-cur','1');
        slider.css('left', 0);
    }
    /**
     * Move slides in specified direction
     */
    function move_slider(slider, dir) {
        var container = slider.parent(),
            master_width = container.width(),
            images = slider.find('.ivf_slider_img'),
            count = images.length,
            cur = parseInt(slider.attr('data-cur'), 0);

        // moving "RIGHT" (autoplay or right arrow click) (shifting row to the left)
        if(dir == 'right' && !slider.hasClass('bussy')) {
            slider.addClass('bussy');
            slider.animate({ 'left' : -(cur*master_width)},speed, 'ivf_smooth', function() {
                if(cur < count-1) {
                    cur ++;
                    slider.attr('data-cur', cur);
                } else {
                    slider.css({'left':0});
                    cur = 1;
                    slider.attr('data-cur', cur);
                }
                slider.removeClass('bussy');
            });
        }
        //moving "LEFT" (left arrow click) (shifting row to the right)
        if(dir == 'left' && !slider.hasClass('bussy')) {
            slider.addClass('bussy');
            if(cur == 1) {
                slider.css({'left':-(count-1)*master_width});
                cur = count;
                slider.attr('data-cur',count);
            }
            slider.animate({ 'left' : -((cur-1)*master_width)+master_width},speed, 'ivf_smooth', function() {
                cur --;
                slider.attr('data-cur',cur);
                slider.removeClass('bussy');
            });
        }
    }
    /**
     * Slider arrow navigation ( calls move_slider() function with direction based on arrow type)
     */
    function move_slider_by_arrow(arrow) {
        var slider = arrow.parent().find('.ivf_slider');
        if(arrow.hasClass('ivf_sa_right')) {
            move_slider(slider, 'right');
        } else {
            move_slider(slider, 'left');
        }
    }
    /**
     * Easing function for slider animation
     */
    $.extend( $.easing, {
        ivf_smooth: function (x, t, b, c, d) {
            if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
            return -c/2 * ((t-=2)*t*t*t - 2) + b;
        }
    });


$('.ivf_icon_modal').on('click', function() {
                $('.ivf_icon_modal').removeClass('sel');
                $(this).addClass('sel');
                var f = $(this).attr('data-icon');
                var iconColor = $(this).attr('data-icon-color');

        

                $(".playerIconPreview").removeClass(removeIvfClasses);
                $(".playerIconPreview").removeClass(removeColorClasses);
                $(".playerIconPreview").removeClass(removeSizeClasses);

                var getiParentClass = $(".playerIconPreview").parent("div").attr("class");
                var splitParentClass = getiParentClass.split(" ");
                
                var createPlayIconSizeClass = "size-"+splitParentClass[1]+"-play-icon";


                var getPlayClass = $(this).find('i').attr('class');
                var updatePlayClass = getPlayClass+" "+createPlayIconSizeClass;
                $(".playerIconPreview").addClass(updatePlayClass);
                $("#playIconValue").val(updatePlayClass);
            });

    
       $("#yid_id").bind('blur',function(){
          var youtubeID = $(this).val();   
          
            if(youtubeID != '')
            {
                var createYoutubeUrl = "https://www.youtube.com/watch?v="+youtubeID;
                $(".iPlayBtnID").attr("data-video_url",createYoutubeUrl);
            }    
       });

       $("#vvid_id").bind('blur',function(){
          var vimeoID = $(this).val();   
          
            if(vimeoID != '')
            {

                var createVimeoUrl = "https://player.vimeo.com/video/"+vimeoID+"?title=0&byline=0&portrait=0";
                $(".iPlayBtnID").attr("data-video_url",createVimeoUrl);
            }    
       });  



$('#filterListing').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchableList tr').hide();
            $('.searchableList tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })       

      
});

function removeIvfClasses(index, css) {
    return (css.match (/(^|\s)ivf_\S+/g) || []).join(' ');
    };  

function removeColorClasses(index, css) {
    return (css.match (/(^|\s)color-\S+/g) || []).join(' ');
    };    

function removeSizeClasses(index, css) {
    return (css.match (/(^|\s)size-\S+/g) || []).join(' ');

    
    };

