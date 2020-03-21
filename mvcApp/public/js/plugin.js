/*jslint browser: true*/
/*global document, $*/
$(document).ready(function () {
    'use strict';

    /* SELECT BOX */
    $('select').niceSelect();
    /* SELECT BOX */
/*============(START) GET ABSOLUTE PATH WITHOUT /public/ DIRECTORY ============*/
	var anchor = document.getElementsByTagName('a');
	for(var i = 0; i < anchor.length; i++){
		if (anchor[i].href.indexOf('public/') != -1 && anchor[i].href.indexOf('#') == -1) {
			anchor[i].href = anchor[i].href.replace('public/', '');
		}
	}

/*============(END) GET ABSOLUTE PATH WITHOUT /public/ DIRECTORY ============*/
/*============(START) SCROLL TO SECTION ============*/
	$('header .btn a').click(function (e) {
		e.preventDefault();
		var myAnchor = $(this).attr('href');
		$('html, body').animate({
			scrollTop: $(myAnchor).offset().top
		}, 1000);
	});
/*============(START) SCROLL TO SECTION ============*/


/*============(START) GIVE THE FULL WINDOW HEIGHT TO THE HEADER ============*/
	$('header').height($(window).height());
	$(window).resize(function () {
		$('header').height($(window).height());
	});
/*============(END) GIVE THE FULL WINDOW HEIGHT TO THE HEADER ============*/
	
	/*============(START) NAVBARs ============*/
	/*=== START CLOSE NAVBAR ===*/
	$('.sideBarStyle .back i').click(function () {
		$(this).closest('.sideBarStyle').removeClass("showBar");
	});
	/*=== END CLOSE NAVBAR ===*/
	/*=== START SHOW SIDE BARS ===*/
	$('.sideBar ul li, .brandSection .barsMobile, .brandSection .search i, .auth .forgetPassBtn, footer .part .contactUs, .notSignIn, .didntHelp').click(function (e) {
		e.preventDefault();
		$("." + $(this).data('nav')).toggleClass('showBar');
	});
	/*=== END SHOW SIDE BARS ===*/
	/*=== START SWITCH BETWEEN LOGIN & SIGN UP ===*/
	$(".auth .form .switch").click(function () {
		$(this).closest('.form').removeClass('showForm').siblings(".form").addClass('showForm');
	});
	/*=== END SWITCH BETWEEN LOGIN & SIGN UP ===*/
/*============(END) NAVBARs ============*/
/*============ (START) SLIDER ============*/
	var nbrTransform = 1,
		itemsCount = $(".topSales .allItems .item").length,
		topSalesTansform;
	if ($(".topSales .allItems").length){
		topSalesTansform = $(".topSales .allItems").css("transform").split(',')[4];
	}
	$(".topSales .btnSlider i").click(function () {
		if ($(this).hasClass('la-angle-right') && itemsCount - 1 > nbrTransform) {
			nbrTransform++;
		} else if ($(this).hasClass('la-angle-left') && nbrTransform > 0) {
			nbrTransform--;
		}
		$(".topSales .allItems .item").eq(nbrTransform).addClass("animateItem").siblings(".item").removeClass("animateItem");
		$(".topSales .allItems").css("transform","translateX(" + topSalesTansform * nbrTransform +"px)");
	});
	
	
	var nbrTransformSugg = 1,
		itemsCountSugg = $(".suggestion .allItems .item").length,
		topSalesTansformSugg;
	if ($(".suggestion .allItems").length) {
		topSalesTansformSugg = $(".suggestion .allItems").css("transform").split(',')[4];
	}
	$(".suggestion .btnSlider i").click(function () {
		if ($(this).hasClass('la-angle-right') && itemsCountSugg - 1 > nbrTransformSugg) {
			nbrTransformSugg++;
		} else if ($(this).hasClass('la-angle-left') && nbrTransformSugg > 0) {
			nbrTransformSugg--;
		}
		$(".suggestion .allItems .item").eq(nbrTransformSugg).addClass("animateItem").siblings(".item").removeClass("animateItem");
		$(".suggestion .allItems").css("transform","translateX(" + topSalesTansformSugg * nbrTransformSugg +"px)");
	});
/*============ (END) SLIDER ============*/
/*============ (START) SHOW ITEMS ON SCROLL DOWN ============*/
	function showItemOnScroll(item,itemChilds){
		$(item).each(function () {
			if ($(window).scrollTop() >= $(this).offset().top - $(window).height()/1.6) {
				var thisItem = itemChilds == undefined ? $(this) : itemChilds;
				thisItem.each(function (i) {
					setTimeout(function () {
						thisItem.eq(i).css({
							transform: "translateY(0)",
							opacity: "1"
						});
					}, 500 * (Math.random() * 2));
				});
			}
		});
	}
	showItemOnScroll(".showOnScroll");
	showItemOnScroll(".showAllOnScroll",$(".showAllOnScroll .itemShow"));
	$(window).scroll(function () {
		showItemOnScroll(".showOnScroll");
		showItemOnScroll(".showAllOnScroll",$(".showAllOnScroll .itemShow"));
	});
/*============ (END) SHOW ITEMS ON SCROLL DOWN ============*/
	
/*============ (START) SHOW ADVANCED SEARCH ============*/
	$('.formSearch .search .searchBox .advanced').click(function (e) {
		e.preventDefault();
		if ($(".formSearch .search .advancedSearch").hasClass('showAdvancedSearch')) {

			$(".formSearch .search .advancedSearch").removeClass("overFlowSearch");
			$(".formSearch .search .advancedSearch").removeClass("showAdvancedSearch");
		
		} else {
			
			$(".formSearch .search .advancedSearch").addClass("showAdvancedSearch");
			setTimeout(function () {
				$('.formSearch .search .advancedSearch').addClass('overFlowSearch');
			}, 500);
		}
	});
/*============ (END) SHOW ADVANCED SEARCH ============*/
	
/*============ (START) HEADER SLIDER ============*/
	var imgShowing = 1;
	$("header .images .img").not($("header .images .img").eq(0)).fadeOut();
	setInterval(function () {
		$("header .images .img").fadeOut(700);
		$("header .images .img").eq(imgShowing).fadeIn(700);
		imgShowing++;
		if (imgShowing == $("header .images .img").length) {
			imgShowing = 0;
		}
	},8000);
/*============ (END) HEADER SLIDER ============*/

/*============ (START) COUNT OF SELECT FILES ============*/
	$('.productImg input').change(function () {
		var countFiles = $('.productImg input')[0].files.length;
		if (countFiles > 5) {
			alert("you Can't choose more than 5 Images");
			$('.productImg input').val('');
			$('.productImg h6 span').text(0);
		} else {
			$('.productImg h6 span').text(countFiles);
		}
	});
/*============ (END) COUNT OF SELECT FILES ============*/

/*============ (START) ADD TAGS ON PRESS ON ; ============*/
	$('input[name=tags]').keydown(function (e) {
		if (e.keyCode == 190) {
			var thisValue = $(this).val();
			if (thisValue != ';' && thisValue != '') {

				$('.addProduct .tags').append('<span><i class="la la-close"></i>' + thisValue + '</span>');
				$(this).val('');
				$('input[name=realTags]').val($('input[name=realTags]').val() + thisValue + ';');
				
			} else {
				$(this).val('');
			}
		}
	});

	$('input[name=tags]').keyup(function (e) {
		if (e.keyCode == 190) {
			$(this).val('');
		}
	});

	$('.tags').on('click', 'span',function () {
		$(this).remove();
		$('input[name=realTags]').val('');
	});

/*============ (END) ADD TAGS ON PRESS ON ; ============*/

/*============ (START) SCROLL TO SECTION ============*/
	$('a[data-scroll=reviews]').click(function () {
		$('html, body').animate({
			scrollTop: $("#" + $(this).data('scroll')).offset().top - 60
		}, 300);
	});
/*============ (END) SCROLL TO SECTION ============*/

/*============ (START) START SWITCH BETWEEN IMG IN PRODUCT SHOW ============*/
	$('.product .fullProduct .img div img').click(function () {

		var mainImg = $('.product .fullProduct .img > img'),
			imgClicked = $(this);
		$(mainImg).fadeOut(250);
		$(this).fadeOut(250, function () {
			var mainImgSrc = mainImg.attr('src');
			mainImg.attr('src', imgClicked.attr('src'));
			imgClicked.attr('src', mainImgSrc);

			$(this).fadeIn(250);
			$(mainImg).fadeIn(250);
		});
	});
/*============ (END) START SWITCH BETWEEN IMG IN PRODUCT SHOW ============*/

/*============ (START) SHOW ANSWER ON FAQ PAGE ============*/
	$('.faq .allQ .faqItem h3').click(function () {
		$(this).toggleClass('activeQuestion');
	});
/*============ (END) SHOW ANSWER ON FAQ PAGE ============*/

	/*
		===========================================================
		================= START FOR MOBILE DEVICE =================
		===========================================================
	*/
	/*=== START CLOSE & SHOW BTN NAVBAR (MOBILE DEVICES) ===*/
	$('.brandSection .barsMobile').click(function () {
		$(".brandSection .barsMobile").toggleClass('barsTransform');
		if ($('.brandSection').hasClass('showNavMobile') && $(window).scrollTop() <= 10) {
			$('.brandSection').removeClass('showNavMobile');
		} else {
			$('.brandSection').addClass('showNavMobile');
		}
	});
	/*=== END CLOSE & SHOW BTN NAVBAR (MOBILE DEVICES) ===*/
	/*=== START ADD CLASS ACTIVE TO NAVBAR IN SCROLL (MOBILE DEVICES) ===*/
	$(window).scroll(function () {
		if (($(window).scrollTop() >= 10 || $(".sideBar").hasClass('showBar')) && $(window).width() <= 560) {
			$('.brandSection').addClass('showNavMobile');
		} else {
			$('.brandSection').removeClass('showNavMobile');
		}
	});
	/*=== END ADD CLASS ACTIVE TO NAVBAR IN SCROLL (MOBILE DEVICES) ===*/
});


$(window).on('load', function () {
    'use strict';
    $('.parentLoading .lds-ring').fadeOut(2000, function () {
    	$('.parentLoading').fadeOut(2000, function () {
    		$('body').css('overflow', 'visible');
    	});
        setTimeout(function () {
        	$('.loading').remove();
        }, 1000);
    });
});