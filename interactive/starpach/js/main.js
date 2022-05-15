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

        // Load the game
        JM_MODULES.starpach.init();
        JM_MODULES.starpach.startEngine($('#music-cb').prop('checked'), $('#sfx-cb').prop('checked'), $('#stars-cb').prop('checked'));
        starpachInitialised = true;
    });
});