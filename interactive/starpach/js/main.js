function loadVideo() {

    var video = '',
        $target = $('#page'),
        classes = '',
        start = 0,
        w = $(window).width(),
        h = $(window).height(),
        wOffset = 600,
        hOffset = 280;
        
    video = "C4AFe6VWNHQ";
    $target = $('.hero');
    $target.css('background', 'none');
    
    $('.video-background').remove();
    $('<div class="video-background ' + classes + '"></div>').appendTo($target);
    
    $('<iframe width="' + (w+wOffset) + 'px" height="' + (h+hOffset) + 'px" style="margin-left: -' + (wOffset/2) + 'px;  margin-top: -' + (hOffset/2) + 'px" frameborder="0"></iframe>')
        .attr("src", "http://www.youtube.com/embed/" + video + "?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1&amp;loop=1&amp;playlist=" + video + "&amp;start=" + start)
        .appendTo('.video-background');
};

$( document ).ready(function() {
    $('.continue').on('click', function() { $(this).remove(); });

    // Starpach UI config events
    $('input[type=checkbox]').on('change', function() {
        
        var $caption = $(this).closest('.switch').find('.caption span'),
            option = $(this).data('option');

        if ($(this).prop('checked')) $caption.text('On');
        else $caption.text('Off');

        if (typeof(JM_MODULES.starpach) !== 'undefined') {
            JM_MODULES.starpach.updateSettings(option, $(this).prop('checked'));
        }
    });

    $('#start-game').on('click', function() {
        
        $(this).hide();
        $('.hero h1, .hero .continue').hide();
        $('.game-status').text('Loading game assets...');

        // Load the background video
        $('.video-switch').hide();
        if ($('#video-cb').prop('checked')) {
            loadVideo();
        }

        // Load the game
        JM_MODULES.starpach.init();
        JM_MODULES.starpach.startEngine($('#music-cb').prop('checked'), $('#sfx-cb').prop('checked'), $('#stars-cb').prop('checked'));
        starpachInitialised = true;
    });
});