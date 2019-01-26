/*jslint browser: true, evil: false, jquery:true, forin: true, white: false, devel:true */

/*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 * Thanks to: Seamus Leahy for adding deltaX and deltaY
 *
 * Version: 3.0.6
 *
 * Requires: 1.2.2+
 */

(function(a){"use strict";function d(b){var c=b||window.event,d=[].slice.call(arguments,1),e=0,f=0,g=0;return b=a.event.fix(c),b.type="mousewheel",c.wheelDelta&&(e=c.wheelDelta/120),c.detail&&(e=-c.detail/3),g=e,void 0!==c.axis&&c.axis===c.HORIZONTAL_AXIS&&(g=0,f=-1*e),void 0!==c.wheelDeltaY&&(g=c.wheelDeltaY/120),void 0!==c.wheelDeltaX&&(f=-1*c.wheelDeltaX/120),d.unshift(b,e,f,g),(a.event.dispatch||a.event.handle).apply(this,d)}var b=["DOMMouseScroll","mousewheel"];if(a.event.fixHooks)for(var c=b.length;c;)a.event.fixHooks[b[--c]]=a.event.mouseHooks;a.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var a=b.length;a;)this.addEventListener(b[--a],d,!1);else this.onmousewheel=d},teardown:function(){if(this.removeEventListener)for(var a=b.length;a;)this.removeEventListener(b[--a],d,!1);else this.onmousewheel=null}},a.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}})})(jQuery);



(function (desktop, $, win, document, undefined) {
	var init,
			appendOverlay,
			disableScrolling,
			relayout,
			getPartial,
			attachHover,
			bindMousewheel,
			horizontalScroll,
			container = $('.rule-wrapper');
	
	placeHolderConfig = {
		visibleToScreenreaders : true,
    hideOnFocus : false, 
    forceApply : true, 
    autoInit : true 
  }

	desktop.init = function(){

		//remove mobile menu
		desktop.removeMobileMenu();
		//check war and nav
		ica.core.check_war_status();
		ica.core.check_nav_status();		
		desktop.attachHover();
		desktop.initSubmenu();

		//autofocus on new rule textarea
		if ($('#new-rule-page').length !== 0) {
			handleNewRule();
		}

		if ($('.rule-page').length !== 0) {
			ica.core.socialDrawer();
			//attach behaviour for new comment
			desktop.curveUrl();
			desktop.handleNewCommentBehavior();
			desktop.checkComments();
			ica.core.rulepageAnalytics();

			// FadeIn rule page UI
			$('.rule-content-container .rule-content h2').hide();
			$('.rule-content-container .rule-content time').hide();
			$('.rule-content-container .rule-content p').hide();
			$('.rule-content-container .rule-content div').hide();
			$('.rule-comments').css('marginTop', 300);
			$('.rule-content-container .rule-content').css('marginLeft', 90);

			if( $('.rule-content-container').length != 0) {
				$('.rule-content-container .rule-content').animate({width:470, height:470, left: 0, top: 0}, 1500, 'easeInOutQuint', function()
				{
					$(this).css('padding', '24px 60px 50px');
					$('.rule-content-container .rule-content h2').fadeIn();
					$('.rule-content-container .rule-content time').fadeIn();
					$('.rule-content-container .rule-content p').fadeIn();
					$('.rule-content-container .rule-content div').fadeIn();

					$('.mobile-back-button').animate({opacity:1}, 500);
					$('.agreement').animate({opacity:1}, 500);
					$('.rule-comments').animate({opacity:1, marginTop: 0}, 1000, 'easeInOutQuint');
				});
			}
		}

		if ($('.account-settings-page').length !== 0) {
			desktop.changePasswordSlider();
			desktop.updateValidation();
		};

		if ($('.search-page').length !== 0) {
  			ica.core.searchPage();
		};

		// FadeIn logo
		$('nav ul li h1').animate({opacity:1}, 2000);

		//handle external links
		$(document)
			.on('click', '.external', function (event) {
				event.preventDefault();
				window.open(this.href);
				return false;
			});
		
		//handle scroll event	
		var filterPanel = $('.filter-container');
		
		$(document).scroll(function() {
			
			if ( filterPanel.is(":visible") )
				$(".has-sub").find('~ .submenu').toggleClass('active');
		      });
	}

	//------------------------------------------
	//Destop functions that are called on init
	//
	//
	//------------------------------------------


	//remove the mobile menu that's in the DOMs
	desktop.removeMobileMenu = function(){
		$('.mobile-menu').remove();
		$('.mobile-filter-message').remove();
		$('.mobile-filter-drop').remove();
	}

	desktop.changePasswordSlider = function(){
		if ($('form .field_with_errors').length > 0) {
    	$('.change-password-fields').height(240);
    	$('.change-password').hide();
		}

		$('.change-password').on('click', function() {
		    openPasswordSlider(240);

		})

		var openPasswordSlider = function(sliderHeight){
		    $('.change-password-fields').animate({
		      height: sliderHeight + 'px'
		    });
		    $('.change-password').hide(200);
		};
	};

	desktop.updateValidation = function(){
		$('.checkbox-wrap.field_with_errors input').click(function(){
			$('.checkbox-wrap.field_with_errors').removeClass('field_with_errors');
		});
	}

	//------------------------------------------
	//  Functions called for loadHomePage Event
	//------------------------------------------

	desktop.initSubmenu = function(){

		desktop.showSubmenu(".filter-header .has-sub", ".login .submenu");
		desktop.showSubmenu(".login .has-sub", ".filter-header .submenu");
		ica.core.bindCheckCategories();

		$(document).mouseup(function (e){
			var container = $('.submenu.active');

			if (!$(e.target).is('.has-sub') && !$(e.target).is('.has-sub span') && !$(e.target).is('.has-sub i') && !container.is(e.target)	&& container.has(e.target).length === 0) {
				container.removeClass('active');
			}			
			
		});
	}

	desktop.showSubmenu = function(el, submenu){
		$(el).click(function(e){
			e.preventDefault();
			$(submenu).removeClass('active');
			$(this).find('~ .submenu').toggleClass('active');
		});
	}

	desktop.checkComments = function(){
		$commentsList = $('.the-comments ul');
		$comments = $commentsList.find('li');
		if($comments.length < 3){
			$comments.first().css('border-top', 'none');
		}
	}

	desktop.attachHover = function(){

		$('.overlay').on('click', function(ev) {
			if($(ev.target).closest('a').length === 0){
				window.location = "/rules/" + $(this).data('rule_id');
			}
		})

		$('.spotlight').on('click', function() {
			var spotlight_id = $(this).data('spotlight_id');
			window.location = "/rules/spotlight/" + $(this).data('spotlight_id');
		})


		//ANALYTICS EVENT home page
    $('.overlay a').on('click', function(){
      var ev = {},
          action = "Agree/Disagree",
          label = $(this).data('ga');

      ev.action = action;
     	ev.label = label;
      ev.value = action + 'From Home Page';

      ica.core.pushAnalytics(ev);

    })
    //ANALYTICS EVENT home page
	}


	// function to bundle all event handlining on the new rule page
	var handleNewRule = function() {

		var page = $('#new-rule-page'),
			textInput = (page).find('textarea'),
			charCountField = (page).find('.char-count'),
			charLimit = 140,
			newRuleForm = (page).find('form'),
			referenceLink = page.find("#rule_reference_link").attr('disabled','disabled'),
			submit = $('input[type="submit"]').attr('disabled','disabled');

		$('#nav').hide();
		(charCountField).text(charLimit)

		//autofocus on textarea
		setTimeout(function() {
			(textInput).focus();
		},300);

		//hide link to write a new rule page
		$.publish("hideWar");

		//delegate events for word count
		(textInput)
			.on('keydown', function(event) {
				//count number of characters
				var charCount = $(this).val().length;
				//delete or backspace
				if (event.keyCode === 127 || event.keyCode === 8) {
					charCount = charLimit - charCount;
					(charCountField).text(charCount);
					return true;
				}
				return true;
			})

			.on('keyup', function(event) {
				//count number of characters
				var charCount = $(this).val().length;
				charCount = charLimit - charCount;
				if(charCount < 0){
					submit.attr('disabled','disabled');
					referenceLink.attr('disabled','disabled');
					charCountField.addClass('red');
				} else if(charCount === charLimit){
					submit.attr('disabled','disabled');
					referenceLink.attr('disabled','disabled');
				} else {
					charCountField.removeClass('red');
					referenceLink.removeAttr('disabled');
					$('input#rule_reference_link').placeholder();
					submit.removeAttr('disabled');
				}
				(charCountField).text(charCount.toString());
				return true;
			});

		// autosize textare on desktop
		(textInput).autosize();

		$('.back-to-rules').on('click', function(ev){
			ev.preventDefault();
			// resetting overflow
			$('body').css('overflow', 'visible');
			$('.wrap').css('overflow', 'visible');
			$.publish('showWar');
			$.publish('showNav');

			//checking for warpanel existance - as it doesn't exist on rules/new

			if (warPanel === undefined) {

				window.location.href = '/';

			} else {

				warPanel.animate({
					opacity : 0
				}, function(){
					warPanel.css({
						'width' : 0,
						'height': 0
					});
					relayout();
				});

			}

			
		})

		newRuleForm.on("submit", function(){
	    	submit.attr('disabled','disabled');
	    });

	};

	// Cache DOM Element
	var warPanel;

	//animate to the "write a rule" page
	desktop.openWarPanel = function(){
		var dfd = new $.Deferred(),
				blackout = $(".blackout-bg");
				ruleWrapperWidth = $('.rule-wrapper').outerWidth();

				if (warPanel === undefined) {
					warPanel = $("<div class='war-panel'></div>").appendTo("body");
				}

				window.scrollTo(0,0);

				warPanel.css({
					'width' : "100%",
					'height': "100%"
					});
				
				// removing scroll bar

				warPanel.animate({
					opacity: 1
				}, 500, function(){

					$('body').css('overflow', 'hidden');
					$('.wrap').css('overflow', 'hidden');

					warPanel.css({
						height : "102%" // 102 hides the extra little at the bottom
					});
					dfd.resolve();

				});

				desktop.showRulePlaceHolder();

		return dfd.promise();
	};

	desktop.closeWarPanel = function(){
		var dfd = new $.Deferred(),
				warPanel = $(".war-panel");
				$('body').css('overflow', 'visible');
				$('.wrap').css('overflow', 'visible');
				warPanel.animate({
					opacity: 0
				}, 500, function(){
					warPanel.css({
						'width' : 0,
						'height': 0
					});
					dfd.resolve();
				});

		return dfd.promise();
	}

	desktop.showWarForm = function(){
		warPanel = warPanel || $(".war-panel");
		warPanel.load('/rules/new #new-rule-page', function(){
			handleNewRule();
			$('.rule-wrapper').css('width', '100%');

			desktop.showRulePlaceHolder();

			//if form fails to open, redirect to rules/new
			if ( $('#new-rule-page').length === 0 ) {
				window.location.href = '/rules/new';
			}
		});

	};

	//handle iPad autofocus
	desktop.showRulePlaceHolder = function() {
		
		if( !!('ontouchstart' in window) || !!('onmsgesturechange' in window) )
		{
			$('#rule_content').attr('placeHolder', "Enter rule here...");

			$('#rule_content').on('click', function() {
				$('#rule_content').attr('placeHolder', "");
			})
		}
	}

	// Show the logo when lightbox page is displayed.
	if ($('.lightbox') !== 0 && $('.ica-logo').length === 0) {
		$('.lightbox').prepend($('<div class="ica-logo"><ul><li><h1><a href="/rules/clear_filter">ICA The Rules</a></h1></li></ul></div>').fadeIn(800));
	}

	desktop.curveUrl = function() {

		var referenceUrl = $('#ref a');

		if (referenceUrl.length > 0) {
			referenceUrl.circleType({radius: 235, dir:-1});
		}

	}

	desktop.handleNewCommentBehavior = function() {

		var commentContainer = $('.your-comment'),
			newComment = commentContainer.find('.new-comment'),
			avatar = commentContainer.find('img'),
			submitButton = commentContainer.find('input[type="submit"]').hide(),
			placeHolder = 'What do you think?',
			speechBubbleArrow = commentContainer.find('.speech-bubble');

		newComment.off("focus").on("focus", function(event){

			commentContainer.animate({'height': '130px'});

			if (avatar.hasClass("animate-pop-in") === false) {
				//show avatar, making the textarea smaller to accommodate
				newComment.animate({'width' : '-=140px', 'height':'68px'}, 500, function(){

					avatar.css({"display":"inline-block"}).addClass('animate-pop-in');    //adds animation 0.5s - see animations.css

					speechBubbleArrow.css("visibility", "visible")
					.animate({"left": "-=25px"}, 500);

				});
			}

			if ($(this).val() === placeHolder) {
				$(this).val('');
			}

		})
		.off("keyup").on("keyup", function() {
			
			var textValue = $(this).val();

			if (textValue === '') {
				submitButton.hide();	
			} else {
				if (textValue.length > 0 && textValue !== placeHolder) {
					if (submitButton.is(":visible") === false) { //prevent hide/fade on every key press
						submitButton.fadeIn(300);
					}
				} else {					
					submitButton.hide();
				}
			}

		})
		.off("keydown").on("keydown", function() {

			if ($(this).val() === placeHolder) {
				$(this).val('');
			}

		})
		.off("blur").on("blur", function() {

			if ($(this).val() === '') {
				$(this).val(placeHolder);
			}

		})
		.val(placeHolder);

    //rest the coment box after submit
    submitButton.on("click", function(){


    	speechBubbleArrow
        	.animate({
        		"left": "+=25px"
        	}, 200, function() {
        		$(this).css("visibility", "hidden")
        		newComment
			        .animate({
			          "width": "+=140px",
			          "height": "32px"
			        },200, function() {
			          commentContainer.find('.new-comment').val(placeHolder);
			        });
        	});

      avatar
        .removeClass('animate-pop-in')
        .hide();

      submitButton.hide();
      commentContainer.animate({'height': '64px'}, 500);

    });
  };

	// Subscribe to Events

	$.subscribe("bindWarButton", function(){
		$('.war').on("click",function(){
			location.href = location.protocol+"//"+location.host+"/rules/new";
		});
	});

	$.subscribe("closeWarPanel", function() {
  		desktop.closeWarPanel();
	});

	// SOCIAL

	// Load the social toolbar after a pause to hide the jumping
	var socialToolbarInterval = setInterval(loadToolbar, 1000);

	function loadToolbar()
	{
		var r = $('.social-toolbar').css('right');

		if( r == "-130px" )
		{
			$('.social-toolbar').fadeIn(400);
			clearInterval(socialToolbarInterval);
		}
	}

	// Facebook
	var fb_api_key = ("" );
	fb_api_key = fb_api_key || (/artrules\.ica\.org\.uk/.test(location.href) ? "422564914529159" : "166203986897212");

	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=" + fb_api_key;
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	// Twitter

	!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");



	//init
	$(document).ready(desktop.init);

}(ica.desktop = {}, jQuery, window, document));
