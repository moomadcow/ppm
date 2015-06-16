/*global Cookies, ga, Modernizr */

// main javascript file for the app
$(function() {

	var MyApp = (function() {

		// declare global screen size variable
		var screenSize;

		// declar global cookies variable
		var khPromo;
		var lnPromo;
		var lnPromoModal;

		// declare referrer variable
		var referrer;

		var checkWindowSize = function() {
			var windowWidth = $(window).width();
			if (windowWidth <= 414) {
				screenSize = 'phone-portrait';
			}
			else if (windowWidth > 415 && windowWidth <= 767) {
				screenSize = 'phone-landscape';
			}
			else if (windowWidth > 768 && windowWidth <= 959) {
				screenSize = 'tablet-portrait';
			}
			else {
				screenSize = 'desktop';
			}
		},

		toggleMenu = function() {
			var menu = $('.main-nav');

			if (menu.hasClass('active')) {
				menu.removeClass('active');
			} else {
				menu.addClass('active');
			}
		},

		//setPanelSize = function() {
		//	var windowHeight = $(window).height();
		//	if(screenSize === 'desktop' || screenSize === 'tablet-portrait') {
		//		$('.panel .content-container').css('height', windowHeight-60);
		//	} else {
		//		$('.panel .content-container').attr("style","");
		//		$('.home.panel .content-container').css('height', windowHeight-54);
		//	}
		//},

		registerTouchEvent = function() {
			// registers touch event if Modernizr detects it is available
			if (Modernizr.touch) {
				document.addEventListener("touchstart", function(){}, true); // iOS Buttons Fix
			}
		},

		scrollTo = function(destination) {
			if (screenSize === 'tablet-portrait' || screenSize ==='desktop') {
				$('html, body').animate({
					scrollTop: $(destination).offset().top -65
				}, 500);
			} else {
				$('html, body').animate({
					scrollTop: $(destination).offset().top -55
				}, 500);
			}
		},

		//scrollOnLoad = function() {
		//	var hash = window.location.hash;
		//	if (window.location.hash) {
		//		$('html, body').animate({
		//			scrollTop: $(hash).offset().top -54
		//		}, 500);
		//	}
		//},

		gaEvents = function(category, action, label) {
			// ga('send', 'event', 'category', 'action', 'label', value);  // value is a number.
			ga('send', 'event', category, action, label);
		},

		openModal = function(dataSrc) {
			$('.modal.universal .content').load(dataSrc);
			$('.modal.universal, .modal-overlay').addClass('active');
		},

		openModalID = function(id) {
			$(id+', .modal-overlay').addClass('active');
		},

		closeModal = function() {
			$('.modal.universal .content').html('');
			$('.modal, .modal-overlay').removeClass('active');
		},

		checkCookies = function() {
			khPromo = Cookies.get('kh_promo');
			lnPromo = Cookies.get('ln_promo');
			lnPromoModal = Cookies.get('ln_promo_modal');
		},

		checkReferrer = function() {
			var qs = (function(a) {
				if (a ==="") {return;}
				var b = {};
				for (var i = 0; i < a.length; ++i)
				{
					var p=a[i].split('=', 2);
					if (p.length === 1) {
						b[p[0]] = "";
					}
					else {
						b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
					}
				}
				return b;
			})(window.location.search.substr(1).split('&'));

			referrer = qs.utm_source;

			if (referrer === 'linkedin') {
				Cookies.set('ln_promo', 'true', { expires: 7, path: '/'});
				Cookies.remove('kh_promo');
				checkCookies();
			}

			if (lnPromo === undefined) {
				$('.promo-unit-kh').addClass('active');
			}
			else if (lnPromo === 'true') {
				$('#linked_in_subscribe_box').addClass('active');
			}

		},

		invokePromo = function() {

			if($('body').hasClass('single-post') && !$('body').hasClass('news') && $(window).scrollTop() >= 700) {

				if (lnPromo === 'true' && lnPromoModal === undefined) {
					openModalID('#linkedin_modal');
					Cookies.set('ln_promo_modal', '1', { expires: 0.125, path: '/' });
					checkCookies();
				}
 				else if (lnPromo === undefined && khPromo === undefined) {
					openModalID('#kh_modal');
					Cookies.set('kh_promo', '1', { expires: 0.125, path: '/' });
					checkCookies();
				}

			}
		},

		videoInit = function() {
			var video = $('#bgvid');
			var playButton = $('#play_pause');
			var playButtonIcon = $('#play_pause .fa');
			var playModalButton = $('#play_full_video');

			if(video.length > 0) {
				// set up play and pause button
				playButton.on('click', function(){
					if(video.get(0).paused === true) {
						video.get(0).play();
						playButtonIcon.removeClass('fa-play').addClass('fa-pause');
					} else {
						video.get(0).pause();
						playButtonIcon.removeClass('fa-pause').addClass('fa-play');
					}
				});

				// set up the full modal button
				playModalButton.on('click', function(){
					video.get(0).pause();
					playButtonIcon.removeClass('fa-pause').addClass('fa-play');
				});
			}
		},

		scrollFunctions = function() {
			invokePromo();
		},

		resize = function() {
			checkWindowSize();
		},

		init = function() {
			registerTouchEvent();
			checkWindowSize();
			videoInit();
			checkCookies();
			checkReferrer();
		};

		return {
			toggleMenu: toggleMenu,
			scrollTo: scrollTo,
			gaEvents: gaEvents,
			openModal: openModal,
			closeModal: closeModal,
			scrollFunctions: scrollFunctions,
			resize: resize,
			init: init
		};

	})();

	// functions to run when the document finishes loading
	$(document).ready(function(){
		MyApp.init();
	});

	// functions to run on window resize
	$(window).on('resize',function(){
		MyApp.resize();
	});

	// on.click listeners
	$('.nav-launcher, .menu-toggle').on('click', function(){
		MyApp.toggleMenu();
	});
	$('a.scroll, .scroll a').on('click', function(e){
		var destination = $(this).attr('href');
		MyApp.scrollTo(destination);
		e.preventDefault();
	});

	$('.main-nav ul li a').on('click', function(){
		MyApp.toggleMenu();
	});

	$('.modal-open').on('click', function(){
		var dataSrc = $(this).data('src');
		MyApp.openModal(dataSrc);
	});

	$('.modal .close, .modal-overlay').on('click', function(){
		MyApp.closeModal();
	});

	$('.modal.email-sign-up .button').on('click', function(){
		MyApp.gaEvents('promo linkedin modal', 'sign up', 'I\'m in!');
	});

	$('.subscribe .button').on('click', function(){
		MyApp.gaEvents('promo linkedin subscribe box', 'sign up', 'I\'m in!');
	});

	// on.scroll listeners
	$(window).on('scroll', function(){
		MyApp.scrollFunctions();
	});


	// google event tracking
	$('.ga-events').on('click', function(){
		var category = $(this).data('category');
		var action = $(this).data('action');
		var label = $(this).data('label');
		MyApp.gaEvents(category, action, label);
	});


});

