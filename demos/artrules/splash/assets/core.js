/*! ICY-A */

/* Future Shaun, At some point you may look at this source and all I can say is that I am sorry. Regards, past Shaun : Ex-Human, consumed by a shit-ton of work */


var ica = ica || {};

(function($) {
  var o         = $({});
  $.subscribe   = o.on.bind(o);
  $.unsubscribe = o.off.bind(o);
  $.publish     = o.trigger.bind(o);
}(jQuery));

Modernizr.load([{
    test: Modernizr.mq('only screen and (min-width: 10em) and (max-width:40em)'),
    yep: "/assets/mobile.js",
    nope: "/assets/desktop.js"
}]);


(function (core, $, win, document, undefined) {


  //core vars
  var warButton = $("<button class=war></button>");
  var panelContainer = $('.footer-action-container');


  //share drawer on rule page
  core.socialDrawer = function(){
    $('#agree_link, #disagree_link').on('click', function(ev) {
    var vote = ev.target.textContent,
        drawer = $('.share-drawer');


      if((vote === 'Agree') || (vote === 'Disagree')){
        openDrawer(130);
        changeDrawerText(vote);
        console.log('clicked')
      } else{
        closeDrawer(0);
      }
    })

    openDrawer = function(height){
      $('.share-drawer').animate({
        height: height + 'px'
      });
    }

    closeDrawer = function(height){
      $('.share-drawer').animate({
        height: height + 'px'
      });
    }

    changeDrawerText = function (text) {
      $('.share-drawer .spread-the-word').text(text + 'd? Why not share the rule?');
      $('.share-drawer').addClass('agreed');
    }
  }

  //core functions

  core.addWarButton = function(){
    blackout = $("<div class='blackout-bg'></div>");
    warButton.appendTo(".write-a-rule");

    $.publish('bindWarButton'); //handled in desktop / mobile
    
  }

  core.removeWarButton = function(){
    warButton.remove();
  }

  core.showNav = function(){
    $('nav').css('display', 'block');
  }

  core.hideNav = function(){
    $('nav').css('display', 'none');
  }

  core.openDrawer = function(height){
    $('.share-drawer').animate({
      height: height + 'px'
    });
  }

  core.closeDrawer = function(height){
    $('.share-drawer').animate({
      height: height + 'px'
    });
  }

  changeDrawerText = function (text) {
    $('.share-drawer .spread-the-word').text(text + 'd? why not share the rule?');
    $('.share-drawer').addClass('agreed');
  }

  core.bindCheckCategories = function(){
    var categories = $('.categories');
    var everyone = $('.everyone');

    everyone.click( function() {
      uncheckCategories();
      $('#everyone_label').attr('for', 'none');

      function uncheckCategories () {
        categories.attr('checked', false);
      }
     });

    categories.click( function() {
      if ( (0 == $('.categories:not(:checked)').length) || (0 == $('.categories:checked').length) ) {
        everyone.click();
        $('#everyone_label').attr('for', 'none');
      } else {
        uncheckEveryone();
      }

      function uncheckEveryone () {
        everyone.attr('checked', false);
        $('#everyone_label').attr('for', 'q_user_user_categorisations_user_category_id_in_0');
      }
    });
  }

  core.searchPage = function(){
    
    var searchPage = $('.search-page'),
        searchBox = searchPage.find('#q_content_or_user_last_name_or_user_first_name_or_user_full_name_cont_any'),
        submitButton = searchPage.find('input[type="submit"]');
    
    searchBox.fitText(1.1);

    searchBox.keyup(function() {
      if ($(this).val().length > 0) {
        submitButton.animate({
          opacity: 1
        }, 500);
      }
      if ($(this).val().length === 0) {
        submitButton.animate({
          opacity: 0
        }, 500);
      }
    });


  
  }

  //Analytics for filter / search

  core.filterAnalytics = function(){
    var ev = {};
    var filters = [];
    var filterType = $('filter-message').find('h3').text();
    if (filterType === 'filter') {
     
     $('.filter-message ul li').each(function() { filters.push($(this).text()) })
     ev.action = 'Filter';
     ev.label = 'filter';
     ev.value = 'Filters for ' + filters;
   } else {
     
     $('.filter-message ul li').each(function() { filters.push($(this).text()) })
     ev.action = 'Search';
     ev.label = 'search';
      ev.value = 'search for ' + filters;
    }
    
    core.pushAnalytics(ev);
   }


  //Analytics event from rule page

  core.rulepageAnalytics = function(){
    var ev = {};
 
    $('.agreement a').on('click', function(){
      var action = "Agree/Disagree",
          label = $(this).data('ga');
          
          ev.action = action;
          ev.label = label;
          ev.value = action + 'From rule page';

          core.pushAnalytics(ev);
    })

    $('.email-btn').on('click', function(){
      var action = 'share rule',
          label = 'Email';

          ev.action = action;
          ev.label = label;
          ev.value = 'Email link on rule page';

          core.pushAnalytics(ev);
    })

    $('.report a').on('click', function(){
      var action = 'report rule',
          label = 'Report';

          ev.action = action;
          ev.label = label;
          ev.value = 'Report link on rule page';

          core.pushAnalytics(ev);
    })
    twttr.events.bind('click', function(){
      var ev = {};
      ev.action = 'Twitter share';
      ev.label = 'share';
      ev.value = 'Twitter share on Rule page';
      core.pushAnalytics(ev);
    });
   }

  // core push to analytics

  core.pushAnalytics = function(ev){
    _gaq.push(['_trackEvent', ev.action, ev.label, ev.value]);
  }

  // core checks

  core.check_war_status = function(){
    if($('.no-war').length > 0){
      $.publish('hideWar');
    } else {
      $.publish('showWar');
    }
  }

  core.check_nav_status = function(){
    if($('.no-nav').length > 0){
      $.publish('hideNav');
    } else {
      core.showNav();
    }
  }

  //subscribe to core events

  $.subscribe("showWar", function() {
    core.addWarButton();
  });

  $.subscribe("hideWar", function() {
    core.removeWarButton();
  });

  $.subscribe("hideNav", function(){
    core.hideNav();
  })

  $.subscribe("showNav", function(){
    core.showNav();
  })

}(ica.core = {}, jQuery, window, document));

function temporary_profile_image_upload() {
  $("#profile_pic .camera").addClass("rotate");
  $("#profile_pic img").attr("src","/assets/ajax-loader.gif").css({"height":"16px","width":"16px","top": "62px","left": "58px"});
  // future Shaun... this is probably a very stinky way of doing this... TODO: replace with less obtrusive
  var fileInput = document.getElementById('user_avatar');
  var file = fileInput.files[0];
  var formData = new FormData();
  formData.append(fileInput.name, file);
  $.ajax({type:"POST",processData:false,contentType:false,cache:false, url:'/profile_image_preview',data: formData});
}
;
