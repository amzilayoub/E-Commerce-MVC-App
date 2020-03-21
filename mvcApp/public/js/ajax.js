
$(document).ready(function (e) {
	'use strict';

	//function of msg

	function msg(msg,className = 'error'){
		$('.errors').append('<div>' + msg + '</div>');
		$('.errors div').addClass(className);
		$('.errors div').addClass('showMsg');
		$('.errors div').each(function (i) {
			setTimeout(function () {
				$('.errors div').eq(i).remove();
			},9000);
		});
	}


	//myAjax Function
	function myAjax(theMethod, theUrl, form, e ,funcSuccess = '', showSuccessMsg = true, showErrorMsg = true, element = '', showLoading = true){
		e.preventDefault();
		if (showLoading) {
			var elementToLoad = e.target.closest('section');
			$(elementToLoad).append('<div style="display:none;" class="loadOnClick"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>');
			$(elementToLoad).children('.loadOnClick').fadeIn(500);
		}
		$.ajax({
			method: theMethod,
			url : theUrl,
			data : form,
			success: function (data) {
				if (showLoading) {

					$(elementToLoad).children('.loadOnClick').fadeOut(500);
					setTimeout(function () {
						$(elementToLoad).children('.loadOnClick').remove();
					},1000);

				}
				try{
					var result = JSON.parse(data);
					if (Object.keys(result)[0] == 'true') {
						if (showSuccessMsg) {
							msg(result['true'], 'success');
						}
						if (funcSuccess != '') {
							funcSuccess();
						}

					} else {
						if (showErrorMsg) {
							msg(result['false']);
						}
					}
				} catch {

					element.html(data);
				
				}
				
			},
			cache: false,
			contentType: false,
			processData: false
		});
		
	}
	//Auth
	$('.login').submit(function (e) {

		var login = new FormData($(this)[0]);
		myAjax('POST', 'auth/login', login, e, function () {
			location.reload();
		});
	});

	//forgetPassword Step 1: The Side Bar Form
	$('.forgetPassword form').submit(function (e) {

		var form = new FormData($(this)[0]);
		myAjax('POST', 'auth/forgetPass', form, e);
		
	});

	//change forget Password Page
	$('.changePassForget form').submit(function (e) {

		var form = new FormData($(this)[0]);
		myAjax('POST', 'auth/recoverPass', form, e, function () {
			setTimeout(function () {
				$('.sideBar ul li').eq(2).click();
			}, 800);
		});
	});

	//Sign Up Button
	$('.signUpPage form').submit(function (e) {

		var form = new FormData($(this)[0]);
		myAjax('POST', 'signup/signUpProcess', form, e);

	});


	//LogOut
	$('.logout').click(function (e) {
		myAjax('POST', 'auth/logout','',e, function () {
			setTimeout(function () {
				location.reload();
			}, 1000);
		});
	});
	
	//Add Product
	$('.addProuctPage form').submit(function (e) {
		var form = new FormData($(this)[0]);
		myAjax('POST', 'product/addProduct', form, e);
	});


	//Add Discount
	$('.addDiscountPage form').submit(function (e) {
		var form = new FormData($(this)[0]),
			selectedItem = $(this).find('select'),
			inputAmount = $(this).find('select[type=text]');
		myAjax('POST', 'product/addDiscount', form, e, function () {
			$('.addDiscountPage form select').load('product/addDiscount .addDiscountPage form select option');
		});
	});

	//--------- ADD TO CARD ---------\\
	//This Click just for Products That We Want to Add To Card From the index Page
	$('.addToCardBtn').click(function (e) {
		e.preventDefault();
		$(this).siblings('form')[0];

		var form = new FormData($(this).siblings('form')[0]),
			action = $(this).siblings('form').attr('action');

		myAjax('POST', action, form, e);
	});

	$('.addToCardForm').submit(function (e) {

		var form = new FormData($(this)[0]),
			action = $(this).attr('action');

		myAjax('POST', action, form, e);

	});


	//Add Like
	$('section').on('click', '.like',function (e) {
		var like = $(this),
			likeClass = $(this).attr('class').split(' ')[1],
			href = $(this).attr('href') + "?classLike=" + likeClass;
		myAjax('POST', href, {}, e, function () {
			if (like.hasClass('onAddLike')){
				like.removeClass('onAddLike');
				if (!isNaN(like.find('span').text())) {
					like.find('span').text(parseInt(like.find('span').text()) - 1);
				}
			} else {
				like.addClass('onAddLike');
				if (!isNaN(like.find('span').text())) {
					like.find('span').text(parseInt(like.find('span').text()) + 1);
				}
			}

		}, false, true, '', false);
	});

	//add a review
	$('.reviews form').submit(function (e) {
		var form = new FormData($(this)[0]),
			userInfo = $('.product .userInfo'),
			myReview = '',
			url = $(this).attr('action');

		myAjax('POST', url, form, e, function () {
			myReview = '<li class="addedReview">';
			myReview += '<a style="background-image: url(uploaded/avatars/' + userInfo.children('.avatar').text() + ')" class="img" href="#"></a>';
			myReview += '<div class="theReview">';
			myReview += '<h6><span>' + userInfo.children('.username').text() + '</span></h6>';
			myReview += '<p>' + $('.reviews form textarea').val() + '<p>';
			myReview += "<div>";
			myReview += "<li>";
			$('.product .reviews ul').prepend(myReview);
			$('.reviews form textarea').val('');
		}, false, true, '', false);
	});



	//Add Rating
	$('.showProductRating').submit(function (e) {
		var form = new FormData($(this)[0]),
			url = $(this).attr('action');
			e.preventDefault();
		myAjax('POST', url, form, e,'', true, true, '', false);
	});

	$('.showProductRating input').click(function () {
		$('.showProductRating').submit();
	});


	//Search Button
	$(".formSearch > form").submit(function (e) {
		
		var form = new FormData($(this)[0]);
		myAjax('POST', 'product/search', form, e, '', true, true, $('.resultPage'));

	});

	//Search Button in the Aside Bar
	$('.searchAside form').submit(function (e) {
		var form = new FormData($(this)[0]);
		myAjax('POST', 'product/search', form, e, '', true, true, $('.searchAside .result'));
	});


	//RemoveMyCart
	$('.removeMyCart').click(function (e) {

		var thisProduct = 'myCart/removeProduct/' + $(this).data('product'),
			elementParent = $(this).closest('.item');
		myAjax('POST', thisProduct, {}, e, function () {
			elementParent.fadeOut(500);
			$('.sideBar ul li i span').text(parseInt($('.sideBar ul li i span').text()) - 1);
			setTimeout(function () {
				elementParent.remove();
				if ($('.myItemsPage .item').length == 0) {
					$('.myItemsPage').append('<h2 class="zeroItems"></span>There is 0 Item In Your Cart !</span></h2>');
				}
			}, 400);
		}, false, true, '', false);
	});


	//Remove Product from sales
	$('.user table td a').eq(0).click(function (e) {
		e.preventDefault();
		var href = $(this).attr('href'),
			parentOfThis = $(this).closest('tr');
		myAjax('POST', href, {}, e, function () {
			parentOfThis.fadeOut(500);
		}, false, true, '', false);
	});


	//Edit Profile Page
	$('.editProfile form').submit(function (e) {
		var form = new FormData($(this)[0]);
		myAjax('POST', 'user/editProfile', form ,e);
	});


	//Remove Product That User add
	$('.removeMyProduct').click(function (e) {

		var thisProduct = 'product/removeMyProduct/' + $(this).data('product'),
			elementParent = $(this).closest('.item');
		myAjax('POST', thisProduct, {}, e, function () {
			elementParent.fadeOut(500);
			setTimeout(function () {
				elementParent.remove();
				if ($('.myItemsPage .item').length == 0) {
					$('.myItemsPage').append('<h2 class="zeroItems"></span>You Have 0 Items !</span></h2>');
				}
			}, 400);
		}, false, true, '', false);
	});

	//Remove Product That User add
	$('.Unlike').click(function (e) {

		var thisProduct = 'like/addRemoveLike/' + $(this).data('product') + "?classLike=onAddLike",
			elementParent = $(this).closest('.item');
		myAjax('POST', thisProduct, {}, e, function () {
			elementParent.fadeOut(500);
			setTimeout(function () {
				elementParent.remove();
				if ($('.myItemsPage .item').length == 0) {
					$('.myItemsPage').append('<h2 class="zeroItems"></span>You Didn\'t Like Any Product !</span></h2>');
				}
			}, 400);
		}, false);
	});


	//Remove Product That has discount
	$('.removeDiscount').click(function (e) {

		var thisProduct = 'product/removeDiscount/' + $(this).data('product'),
			elementParent = $(this).closest('.item');
		myAjax('POST', thisProduct, {}, e, function () {
			elementParent.fadeOut(500);
			setTimeout(function () {
				elementParent.remove();
				if ($('.myItemsPage .item').length == 0) {
					$('.myItemsPage').append('<h2 class="zeroItems"></span>You Didn\'t Add Discount To Any Of Your Product !</span></h2>');
				}
			}, 400);
		}, false, true, '', false);
	});


	//Contact Form
	$('.contactAside form').submit(function (e) {
		var form = new FormData($(this)[0]);
		myAjax('POST', 'contact/', form, e);
	});


	$('.checkOutButton').click(function (e) {
		myAjax('POST', 'checkout/', {}, e);
	});

	$('.newsLetterForm').submit(function (e){
		var form = new FormData($(this)[0]);
		myAjax('POST', 'newsletter', form, e, '', true, true, '', false);
	});

});
