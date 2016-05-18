$(document).ready(function() {

    // TODO
    // $('.header.slider').next().slideUp();
    // $('.landing-img-list').next().slideUp();

    // Grid slideUp/Down
    $('.header.slider').click(function(evt) {
        var icon = $(this).find('i');
        if(icon.attr('class').indexOf('down') > -1) {
            icon.attr('class', 'pe-7s-angle-up');
        } else {
            icon.attr('class', 'pe-7s-angle-down');
        }

        $(this).next().slideToggle();
    });

    $('.landing-img-list').click(function(evt) {
        var icon = $(this).find('i');
        if(icon.attr('class').indexOf('down') > -1) {
            icon.attr('class', 'pe-7s-angle-up');
        } else {
            icon.attr('class', 'pe-7s-angle-down');
        }

        $(this).next().slideToggle();
    });

    /* update landing img */
    $('.land-img').click(function() {
        var imgSrc = $(this).children().attr('src');
        //console.log(imgSrc);

        $('.player_wrapper').css('background-image', 'url(' + imgSrc + ')');
        $("#landingImgDefault").attr('value',imgSrc);

    });

    // buy icon button
    $('.buy-button-img').click(function() {
        var imgSrc = $(this).children().attr('src');
        //console.log(imgSrc);

        
        $("#downloadIcon").attr('value',imgSrc);

    });

    $('.radio-picture').click(function(evt) {
        $('.radio-picture').removeClass('grn-border');
        
        var mockup = $(this);
        // console.log(mockup.attr('id'));
        mockup.addClass('grn-border');

        updatePreviewMockup(mockup.attr('id'));

       var getPrevInputVal = mockup.attr('id');
       $("#mockUpType").attr('value',getPrevInputVal);
    });


    var updatePreviewMockup = function(id) {
        // console.log(id);
        var mainWrapper = 'i_video_player ' + id;
        // http://localhost/vid_invision/assets/img/mockups/_mbp.png
        
        $(".i_video_player").hide();
        if(window.location.hostname=="localhost")
        {
            var host = "http://"+window.location.hostname+":8080/Vidinvisionbasic/";
        }
        else
        {
            var host = "http://"+window.location.hostname+"/";
        }

        var frameSrc = host+'assets/img/mockups_thumb/_' + id + '.png';
        var playerWrapper = 'player_wrapper ' + id

        // update wrapper class
        // $(".i_video_player").removeAttr('class').addClass('i_video_player mba');
        $(".i_video_player").attr('class', mainWrapper);
        $(".player_wrapper").attr('class', playerWrapper);
        $(".ivf_frame").attr('src', frameSrc);
        $(".i_video_player").delay(15000).show();

    };





    player = '';

    function onYouTubeIframeAPIReady() {
        // isReady = true;
        player = new YT.Player('video-placeholder', {
            videoId: '',
            playerVars: {
                color: 'white'
            },
            events: {
                onReady: initialize
            }
        });
    }

    function initialize() {

        // Update the controls on load
        // updateTimerDisplay();
        // updateProgressBar();

        // Clear any old interval.
        // clearInterval(time_update_interval);

        // Start interval to update elapsed time display and
        // the elapsed part of the progress bar every second.

        // time_update_interval = setInterval(function () {
        //     updateTimerDisplay();
        //     updateProgressBar();
        // }, 1000)

    }

    // This function is called by initialize()
    function updateTimerDisplay(){
        // Update current time text display.
        $('#current-time').text(formatTime( player.getCurrentTime() ));
        $('#duration').text(formatTime( player.getDuration() ));
    }

    function formatTime(time){
        time = Math.round(time);

        var minutes = Math.floor(time / 60),
        seconds = time - minutes * 60;

        seconds = seconds < 10 ? '0' + seconds : seconds;

        return minutes + ":" + seconds;
    }


    $('#progress-bar').on('mouseup touchend', function (e) {

        // Calculate the new time for the video.
        // new time in seconds = total duration in seconds * ( value of range input / 100 )
        var newTime = player.getDuration() * (e.target.value / 100);

        // Skip video to new time.
        player.seekTo(newTime);

    });

    // This function is called by initialize()
    function updateProgressBar(){
        // Update the value of our progress bar accordingly.
        $('#progress-bar').val((player.getCurrentTime() / player.getDuration()) * 100);
    }


    $('#play').on('click', function () {
        player.playVideo();
    });

    $('#pause').on('click', function () {
        player.pauseVideo();
    });

    $('#mute-toggle').on('click', function() {
        var mute_toggle = $(this);

        if(player.isMuted()){
            player.unMute();
            mute_toggle.text('volume_up');
        }
        else{
            player.mute();
            mute_toggle.text('volume_off');
        }
    });

    $('#volume-input').on('change', function () {
        player.setVolume($(this).val());
    });

    $('#speed').on('change', function () {
        player.setPlaybackRate($(this).val());
    });

    $('#quality').on('change', function () {
        player.setPlaybackQuality($(this).val());
    });



    // // Find all YouTube videos
    // var $allVideos = $("iframe[src^='https://www.youtube.com']"),

    // // The element that is fluid width
    // $fluidEl = $("body");

    // // Figure out and save aspect ratio for each video
    // $allVideos.each(function() {

    //     $(this)
    //         .data('aspectRatio', this.height / this.width)

    //         // and remove the hard coded width/height
    //         .removeAttr('height')
    //         .removeAttr('width');

    // });

    // // When the window is resized
    // // (You'll probably want to debounce this)
    // $(window).resize(function() {

    //     var newWidth = $fluidEl.width();

    //     // Resize all videos according to their own aspect ratio
    //     $allVideos.each(function() {

    //         var $el = $(this);
    //         $el
    //             .width(newWidth)
    //             .height(newWidth * $el.data('aspectRatio'));

    //     });

    // // Kick off one resize to fix all videos on page load
    // }).resize();



    // $(document).ready(function(){
    //     // Target your .container, .wrapper, .post, etc.
    //     $("#video-placeholder").fitVids();
    // });


    /* Form Events */


    $('#updatepreview').on('click', function() {
        var formData = $('#campaign_form').serializeArray();
        var vidId = formData[1].value;
        var playerWrapper = $('.player_wrapper')[0];

        if(vidId) {
            var vidSrc = "https://www.youtube.com/embed/" + vidId + "?autoplay=1&color=white&theme=light&showinfo=0&rel=0";
            playerWrapper.children().attr('data-video_url', vidSrc);
        }

        // reset previous video
        playerWrapper.find('iframe').remove();
        playerWrapper.removeClass('plaing');
        playerWrapper.find('.play_btn').show();

    });

    /* Overlay Preview */
    $('#fullpreview').on('click', function() {
        var formData = $('#campaign_form').serializeArray();
        var vidId = formData[1].value;
        var playerWrapper = $('.overlay .player_wrapper');

        if(vidId) {
            var vidSrc = "https://www.youtube.com/embed/" + vidId + "?autoplay=1&color=white&theme=light&showinfo=0&rel=0";
            playerWrapper.children().attr('data-video_url', vidSrc);
        }

        // reset previous video
        playerWrapper.find('iframe').remove();
        playerWrapper.removeClass('plaing');
        playerWrapper.find('.play_btn').show();

    });

     //bind event handler to first text input
    $('#landingImgUrl').bind('keyup', function () {

    //enable or disable the next element based on the value of this one
     
    if(this.value != '')
     {

        $("#uploadLandingImgUrl").prop('disabled', true);
     }
     else
      {
        $("#uploadLandingImgUrl").prop('disabled', false);    
      }  
    
    });



    $('#uploadLandingImgUrl').on("change", function(){ 
           $("#landingImgUrl").prop('disabled', true); 

    });

    $('.buy-button-img').click(function(evt) {
        $('.buy-button-img').removeClass('grn-border-new');

        var mockup1 = $(this);
        // console.log(mockup.attr('id'));
        mockup1.addClass('grn-border-new');

    });

    $("#youtubeID").click(function(){
        $("#youtubeTxtField").slideDown();
        $("#vimeoTxtField").hide();
        $("#vvid_id").val('');
        $("input[name=radio][value=0]").prop('checked', false);
        $("input[name=radio][value=1]").prop('checked', true);
        
    });

    $("#vimeoID").click(function(){
        $("#vimeoTxtField").slideDown();
        $("#youtubeTxtField").hide();
        $("#yid_id").val('');
        $("input[name=radio][value=1]").prop('checked', false);
        $("input[name=radio][value=0]").prop('checked', true);

    });

	/*
	$("#autoPlay").click(function(){
		if($(this).is(':checked'))
		{
			$(".landing-images-container").hide();
			$(".play-icon-container").hide();
		}
		else{
			$(".landing-images-container").show();
			$(".play-icon-container").show();
		}		
	});
    */

});




